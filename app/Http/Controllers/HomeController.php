<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function home(Request $request) {
        $page = $request->has('page') ? $request->query('page') : 1;
        $products =Cache::remember('cached-home'.'_page_'.$page, now()->addMinutes(60), function() {
            return Product::paginate(2);
        });
        return view('home', compact('products'));
    }
}
