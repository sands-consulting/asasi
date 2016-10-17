<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/login';

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