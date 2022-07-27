<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{


    function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    function index() {
        return ProductsResource::collection(Product::orderBy('id', 'desc')->paginate(10));
    }
}
