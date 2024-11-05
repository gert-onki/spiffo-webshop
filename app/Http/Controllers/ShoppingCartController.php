<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    // Method to show the shopping cart
    public function index()
    {
        // Get cart items for the logged-in user
        $items = ShoppingCart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        return view('shoppingcart.index', compact('items'));
    }

    public function update(Request $request, $id)
    {
        // Find the cart item
        $item = ShoppingCart::findOrFail($id);
    
        // Determine the action based on the submitted button
        if ($request->action === 'increment') {
            $item->amount += 1; // Increase the amount by 1
        } elseif ($request->action === 'decrement' && $item->amount > 1) {
            $item->amount -= 1; // Decrease the amount by 1, but not below 1
        }
    
        // Save the updated item
        $item->save();
    
        return redirect()->route('shoppingcart.index')->with('success', 'Cart updated successfully!');
    }
    

    public function destroy($id)
    {
        // Remove the item from the shopping cart
        $item = ShoppingCart::findOrFail($id);
        $item->delete();

        return redirect()->route('shoppingcart.index')->with('success', 'Item removed from cart!');
    }


    public function store(Request $request)
    {
        // Ensure the user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to add items to your cart.');
        }

        $userId = Auth::id();
        $productId = $request->input('product_id');
        $amount = $request->input('amount', 1); // Default amount is 1 if not specified

        // Check if the item is already in the shopping cart
        $cartItem = ShoppingCart::where('user_id', $userId)
                                ->where('product_id', $productId)
                                ->first();

        if ($cartItem) {
            // If it already exists, increase the quantity
            $cartItem->amount += $amount;
            $cartItem->save();
        } else {
            // If it doesn't exist, create a new cart item
            ShoppingCart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'amount' => $amount,
            ]);
        }

        return redirect()->route('shoppingcart.index')->with('success', 'Product added to cart successfully!');
    }
}
