<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Product Receipt</title>
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
                <h4></h4>
            </div>
            <div class="row g-0">
                <div class="col-md-5 text-center p-3">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="img-fluid" style="max-height: 300px; object-fit: contain;">
                </div>
                
                <div class="col-md-7 p-4">
                    <h4 class="card-title fw-bold">{{ $product->name }}</h4>
                    <p class="text-muted">{{ $product->description }}</p>
                    <h5 class="text-danger fw-bold my-3">₱{{ number_format($product->price, 2) }}</h5>
                    
                    <div class="mb-3">
                        <strong>Quantity:</strong> {{ $product->quantity }}
                    </div>
                    <a href="{{ route('product.index') }}" class="btn btn-primary mt-5">Back to Products</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


