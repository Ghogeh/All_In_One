<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    function notice () {
        return view('auth.verify-email');
    }


    function verify(EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('dashboard.index')->with('msg', 'user registered successfully');
    }

    function resend(Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('msg', 'Verification link sent!');
    }
}
