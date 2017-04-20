<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class MeController extends Controller
{
    public function create(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try
        {
            if(! $token = JWTAuth::attempt($credentials))
            {
                return $this->response->errorNotFound();
            }
        }
        catch (JWTException $e)
        {
            return $this->response->errorInternal();
        }
 
        return [
            'token' => $token,
            'user' => User::with(['vendors', 'organizations'])->find($request->user()->id)
        ];
    }

    public function show(Request $request)
    {
        return User::with(['vendors', 'organizations'])->find($request->user()->id);
    }
}
