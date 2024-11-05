<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Verdana', sans-serif;
            background-color: #f4f4f4; /* Light background for better contrast */
        }
        .header {
            background-color: rgba(181, 43, 43, 0.9); /* Spiffo's red */
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        .nav-link {
            color: #fff;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
        }
        .nav-link:hover {
            text-decoration: underline;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.2s;
        }
        .product-card:hover {
            transform: scale(1.05);
        }
        .product-card img {
            width: 100%; /* Makes the image fill the width of the card */
            height: 200px; /* Fixed height for all images */
            object-fit: cover; /* Ensures images are cropped appropriately */
            border-radius: 8px 8px 0 0; /* Rounded corners for the top */
        }
        .product-info {
            padding: 15px;
            text-align: center;
        }
        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    @php
    $admin = 0;
    @endphp

    <!-- Header -->
    <div class="header">
        <h1>Spiffo Webshop</h1>
        <nav>
                <a href="{{ route('home') }}" class="nav-link">Home</a>
                <a href="{{ route('products.index') }}" class="nav-link">Products</a>
                <a href="{{ route('shoppingcart.index') }}" class="nav-link">Cart</a>
                @if (!Auth::check())
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                @endif
                @if (Auth::check())
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                @endif
            @if (Auth::check())
                @php
                    $admin = Auth::user()->is_admin == 1 ? 1 : 0;
                @endphp
            @endif
        </nav>
    </div>
    @if ($admin == 1)
        <div class="text-end mb-3">
            <a href="{{ route('products.create') }}" class="btn btn-success">Add New Product</a>
        </div>
    @endif

    <!-- Main Content -->
    <div class="container">
        <h2 class="text-center my-4">Our Products</h2>
        
        <div class="row">
            @if ($products->isEmpty())
                <div class="col-12 text-center">
                    <p>No products available.</p>
                </div>
            @else
                @foreach ($products as $product)
                    <div class="col-md-3">
                        <div class="product-card">
                            <a href="{{ route('products.show', $product->id) }}">
                                <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}">
                                <div class="product-info">
                                    <h5>{{ $product->name }}</h5>
                                    <p>${{ number_format($product->price, 2) }}</p>
                                    @if ($admin == 1)
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach 
            @endif
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; {{ date('Y') }} Spiffo Webshop. All Rights Reserved.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
