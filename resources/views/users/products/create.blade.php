@extends('layouts.users')

@section('title')
    Create Product    
@endsection

@section('page_name')
    Create New Product    
@endsection

@section('content')
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Product Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Product Name" name="name">
                @error("name")
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="">product Quantity</label>
                <input type="number" class="form-control"  placeholder="Quantity Of Product" name="quantity">
                @error("quantity")
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="">product price</label>
                <input type="number" class="form-control"  placeholder="Price Of Product" name="price">
                @error("price")
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="">product Describtion</label>
                <textarea class="form-control" rows="3" placeholder="Enter ..." name="description">

                </textarea>
                @error("description")
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="">Product Photo</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="photo">
                        <label class="custom-file-label">Choose file</label>
                        @error("photo")
                             <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>    
@endsection