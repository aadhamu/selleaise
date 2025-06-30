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
        
        $shipping = 100;
        $total = $subtotal + $shipping;
        
        return view('frontend.cart', compact('items', 'subtotal', 'shipping', 'total'));
    }
    
    public function add(Request $request, $productId)
    {
        $product = Product::active()->findOrFail($productId);
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'size' => 'nullable|string',
            'color' => 'nullable|string',
        ]);
        
        $product = Product::active()->findOrFail($productId);
        
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
    
    // public function update(Request $request, $itemId)
    // {
    //     $request->validate([
    //         'quantity' => 'required|integer|min:1',
    //     ]);
    
    //     $item = CartItem::with('product')->findOrFail($itemId);
    
    //     if ($item->product->stock < $request->quantity) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Not enough stock available'
    //         ], 400);
    //     }
    
    //     // Update the quantity
    //     $item->update(['quantity' => $request->quantity]);
    
    //     // Refresh the item to get updated values
    //     $item->refresh();
    
    //     // Get updated cart data
    //     $cart = $this->getOrCreateCart();
    //     $items = $cart->items()->with('product')->get();
    
    //     // Calculate totals
    //     $subtotal = $items->sum(function($item) {
    //         return $item->product->price * $item->quantity;
    //     });
        
    //     $shipping = $this->calculateShipping($items);
    //     $total = $subtotal + $shipping;
    
    //     return response()->json([
    //         'success' => true,
    //         'subtotal' => number_format($subtotal, 2),
    //         'shipping' => number_format($shipping, 2),  // Make sure this matches your JS
    //         'total' => number_format($total, 2),
    //         'item_total' => number_format($item->product->price * $item->quantity, 2)
    //     ]);
    // }

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
    
            // Update the quantity
            $item->quantity = $request->quantity;
            $item->save();
    
            // Get fresh cart data
            $cart = $this->getOrCreateCart();
            $items = $cart->items()->with('product')->get();
    
            // Calculate totals
            $subtotal = $items->sum(function($item) {
                return $item->product->price * $item->quantity;
            });
            
            $shipping = $this->calculateShipping($items);
            $total = $subtotal + $shipping;
    
            return response()->json([
                'success' => true,
                'item_id' => $item->id,
                'item_total' => number_format($item->product->price * $item->quantity, 2),
                'subtotal' => number_format($subtotal, 2),
                'shipping' => number_format($shipping, 2),
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
    
    protected function calculateShipping($items)
    {
        // Implement your shipping logic here
        // For now, using fixed $10 shipping
        return 10;
    }
}