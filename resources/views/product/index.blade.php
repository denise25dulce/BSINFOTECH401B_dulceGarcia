<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>CRUD Products</title>
    
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
        <div class="row">
            <div class="col-md-12">
                @session('success')
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endsession
                
                <div class="card">
                    <div class="card-header">
                        <h4>Product List
                            <a href="{{ route('product.create') }}" class="btn btn-primary float-end">Add Product</a>
                        </h4>
                    </div>
                    <div class="d-flex justify-content-end">
                        <form action="{{ route('product.index') }}" method="GET">
                            <div class="input-group p-3">
                                <input type="text" name="search" class="form-control" placeholder="Search by product name" value="{{ request('search') }}" style="width: 70%; margin-top: 10px;">
                                <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($product as $products)
                                <div class="col-md-4">
                                    <div class="card mb-4 shadow-sm">
                                        <img src="{{ asset('storage/' . $products->image) }}" alt="Product Image" class="card-img-top img-fluid p-1" style="height: 200px; width: 100%; object-fit: contain; margin-top: 10px;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $products->name }}</h5>
                                            <p class="card-text">
                                                {{ Str::limit($products->description, 100, '...') }}
                                            </p>
                                            <p class="mb-1"><strong>Price:</strong> ₱{{ $products->price }}</p>
                                            <p><strong>Quantity:</strong> {{ $products->quantity }}</p>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <a href="{{ route('product.edit', $products->id) }}" class="btn btn-info btn-sm">Edit</a>
                                                <a href="{{ route('product.show', $products->id) }}" class="btn btn-secondary btn-sm">View</a>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $products->id }}">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-3">
                            {{ $product->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const productId = button.getAttribute('data-id');
            const deleteForm = document.getElementById('deleteForm');
            deleteForm.action = `/products/${productId}`;
        });
    </script>
</body>
</html>
