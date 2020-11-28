@extends('layouts.users')
@section('title')
    Show Cart
@endsection

@section('page_name')
    Show Cart Items
@endsection

@section('content')
    
{{--  ALERTS  --}}
    @include('layouts.includes.alerts.errors')
    @include('layouts.includes.alerts.success')
{{--  ALERTS  --}}
    <div class="container">
        <div class="row">
            @if($cart)
            <div class="col-md-8">
                    @foreach( $cart->items as $product)
                            <div class="card mb-2">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{--  {{ $product['name'] }}  --}}
                                    </h5>
                                    <div class="card-text">
                                        ${{ $product['price'] }}

                                        <div class="row">
                                            <div class="col-md-9">
                                                <form action="{{ route('update.cart',$product['id']) }}" method="post">
                                                    @csrf
                                                    @method('PUT')

                                                    <input type="number" name="qty" id="qty" value={{ $product['qty']}}>
                                                    <input type="submit" name="submit" value="Update" class="btn btn-primary btn-sm">

                                                </form>
                                            </div>
                                            <div class="col-md-3">
                                                <a href="{{ route('delete.cart',$product['id']) }}" class="btn btn-danger btn-sm ml-4">Remove</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
                    <p><strong>Total : ${{$cart->totalPrice}}</strong></p>

            </div>

            <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h3 class="card-titel">
                        Your Cart
                        <hr>    
                    </h3>
                    <div class="card-text">
                        <p>
                        Total Amount is ${{$cart->totalPrice}}
                        </p>
                        <p>
                        Total Quantities is {{$cart->totalQty}}
                        </p>
                        <a href="{{ route('cart.checkOut',$cart->totalPrice) }}" class="btn btn-info">Checkout</a>
                    </div>
                </div>
            </div>
            </div>
            @else
            <p>There are no items in the cart</p>

            @endif
        </div>
    </div>
    
@endsection