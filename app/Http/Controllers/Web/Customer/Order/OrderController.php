<?php

namespace App\Http\Controllers\Web\Customer\Order;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Order;
use FFI\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::where('user_id',Auth::id())->get();
        return view('customer.order.index',[
            'orders' => $orders
        ]);
    }
    public function checkout(){
        try{
            DB::beginTransaction();
            $cart = Cart::where('user_id',Auth::id())->with(['cartProducts'])->first();
            $order = Order::create([
                'user_id' => Auth::id(),
            ]);
            $cart_products = CartProduct::where('cart_id',$cart->id)->get();
            foreach($cart_products as $product){
                $order->orderProducts()->create([
                    'product_id' => $product->product_id,
                    'price' => $product->product->price,
                    'quantity' => $product->quantity,
                    'sub_total' => $product->sub_total
                ]);
            }
    
            $cart->delete();
            DB::commit();
            return Redirect::route('orders.index')->withSuccess('Order Placed Successfully');
        }
        catch(\Exception $e){
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage());
        }
    }
}
