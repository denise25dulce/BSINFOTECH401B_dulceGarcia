<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>CRUD Products</title>
    
</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            @session('success')
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endsession

            <div class="card">
                <div class="card-header">
                    <h4>CRUD Product
                        <a href="{{route('product.create')}}" class="btn btn-primary float-end">Add Product</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-stiped table-bordered">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Product Image</th>
                                <th>Action</th>
                            </tr>
                            <tbody>
                                @foreach ($product as $products)
                                <tr>
                                    
                                    <td>{{$products->name}}</td>
                                    <td>{{$products->description}}</td>
                                    <td>{{$products->price}}</td>
                                    <td>{{$products->quantity}}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $products->image) }}" alt="Product Image" class="img-thumbnail" style="width: 100px; height: auto;">
                                    </td>
                                    
                                    <td>
                                        <a href="{{route('product.edit', $products->id)}}" class="btn btn-info">Edit</a>
                                        <a href="{{route('product.show', $products->id)}}" class="btn btn-info">View</a>
                                           
                                    </td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                        </thead>
                    </table>
                    {{$product->links()}}
                </div>
            </div>
        </div>
    </div>
</div>