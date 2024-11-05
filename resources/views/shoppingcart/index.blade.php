<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>
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
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: rgba(181, 43, 43, 0.8); /* Header background */
            color: white;
        }
        td button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        td button:hover {
            background-color: #0056b3;
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
        <h2>Your Shopping Cart</h2>
        
        @if ($items->isEmpty())
            <p class="text-center">No items in your cart.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Amount</th>
                        <th>Total Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->product->description }}</td>
                            <td>${{ number_format($item->product->price, 2) }}</td>
                            <td>
                                <form action="{{ route('shoppingcart.update', $item->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" name="action" value="decrement" class="btn btn-secondary btn-sm">-</button>
                                    <input type="number" name="amount" value="{{ $item->amount }}" min="1" style="width: 50px; text-align: center;" readonly>
                                    <button type="submit" name="action" value="increment" class="btn btn-secondary btn-sm">+</button>
                                </form>                            
                            </td>
                            <td>${{ number_format($item->product->price * $item->amount, 2) }}</td>
                            <td>
                                <form action="{{ route('shoppingcart.destroy', $item->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">Continue Shopping</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
