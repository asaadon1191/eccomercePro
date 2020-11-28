@extends('layouts.users')
@section('title')
    Create New Order
@endsection

@section('page_name')
    Add Product {{ $product->name }} To Card
@endsection

@section('content')
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">{{ $product->name }}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">{{ $product->price }}
                <i class="fas fa-minus" mr-5> </i>
                </button>
            </div>
        </div>
        <div class="card-body">
           <form action="{{ route('store.cart',$product->id) }}" method="POST">
               @csrf

                <div class="form-group">
                   <label for="">Product Id</label>
                    <input type="number" id="inputEstimatedBudget" class="form-control" value="{{ $product->id }}" step="1" name="product_id">
                </div>
                <div class="form-group">
                    <label for="inputSpentBudget">User Id</label>
                    <input type="number" id="inputSpentBudget" class="form-control" value="{{ auth()->user()->id }}" step="1" name="user_id">
                </div>
                <div class="form-group">
                    <label >Quantity</label>
                    <input type="number" id="inputEstimatedDuration" class="form-control" value="0" name="quantity">
                </div>

                <div class="form-group">
                    
                    <input type="submit" class="form-control btn btn-success" value="Create">
                </div>
           </form>
        </div>
        <!-- /.card-body -->
    </div>
@endsection