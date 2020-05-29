<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cart;

class CartController extends Controller
{
    public function index(){
        $user = session('user');

        $cart = Cart::where(['user_id'=>$user->member_id])->get();
        // dd($cart);

        $cart_id = array_column($cart->toArray(),'cart_id');
        $buy_number = array_column($cart->toArray(),'buy_number');
        // dump($cart_id);
        // dd($buy_number);
        
        $buyData = array_combine($cart_id,$buy_number);

        $buycount = array_sum($buy_number);
        // dd($buycount);
        return view('index.cart',['cart'=>$cart,'buyData'=>$buyData,'buycount'=>$buycount]);
    }
}
