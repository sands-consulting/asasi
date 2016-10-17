<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'attributes' => [
        'name'                  => 'Name',
        'email'                 => 'Email Address',
        'password'              => 'Password',
        'password_confirmation' => 'Password Confirmation',
        'remember_me'           => 'Remember Me'
    ],

    'notices' => [
        'inactive'  => 'Your account is inactive. Please confirm your email address.',
        'confirmed' => 'Your account is now confirmed. You may login.',
        'suspended' => 'Your account is suspended. Please contact system administrator'
    ],

    'required' => 'Please enter your login and password.',
    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    'unauthorized' => 'You are not authorized to run the action',

    'register' => 'Register new account',
    'login' => 'Login to your account',
    'forgot_password' => 'Forgot Password?',
    'reset_password' => 'Reset Password',
    'confirmation' => 'Confirm Your Email Address'
];
