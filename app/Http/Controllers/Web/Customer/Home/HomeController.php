<?php

namespace App\Http\Controllers\Web\Customer\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $products = Product::get();
        return view('customer.home',[
            'products' => $products
        ]);
    }
}
