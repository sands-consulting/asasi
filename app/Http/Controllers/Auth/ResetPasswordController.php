<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

<<<<<<< HEAD:app/Http/Controllers/Auth/PasswordController.php
    protected $redirectTo = '/login';

=======
    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
>>>>>>> upstream/5.3:app/Http/Controllers/Auth/ResetPasswordController.php
    public function __construct()
    {
        $this->middleware($this->guestMiddleware());
        $this->subject = trans('passwords.password_reset_link');
    }

    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => bcrypt($password)
        ])->save();
    }

    protected function getSendResetLinkEmailSuccessResponse($response)
    {
        return redirect()->back()->with('notice', trans($response));
    }

    protected function getResetSuccessResponse($response)
    {
        return redirect($this->redirectPath())->with('notice', trans($response));
    }

    protected function getResetValidationRules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ];
    }
}