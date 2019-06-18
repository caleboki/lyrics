<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Hash;

class AuthenticationController extends Controller
{

    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            //'password' => 'required|between:6,25|confirmed'
            'password' => 'required|between:6,25'
        ]);
        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        $user->api_token = str_random(60);
        $user->save();
        return response()
            ->json([
                'registered' => true,
                'api_token' => $user->api_token,
                'user' => $user
            ]);

    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|between:6,25'
        ]);
        $user = User::where('email', $request->email)
            ->first();
        if($user && Hash::check($request->password, $user->password)) {
            //generate new api token
            $user->api_token = str_random(60);
            $user->save();
            return response()
                ->json([
                    'authenticated' => true,
                    'api_token' => $user->api_token,
                    'user' => $user
                ]);
        }
        return response()
            ->json([
                'message' => 'Provided email and password does not match!'
            ], 422);
    }

}
