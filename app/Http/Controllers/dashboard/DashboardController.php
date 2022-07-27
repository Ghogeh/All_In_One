<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }


    function index() {
        return view('dashboard.index');
    }
}
