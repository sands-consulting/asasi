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
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $data['vendor_registration_number'] = normalize_registration_number($data['vendor_registration_number']);

        return Validator::make($data, [
            'vendor_registration_number' => 'required|unique:vendors,normalized_registration_number',
            'vendor_name' => 'required|unique:vendors,name',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
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
}
