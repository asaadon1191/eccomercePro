<?php

namespace App\Http\Controllers\Api;

use App\Api\Cartapi;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartapiController extends Controller
{
    public function store(Request $request,$id)
    {
        $pro = Product::find($id);

        // return ;
        $order = new Cartapi();

        $order->user_id         = \auth()->user()->id;
        $order->product_id      = $pro->id;
        $order->qty             = $request->qty; //qty
        // $order->status          = $request->status; //qty
        $order->total_price     = $request->qty * $pro->price; //total price for row 
        $order->save();

        
        $order->productes()->attach($pro->id);
        $order->users()->attach(auth()->user()->id);
    
        return apiResponse($order,200);
    }
}
