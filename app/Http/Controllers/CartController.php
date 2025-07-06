<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = $this->getOrCreateCart();
        $items = $cart->items()->with('product.category')->get();

        $subtotal = $items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // No shipping, so total equals subtotal
        $total = $subtotal;

        return view('frontend.cart', compact('items', 'subtotal', 'total'));
    }

    public function add(Request $request, $productId)
    {
        $product = Product::active()->findOrFail($productId);
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'size' => 'nullable|string',
            'color' => 'nullable|string',
        ]);

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Not enough stock available');
        }

        $cart = $this->getOrCreateCart();

        $existingItem = $cart->items()
            ->where('product_id', $productId)
            ->where('selected_size', $request->size)
            ->where('selected_color', $request->color)
            ->first();

        if ($existingItem) {
            $newQuantity = $existingItem->quantity + $request->quantity;
            if ($product->stock < $newQuantity) {
                return back()->with('error', 'Not enough stock available');
            }
            $existingItem->update(['quantity' => $newQuantity]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $request->quantity,
                'selected_size' => $request->size,
                'selected_color' => $request->color,
            ]);
        }

        return redirect()->route('cart')->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $itemId)
    {
        try {
            $request->validate([
                'quantity' => 'required|integer|min:1',
            ]);

            $item = CartItem::with('product')->findOrFail($itemId);

            if ($item->product->stock < $request->quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Not enough stock available',
                    'current_stock' => $item->product->stock
                ], 400);
            }

            $item->quantity = $request->quantity;
            $item->save();

            $cart = $this->getOrCreateCart();
            $items = $cart->items()->with('product')->get();

            $subtotal = $items->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            $total = $subtotal;

            return response()->json([
                'success' => true,
                'item_id' => $item->id,
                'item_total' => number_format($item->product->price * $item->quantity, 2),
                'subtotal' => number_format($subtotal, 2),
                'total' => number_format($total, 2),
                'new_quantity' => $item->quantity
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating cart: ' . $e->getMessage()
            ], 500);
        }
    }

    public function remove($itemId)
    {
        $item = CartItem::findOrFail($itemId);
        $item->delete();

        return back()->with('success', 'Item removed from cart!');
    }

    protected function getOrCreateCart()
    {
        if (Auth::check()) {
            return Cart::firstOrCreate(['user_id' => Auth::id()]);
        }

        $sessionId = session()->getId();
        return Cart::firstOrCreate(['session_id' => $sessionId]);
    }
}
