<?php

namespace App\Http\Controllers;

use App\Models\CartItems;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function sync(Request $request)
    {
        $user = User::find($request->user_id);
        // dd($request->cart);
        $cart = collect($request->cart)->map(function ($item) {
            return [
                'id' => $item['id'],
                'quantity' => $item['quantityPurchase'] ?? 1, // Default to 1 if quantity not provided
            ];
        });
        foreach ($cart as $key => $value) {
            // Validate each item in the cart
            if (!isset($value['id']) || !is_numeric($value['id'])) {
                return response()->json(['error' => 'Invalid product ID'], 400);
            }
            if (!isset($value['quantity']) || !is_numeric($value['quantity']) || $value['quantity'] < 1) {
                return response()->json(['error' => 'Invalid quantity'], 400);
            }
            // Here you would typically check if the product exists in your database
            // and if the user has permission to add it to their cart.
            // For example:
            $product = Product::find($value['id']);
            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }
            
            // Optionally, you can also check if the product is available in stock
            if ($product->stock < $value['quantity']) {
                return response()->json(['error' => 'Insufficient stock for product ID ' . $value['id']], 400);
            }
            // You can also check if the product is active or available for sale
            if ($product->status !== 'active') {
                return response()->json(['error' => 'Product ID ' . $value['id'] . ' is not available for sale'], 400);
            }
            // Check if the item already exists in the user's cart
            $cartItems = CartItems::where('user_id',$user->id)->where('product_id',$value['id']);
            if ($cartItems->exists()) {
                // If the item already exists in the cart, update the quantity
                $cartItem = $cartItems->first();
                $cartItem->quantity = $value['quantity'];
                $cartItem->save();
            } else {
                // If the item does not exist, create a new cart item
                $cartItem = new CartItems();
                $cartItem->user_id = $user->id;
                $cartItem->product_id = $value['id'];
                $cartItem->quantity = $value['quantity'];
                $cartItem->save();
            }
        }
        // Save $request->cart to user's cart in DB
        // ...your logic here...
        return response()->json(['status' => 'success', 'data' => $request->cart]);
    }

    // app/Http/Controllers/CartController.php
    public function getUserCart($userId)
    {
        $cartItems = \DB::table('cart_items')
            ->join('products', 'cart_items.product_id', '=', 'products.id')
            ->where('cart_items.user_id', $userId)
            ->select(
                'products.*',
                'cart_items.quantity as quantityPurchase'
            )
            ->get();

        // If you store JSON fields (like images, variation, sizes), decode them:
        $cartItems->transform(function ($item) {
            $item->name = $item->title ?? '';
            $item->thumbImage = explode(',', $item->photo) ?? '[]';
            $item->images = explode(',', $item->photo) ?? '[]';
            $item->variation = json_decode($item->variation ?? '[]');
            $item->sizes = json_decode($item->sizes ?? '[]');
            return $item;
        });

        return response()->json(['cart' => $cartItems]);
    }

    public function removeCartItem($userId, $productId)
    {
        \DB::table('cart_items')
            ->where('user_id', $userId)
            ->where('product_id', $productId)
            ->delete();

        return response()->json(['status' => 'success']);
    }
}
