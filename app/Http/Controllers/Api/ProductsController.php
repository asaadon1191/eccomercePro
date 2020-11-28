<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductsRequest;

class ProductsController extends Controller
{
    
   
    public function index()
    {
        $products = Product::all();
        return apiResponse('All Products',200,$products);
    }

   

   
    public function store(ProductsRequest $request)
    {
        // return $request;
        $create = Product::create(
            [
                    'name'          => $request->name,
                    'price'         => $request->price,
                    'quantity'      => $request->quantity,
                    'description'   => $request->description,
            ]);

           
        return apiResponse('New Product Created Successfaly',200,$create);
    }

   


    public function show($id)
    {
        $product = Product::find($id);

        if($product)
        {
            return apiResponse('',200,$product);
        }else
        {
            return apiResponse('Product Not Found',400);
        }
    }




    public function update(ProductsRequest $request, $id)
    {
        
        $product = Product::find($id);
        
        if($product)
        {
            // return $product;

            $product->name =$request->name;
            $product->quantity =$request->quantity;
            $product->price =$request->price;
            $product->description =$request->description;
            $product->save();

            return apiResponse('The Product Updated Successfaly',200,$product);
        }else
        {
            return apiResponse('Product Not Found',400);
        }
    }

   
    public function destroy($id)
    {
        $product = Product::find($id);
        
        if($product)
        {
            $product->delete();
            return apiResponse('The Product Deleted Successfaly',200);

        }else
        {
            return apiResponse('Product Not Found',400);
        }
    }
}
