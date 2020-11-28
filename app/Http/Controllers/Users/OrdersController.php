<?php

namespace App\Http\Controllers\Users;

use App\Users\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function allProducts()
    {
        $products = Product::all();
        return view('users.frontEnd.allProducts',compact('products'));
    }

   
    public function addToCart(Product $product)
    {
        if(\session()->has('cart'))
        {
            $cart = new Cart(session()->get('cart'));
        }else
        {
            $cart = new Cart();
        }

        $cart->add($product);
        // dd($cart);
        // return $cart;

        session()->put('cart',$cart);
        return redirect()->back()->with(['success' => 'Product Added To Cart Successfaly']);
    }


    public function showCartPage()
    {
        
        // CHECK IF SESSION IS EXSISTES
            if(session()->has('cart'))
            {
                $cart = new Cart(session()->get('cart'));

            }else
            {
                $cart = null;
            }

            return view('users.cart.show',compact('cart'));
    }



    

    public function checkOut($totalPrice)
    {
        return view('users.cart.checkOut',\compact('totalPrice'));
    }

    public function storeOrder(Request $request,$totalPrice)
    {
       
       $user = auth()->user()->id;
       
       $create = Order::create(
           [
                'cart' => \serialize(\session()->get('cart')),
                'user_id' => $user,
                'total_price' => $totalPrice,
           ]);

           session()->forget('cart');

           return \redirect()->route('all.products.users')->with(['success' => 'The New Order Added Successfaly To dataBase']);
    }


    public function index()
    {

        $orders = auth()->user()->orders;
        $carts = $orders->transform(function($cart,$key)
        {   
            return \unserialize($cart->cart);
        });

       
        return \view('users.cart.index',\compact('carts','orders'));
    }


   


    public function updatePro(Request $request, Product $product)
    {
        $request->validate([
            'qty' => 'required|numeric|min:1'
        ]);

        $cart = new Cart(session()->get('cart'));
        $cart->updateQty($product->id, $request->qty);
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product updated');
    }


    public function deletePro(Product $product)
    {
        $cart = new Cart(session()->get('cart'));
        $cart->remove($product->id);

        if ($cart->totalQty <= 0) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product was removed');
    }

}
