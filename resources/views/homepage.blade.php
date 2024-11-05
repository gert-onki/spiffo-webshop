<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spiffo Webshop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Verdana', sans-serif;
            background-color: #f4f4f4; /* Light background for better contrast */
            color: #333;
            margin: 0;
            padding: 0;
        }
        .header {
            background-color: rgba(181, 43, 43, 0.9); /* Spiffo's red with transparency */
            color: #fff;
            padding: 20px;
            text-align: center;
            position: relative;
        }
        .header img {
            width: 100%;
            height: auto;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 1;
            opacity: 0.5; /* Background image with transparency */
        }
        .header h1 {
            position: relative;
            z-index: 2;
            font-size: 2.5rem;
            margin: 10px 0;
        }
        .header p {
            position: relative;
            z-index: 2;
            font-size: 1.2rem;
            margin-bottom: 20px;
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
            max-width: 1000px;
            margin: 20px auto;
            text-align: center;
        }
        .card {
            margin: 10px;
            padding: 20px;
            border: 1px solid #b52b2b;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Soft shadow for cards */
        }
        .card h3 {
            color: #b52b2b;
        }
        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .slogan {
            font-style: italic;
            margin-top: 10px;
            font-size: 1.2rem;
            color: #fff; /* White for better contrast against the red */
            z-index: 2;
            position: relative;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <img src="https://example.com/spiffo-restaurant-bg.jpg" alt="Spiffo Restaurant" /> <!-- Replace with your image URL -->
        <h1>Welcome to Spiffo Webshop!</h1>
        <p>Get the finest food and clothing from Spiffo Restaurant</p>
        <div class="slogan">“Where Every Bite Feels Like Home!”</div>
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
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <h3>Latest Products</h3>
                    <p>Explore our collection of Spiffo's exclusive items.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">View Products</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <h3>Shopping Cart</h3>
                    <p>View items added to your cart and proceed to checkout.</p>
                    <a href="{{ route('shoppingcart.index') }}" class="btn btn-secondary">Go to Cart</a>
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
