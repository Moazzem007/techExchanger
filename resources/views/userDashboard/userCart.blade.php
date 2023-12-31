@extends('userDashboard.userDashboard')
@section('userContent')

    <div class="container">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>My Cart</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>

                                            <th>Category</th>
                                            <th>Condition</th>
                                            <th>Authenticity</th>
                                            <th>Brand Name</th>
                                            <th>Model</th>
                                            <th>Release Date</th>
                                            <th>Features</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cartProducts as $cartProduct)
                                        @foreach($products as $product)
                                            @if($product->id == $cartProduct->product_id)
                                            <tr>
                                                <td>
                                                    @foreach($categories as $category)
                                                        @if($product->category_id == $category->id) {{$category->category_name}} @endif
                                                    @endforeach
                                                </td>
                                                <td>{{$product->condition}}</td>
                                                <td>{{$product->authenticity}}</td>
                                                <td>{{$product->brand_name}}</td>
                                                <td>{{$product->model}}</td>
                                                <td>{{$product->release_date}}</td>
                                                <td>{{$product->features}}</td>
                                                <td>{{$product->description}}</td>
                                                <td>{{$product->price}}</td>
                                                <td><img style="height: 50%; width: auto;" src="{{ asset($product->image1) }}" alt=""></td>


                                                <td>
                                                    <a href="{{route('cart.delete', $product->id)}}" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a>
                                                    <a href="{{route('buy.now', $product->id)}}" class="btn btn-sm btn-info" style="text-decoration: none; color: black; margin-top: 10px;">Buy now</a>
                                                </td>
                                            </tr>
                                                @break
                                            @endif
                                        @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </section>
        </div>


@endsection
