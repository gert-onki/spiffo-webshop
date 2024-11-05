<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - {{ $product->name }}</title>
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
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .product-image {
            max-width: 100%; /* Responsive image */
            height: auto; /* Maintain aspect ratio */
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
        </nav>
    </div>

    <!-- Main Content -->
    <div class="container">
        <h2 class="text-center">{{ $product->name }}</h2>
        <p><strong>Description:</strong> {{ $product->description }}</p>
        <p><strong>Price:</strong> ${{ number_format($product->price, 2) }}</p>
        <p><strong>Stock Quantity:</strong> {{ $product->stock_quantity }}</p>
        <p><strong>Created At:</strong> {{ $product->created_at }}</p>
        <p><strong>Updated At:</strong> {{ $product->updated_at }}</p>

        @if ($product->image_url)
            <p><strong>Image:</strong></p>
            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="product-image">
        @endif

        @if (Auth::check())
            <form action="{{ route('shoppingcart.store') }}" method="POST" class="mt-3">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="amount" value="1"> <!-- Adjust this as needed -->
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>
        @else
            <p>Please <a href="{{ route('login') }}">login</a> to add this product to your cart.</p>
        @endif

        <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back to Product List</a>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; {{ date('Y') }} Spiffo Webshop. All Rights Reserved.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
