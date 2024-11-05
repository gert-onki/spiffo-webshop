<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <h1>Edit Product: {{ $product->name }}</h1>

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

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>
        <br>

        <label for="description">Description:</label>
        <textarea name="description" id="description">{{ old('description', $product->description) }}</textarea>
        <br>

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" step="0.01" value="{{ old('price', $product->price) }}" required>
        <br>

        <label for="image">Image:</label>
        <input type="file" name="image" id="image" accept="image/*">
        <br>
        <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" width="100"> <!-- Show current image -->
        <br>

        <label for="stock_quantity">Stock Quantity:</label>
        <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
        <br>

        <button type="submit">Update Product</button>
    </form>
    <a href="{{ route('products.index') }}" class="nav-link">Products</a>
</body>
</html>
