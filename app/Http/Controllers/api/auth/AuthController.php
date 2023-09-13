<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function register(Request $request) {
        $validateUser = Validator::make($request->all(), [
            'name' => ['required', 'min:3'],
            'email' => ['email', 'required', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        if($validateUser->fails()) {
            return response()->json([
                'status' =>false,
                'msg' => "validation problem",
                'error' => $validateUser->errors()
            ]);
        } 

       try {
           $user = User::create([
                 'name' => $request->name,
                 'email' => $request->email,
                 'password' => Hash::make($request->password),
           ]);

           $token = $user->createToken('all_in_one-token')->plainTextToken;
           return response()->json([
            'status' =>true,
            'msg' => "user created",
            'user' => $user,
            'token' => $token,
        ], 201);

      }catch(\Exception $e) {
        return response()->json([
            'status' =>false,
            'msg' => "problem with user registration",
        ], 500);
       }

    }


    function login(Request $request) {

        $validateUser = Validator::make($request->all(), [
            'email' => ['email', 'required'],
            'password' => ['required', 'min:6'],
        ]);

        if($validateUser->fails()) {
            return response()->json([
                'status' =>false,
                'msg' => "validation problem",
                'error' => $validateUser->errors()
            ]);
        }
        try {

            if(Auth::attempt($request->only(['email', 'password']))) {
              $user = User::where('email', $request->email)->first();
              $token = $user->createToken('all_in_one-token')->plainTextToken;
              return response()->json([
                'status' =>true,
                'msg' => "login successfully",
                'user' => $user,
                'token' => $token,
            ]);
            } else {
                return response()->json([
                    'status' =>false,
                    'msg' => "login problem",
                ], 500);
            }

       }catch(\Exception $e) {
        return response()->json([
            'status' =>false,
            'msg' => "login problem",
        ], 500);
        }
    }

    function logout(Request $request) {

                try {

                        auth()->user()->tokens->delete();
                        return response()->json([
                            'status' =>true,
                            'msg' => "logout successfully",
                        ], 200);

                }catch(\Exception $e) {
                    return response()->json([
                        'status' =>false,
                        'msg' => $e->getMessage(),
                    ], 500);
                }
    }
}
