<?php

namespace App\Http\Controllers\Users;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsRequest;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        try
        {
            $productes = Product::paginate(10);
            return \view('users.products.index',\compact('productes'));
            
        }catch(\Throwable $th)
        {
            return $th;
            return \redirect()->route('products')->with(['errors' => 'We Have An Error Please Try Again Later']);
        }
        
    }

    public function create()
    {
        try
        {
            return \view('users.products.create');
            
        }catch(\Throwable $th)
        {
            return $th;
            return \redirect()->route('products')->with(['errors' => 'We Have An Error Please Try Again Later']);
        }
    }

    public function store(ProductsRequest $request)
    {
        try
        {
            // return $request;

        // CHECK PHOTO
            if ($request->hasFile('photo')) 
            {
                $photo =  $request->photo->store('products','public');
            }   
            // \dd($request->photo);

        // CREATE DATA
        
        DB::beginTransaction();
            $product = Product::create(
                [
                    'name'          => $request->name,
                    'price'         => $request->price,
                    'quantity'      => $request->quantity,
                    'description'   => $request->description,
                ]);

                $product->photo = $photo;
                $product->save();

        DB::commit();

                return \redirect()->route('products')->with(['success' => 'The New Product Created Succeffaly']);
            
        }catch(\Throwable $th)
        {
            DB::rollback();
            return $th;
            return \redirect()->route('products')->with(['errors' => 'We Have An Error Please Try Again Later']);
        }
    }

    public function show($id)
    {
        try
        {
            $product  = Product::find($id);

            if($product)
            {
                return \view('users.products.show',\compact('product'));
            }else
            {

            }

        }catch(\Throwable $th)
        {
            return $th;
            return \redirect()->route('products')->with(['errors' => 'We Have An Error Please Try Again Later']);
        }
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return \view('users.products.edit',\compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        try
        {
            // return $request;
            if($product)
            {
            // CREATE DATA
            
            DB::beginTransaction();
            
                $update = $product->update(
                    [
                        'name'          => $request->name,
                        'price'         => $request->price,
                        'quantity'      => $request->quantity,
                        'description'   => $request->description,
                    ]);

                // UPDATE PHOTO 
                    if ($request->hasFile('photo')) 
                    {
                        Storage::disk('public')->delete('/assets/admin/images/',$product->photo);
                        $photo =  $request->photo->store('products','public');
                        $product->update(['photo' => $photo]);
                    }
                   

            DB::commit();

                    return \redirect()->route('products')->with(['success' => 'The Product Updated Succeffaly']);
                

            }
        }catch(\Throwable $th)
        {
            DB::rollback();
            return $th;
            return \redirect()->route('products')->with(['errors' => 'We Have An Error Please Try Again Later']);
        }
    }


    public function delete($id)
    {
        try 
        {
            // GET PRODUCT
                $product = Product::find($id);

                if (!$product) 
                {
                    return \redirect()->back()->with(['errors' =>'this brand not found']);

                }else
                {
                    Storage::disk('public')->delete('/assets/admin/images/',$product->photo);
                    $product->delete();
                    return \redirect()->back()->with(['success' => 'This product deleted succeessfally']);
                }

        } catch (\Throwable $th) 
        {
            return $th;
            return \redirect()->route('products')->with(['error' => 'Something Error Please Try Again Later']);

        }
    }











    
}
