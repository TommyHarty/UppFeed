<?php

namespace App\Http\Controllers\Auth;

use Mail;
use App\User;
use App\Profile;
use App\OpeningTime;
use App\BusinessInfo;
use App\SocialNetwork;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/payment';

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
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
        ]);

        if ($data['role'] == 'admin') {
            BusinessInfo::create([
                'user_id' => $user->id,
            ]);

            OpeningTime::create([
                'user_id' => $user->id,
            ]);
        }

        Profile::create([
            'user_id' => $user->id,
            'profile_slug' => strtolower(str_replace(' ', '-', $user->name)) . '-' . $user->id,
        ]);

        Mail::send('emails.superadmin.registered', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to('tommyharty@live.com');
            $message->subject('New Registration');
        });

        return $user;
    }
}
