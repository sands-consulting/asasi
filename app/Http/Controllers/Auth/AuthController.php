<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Mailers\AppMailer;
use App\Role;
use App\User;
use App\Vendor;
use DB;
use Event;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo           = '/';
    protected $redirectAfterLogout  = '/';
    protected $redirectAdmin        = '/admin';

    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'vendor_registration_number' => 'required|unique:vendors,normalized_registration_number',
            'vendor_name' => 'required|unique:vendors,name',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return DB::transaction(function() use($data) {
            $vendor = Vendor::create([
                'name' => $data['vendor_name'],
                'registration_number' => $data['vendor_registration_number'],
                'contact_person_name' => $data['name'],
                'contact_person_email' => $data['email']
            ]);

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'confirmation_token' => str_random(30)
            ]);
            $user->roles()->sync(Role::whereIn('name', ['vendor', 'vendor-admin'])->lists('id')->toArray());
            $user->vendors()->attach($vendor->id);
            return $user;
        });
    }

    public function register(Request $request)
    {
        $data                               = $request->all();
        $data['vendor_registration_number'] = normalize_registration_number($data['vendor_registration_number']);
        $validator                          = $this->validator($data);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->create($request->all());
        Event::fire(new UserRegistered($user));

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/')
                ->with('notice', trans('auth.notices.inactive'));
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->with('alert', $this->getFailedLoginMessage())
            ->withInput($request->only($this->loginUsername(), 'remember'));
    }

    protected function authenticated(Request $request, $user)
    {
        if(in_array($user->status, ['inactive', 'suspended'])) {
            Auth::guard($this->getGuard())->logout();
            return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/')
                ->with('alert', trans('auth.notices.' . $user->status));
        }
        if ($request->user()->hasPermission('access:admin'))
            return redirect()->intended($this->redirectAdmin);
        else
            return redirect()->intended($this->redirectPath());
    }

    public function logout()
    {
        Auth::guard($this->getGuard())->logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/')
                ->with('notice', trans('auth.notices.logged_out'));
    }

    public function confirmation($token)
    {
        $user = User::whereConfirmationToken($token)->firstOrFail()->update(['status' => 'active']);
        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/')
            ->with('notice', trans('auth.notices.confirmed'));
    }
}
