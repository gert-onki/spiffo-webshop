<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spiffo Webshop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f9fa; }
        .header { background-color: #343a40; color: #fff; padding: 20px; text-align: center; }
        .nav-link { color: #fff; margin: 0 10px; }
        .container { max-width: 1000px; margin: 20px auto; text-align: center; }
        .card { margin: 10px; padding: 20px; }
        .footer { background-color: #343a40; color: #fff; padding: 10px; text-align: center; }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <h1>Welcome to Spiffo Webshop!</h1>
        <p>Get the finest food and clothing from Spiffo Restaurant</p>
        <nav>
            <a href="{{ route('products') }}" class="nav-link">Products</a>
            <a href="{{ route('cart') }}" class="nav-link">Cart</a>
            @if (!Auth::check())
                <a href="{{ route('register') }}" class="nav-link">Register</a> <!-- Register link appears only if not logged in -->
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
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <h3>Latest Products</h3>
                    <p>Explore our collection of Spiffo's exclusive items.</p>
                    <a href="{{ route('products') }}" class="btn btn-primary">View Products</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h3>Shopping Cart</h3>
                    <p>View items added to your cart and proceed to checkout.</p>
                    <a href="{{ route('cart') }}" class="btn btn-secondary">Go to Cart</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h3>Login</h3>
                    <p>Log in to manage your orders and view your account.</p>
                    <a href="{{ route('login') }}" class="btn btn-dark">Login</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Greeting Message -->
    <div class="container text-center">
        <h2>
            @if (Auth::check())
                Hello, {{ Auth::user()->name }}!
            @else
                Hello, Guest!
            @endif
        </h2>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; {{ date('Y') }} Spiffo Webshop. All Rights Reserved.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
