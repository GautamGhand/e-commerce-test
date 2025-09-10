<?php

namespace App\Http\Controllers\Web\Customer\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->with(['cartProducts'])->first();
        return view('customer.cart.index', [
            'cart' => $cart
        ]);
    }
    public function addToCart(Request $request, $uuid)
    {
        $product = Product::where('uuid', $uuid)->first();
        $cart_exists = Cart::where('user_id', Auth::id())->first();
        if ($cart_exists) {
            $cart_product = $cart_exists->cartProducts()->where('product_id', $product->id)->first();
            if ($cart_product) {
                $cart_product->update([
                    'quantity' => $cart_product->quantity + 1,
                ]);
                $cart_product->refresh();
                $cart_product->update([
                    'sub_total' => $cart_product->quantity * $product->price
                ]);
            } else {
                $cart_exists->cartProducts()->create([
                    'cart_id' => $cart_exists->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $product->price,
                    'sub_total' => $product->price * 1
                ]);
            }
        } else {
            $cart = Cart::create([
                'user_id' => Auth::id()
            ]);
            $cart->cartProducts()->create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
                'sub_total' => $product->price * 1
            ]);
        }
        return Redirect::route('home')->withSuccess('Product Added To Cart!');
    }
}
