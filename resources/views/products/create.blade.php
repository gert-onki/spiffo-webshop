<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
</head>
<body>
    <h1>Add New Product</h1>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <br>
    
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>
        <br>
    
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" step="0.01" required>
        <br>
    
        <label for="image">Image:</label>
        <input type="file" name="image" id="image" accept="image/*">
        <br>
    
        <label for="stock_quantity">Stock Quantity:</label>
        <input type="number" name="stock_quantity" id="stock_quantity" required>
        <br>
    
        <button type="submit">Add Product</button>
    </form>
    <a href="{{ route('products.index') }}" class="nav-link">Products</a>
</body>
</html>
