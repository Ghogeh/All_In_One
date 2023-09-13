<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    //function from  verify email route
    function notice () {
        //return the view 'verify-email
        return view('auth.verify-email');
    }


    function verify(EmailVerificationRequest $request) {
        //if the request is fulfilled in the register controller it directs the user to the index
        $request->fulfill();
        return redirect()->route('dashboard.index')->with('msg', 'user registered successfully');
    }

    function resend(Request $request) {
        //return you back to the reason page 
        $request->user()->sendEmailVerificationNotification();
        return back()->with('msg', 'Verification link sent!');
    }
}
