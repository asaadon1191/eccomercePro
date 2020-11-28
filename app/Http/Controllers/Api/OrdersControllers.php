<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Users\Cart;
use App\Api\Cartapi;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class OrdersControllers extends Controller
{

    public function index()
    {
        $orders = Order::all();
        return apiResponse("",200,$orders);
    }

    public function store(Request $request)
    {
                $user = User::with('cartsApi')->find(auth()->user()->id);
                $total_prices =  $user->cartsApi->where('status','pending')->sum('total_price');  // TOTAL PRICES
                $total_qty =  $user->cartsApi->where('status','pending')->sum('qty');            // TOTAL QTY
                $status =  $user->cartsApi->where('status','pending')->pluck('status');          // ITEMS STATUS
                $items =  $user->cartsApi->where('status','pending');                            //PENDING CART ITEMS 
                

                // return $status;
        // CREATE NEW ORDER IN DATABASE
        DB::beginTransaction();

                $order = new Order();

                $order->order_number    = uniqid('ORD.');
                $order->user_id         = \auth()->user()->id;
                $order->total_price     = $total_prices; //total price for all items in this cart 

                $order->save();

        // CHANGE ITEMS STATUS
        if($items->pluck('status') == 'pindind' && $items->pluck('status')->count() > 0)
        {
            foreach($items as $value)
            { 
                $value->update(
                    [
                        'status' => 'completed',
                        'order_id' => $order->id,
                    ]);
                    // var_dump($value->status);
            }

        }else
        {
            $order->id;
        }
               

                
        // CREATE DATA IN PAIVOTE TABLE ORDER_PRODUCT
                $order->productes()->attach($items->pluck('id'));
        DB::commit();

                return apiResponse("New order created successfaly",200,$order);
        DB::rollback();

    }

    public function show($id)
    {
        $order = Order::with('productes')->find($id);
        return apiResponse("",200,$order);
    }


    public function update($id)
    {
        $order = Order::find($id);

       if($order->status == 'pending')
       {
            $order->update(
            [
                'status' => 'completed'
            ]);
       }else
       {
            $order->update(
            [
                'status' => 'pending'
            ]);
       }

            return apiResponse("Order Updated Successfaly",200,$order);
    }
        
   
}
