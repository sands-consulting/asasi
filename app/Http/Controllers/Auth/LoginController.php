<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function authenticated(Request $request, $user)
    {
        if(!in_array($user->status, ['active', 'blacklisted']))
        {
            $this->guard()->logout();
            $request->session()->flush();
            $request->session()->regenerate();

            return redirect()
                ->back()
                ->with('alert', trans('auth.notices.' . $user->status));
        }

        $user->cachePermissions();
    }


    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

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
