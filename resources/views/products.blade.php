<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>
    <h1>Our Products</h1>
    <div class="container text-center">
        <h2>
            @if (Auth::check())
                Hello, {{ Auth::user()->name }}!
            @else
                Hello, Guest!
            @endif
        </h2>
    </div>
</body>
</html>
