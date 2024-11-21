<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Add Product</title>
</head>
<body>
    <style>
        body {
            background-color: #EAD8C0;
        }
        .card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .btn-custom {
            background-color: #6096B4;
            color: #fff;
        }
        .btn-custom:hover {
            background-color: #8096B4;
        }
    </style>
    <div class="container mt-5">
    

        <div class="card mb-4">
            <div class="text-center card-header">
                <h4>Edit Product</h4>
            </div>
            <div class="card-body">
                <form action="{{route('product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        @if($product->image)
                            <div>
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="img-thumbnail mb-2" style="width: 100px; height: auto;">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control" accept="image/*">
                        @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                    </div> 
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" name="name" class="form-control" value="{{$product->name}}" >
                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Product Description</label>
                        <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                        @error('description') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" step="0.01" min="0.01" value="{{$product->price}}">
                        @error('price') <span class="text-danger">{{$message}}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" class="form-control" value="{{$product->quantity}}">
                        @error('quantity') <span class="text-danger">{{$message}}</span> @enderror
                    </div>                  
                    <a href="{{route('product.index')}}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary float-end">Update Product</button>
                </form>
            </div>
        </div>
    </div>
    

