@extends('layouts.users')

@section('title')
    Products
@endsection

@section('page_name')
    All Products
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
        <div class="col-12">

            <div class="card">
            <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
                <a href="{{ route('products.create') }}" class="btn btn-danger">
                <strong>
                    Create
                    </strong> 
                </a>
            </div>
            <!-- /.card-header -->
                <div class="card-body">

    {{--  ALERTS  --}}
                @include('layouts.includes.alerts.errors')
                @include('layouts.includes.alerts.success')
    {{--  ALERTS  --}}

                @if ($productes && $productes->count() > 0)
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                                        ID
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">
                                        Name
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                        Price
                                    </th>


                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                        Quantity
                                    </th>

                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">
                                        Photo
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">
                                        Controlles
                                    </th>
                                
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $x = 1;
                                @endphp
                            @foreach ($productes as $product)
                                <tr role="row" class="odd">
                                    <td class="dtr-control sorting_1" tabindex="0">
                                        {{ $x++ }}
                                    </td>
                                    <td>
                                        {{ $product->name }}
                                    </td>
                                    <td>
                                        {{ $product->price }}
                                    </td>
                                    <td>
                                        {{ $product->quantity }}
                                    </td>
                                    <td>
                                        <img style="width: 150px; height: 100px;" src="{{ asset('assets/admin/images/'. $product->photo) }}">

                                    </td>
                                    <td>
                                        <a href="{{ route('products.show',$product->id) }}" class="btn btn-success">
                                            More Detailes
                                        </a>
                                        <a href="{{ route('products.edit',$product->id) }}" class="btn btn-primary">
                                            Edit
                                        </a>
                                        <a href="{{ route('products.delete',$product->id) }}" class="btn btn-danger">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        
                            </tbody>
                                    
                            </table>
                            </div>
                            </div>
                                
                            </div>
                @else
                    <h1 class="text-center">
                            No Products
                    </h1>
                @endif
                
            </div>
            <!-- /.card-body -->
    </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@endsection