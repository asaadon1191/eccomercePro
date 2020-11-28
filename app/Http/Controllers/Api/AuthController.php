<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\loginRequest;
use App\Http\Requests\Api\regsterRequest;

class AuthController extends Controller
{
    public function regster(regsterRequest $request)
    {
        // return $request;
        $user = User::create(
            [
                'name'      => $request->name,
                'email'     => $request->email,
                'password'  => bcrypt($request->password),
                'phone'     => $request->phone,
            ]);

            
            $access_token = $user->createToken('access_token')->accessToken;
             return \response()->json(
                 [
                    'message'   => 'User Created Successfaly',
                    'data'      => $user,
                    'status'    => 200,
                    'Token'     => $access_token
                 ]);
    }


    public function login(loginRequest $request)
    {   
        if (!Auth::attempt($request->all())) 
        {
            return response(
                [
                    'message' => 'This User Not Found',
                ]);
        }

        
        $access_token = Auth::user()->createToken('access_token')->accessToken;
        

        return response(
            [
                'user' => Auth::user(),
                'access_token' => $access_token 
            ]);
    }
}
