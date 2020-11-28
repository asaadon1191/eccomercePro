@extends('layouts.users')
@section('title')
    Product Detailes 
@endsection

@section('page_name')
    Product Detailes    
@endsection


@section('content')
    <div class="container">
       <div class="card">
           <div class="card-header">
               <h1 class="text-center">
                    {{ $product->name }}
               </h1>
           </div>
           <div class="card-body">
            <img style="width: 150px; height: 100px;" src="{{ asset('assets/admin/images/'. $product->photo) }}" class="text-center">

               <h3>
                    {{ $product->name }}    
               </h3>
               <h3>
                    {{ $product->price }}    
               </h3>
               <h3>
                    {{ $product->quantity }}    
               </h3>
               <h3>
                    {{ $product->description }}    
               </h3>
           </div>
       </div>
    </div>
@endsection
