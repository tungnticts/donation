<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function products_list(Request $request) {
        return view('product.list');
    }
}
