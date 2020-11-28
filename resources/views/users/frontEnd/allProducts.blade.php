@extends('layouts.users')
@section('title')
    All Products
@endsection

@section('page_name')
    All Products For Users
@endsection

@section('content')
   <div class="container">
       
    {{--  {{ print_r(session()->get('cart')) }}  --}}
    @include('layouts.includes.alerts.success')
    @include('layouts.includes.alerts.errors')
    <br><br>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                    <div class="card bg-light">
                    

                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-5 text-center">
                                <img src="{{ asset('assets/admin/images/'. $product->photo) }}" alt="user-avatar" class="" height="200px" width="120px">
                            </div>
                            <div class="col-7">
                                <h2 class="lead"><b>{{ $product->name }}</b></h2>
                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                    <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> 
                                        <strong>
                                            Quantity :
                                        </strong>  {{ $product->quantity }}
                                    </li><br>

                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> 
                                            <strong>
                                                Price :
                                            </strong>  {{ $product->price }}
                                        </li><br>
                                </ul><br>
                                <p class="text-muted text-sm"><b style="color: #2d2d2d; font-size:25px">Description </b><br> Web Designer / UX / Graphic Artist {{ $product->description }} </p>

                            </div>
                        
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="text-right">
                        <a href="{{ route('products.show',$product->id) }}" class="btn btn-sm bg-teal">
                            <i class="fas fa-comments">
                                More Detailes
                            </i>
                        </a>
                        <a href="{{ route('store.cart',$product->id) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-user"></i> Add To Card
                        </a>
                        </div>
                    </div>
                    </div>
                </div> 
            @endforeach
        </div>   
   </div>
@endsection