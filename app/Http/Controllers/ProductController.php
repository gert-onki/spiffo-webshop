<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Retrieve all products from the database
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    // Store the new product in the database
    public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        // Handle file upload if exists
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Store image in the 'public/images' folder
        }

        // Create and save new product
        Product::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'image_url' => $imagePath,
            'stock_quantity' => $request->input('stock_quantity'),
        ]);

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id); // Find the product or fail if not found
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        // Find the product
        $product = Product::findOrFail($id);
        
        // Handle file upload if exists
        $imagePath = $product->image_url; // Keep the current image path
        if ($request->hasFile('image')) {
            // Store the new image and update the path
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Update the product
        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'image_url' => $imagePath,
            'stock_quantity' => $request->input('stock_quantity'),
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Optionally, delete the image file if it exists
        if ($product->image_url) {
            Storage::disk('public')->delete($product->image_url);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id); // Find the product or fail if not found
        return view('products.show', compact('product')); // Return the show view with product data
    }

}
