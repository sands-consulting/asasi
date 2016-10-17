<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Mailers\AppMailer;
use App\User;
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

    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'confirmation_token' => str_random(30)
        ]);
    }

    public function register(Request $request)
    {
        $validator = $this->validator($request->all());

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
