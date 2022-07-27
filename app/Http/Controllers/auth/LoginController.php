<?php

namespace App\Http\Controllers\auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{


    function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    function index() {
        return view('auth.login');
    }

    function login(Request $request) {

        $request->validate([
            'email' => ['email', 'required'],
            'password' => ['required', 'min:6'],
        ]);

       try {

           if(Auth::attempt($request->only(['email', 'password']))) {
               $request->session()->regenerate();
               return redirect()->route('dashboard.index')->with('msg', 'user Loged in successfully');
           } else {
            return redirect()->back()->with('msg', 'User not loged in');
           }

      }catch(\Exception $e) {
            return redirect()->back()->with('msg', 'User not loged in');
       }
    }


    function logout(Request $request) {
        try {
               Auth::logout();
               $request->session()->invalidate();
               $request->session()->regenerateToken();

               Cache::forget('chached-products');

               return redirect()->route('home');
        } catch(\Exception $e) {
            return redirect()->back()->with('msg', 'logout failed');
        }
    }

}
