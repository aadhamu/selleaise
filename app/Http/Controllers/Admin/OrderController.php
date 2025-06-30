<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'items.product'])->latest();
            
        // Add search filter
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('id', 'like', "%{$request->search}%")
                  ->orWhere('first_name', 'like', "%{$request->search}%")
                  ->orWhere('last_name', 'like', "%{$request->search}%")
                  ->orWhere('email', 'like', "%{$request->search}%");
            });
        }
        
        // Add status filter
        if ($request->has('status') && in_array($request->status, ['pending', 'processing', 'completed', 'cancelled'])) {
            $query->where('status', $request->status);
        }
        
        $orders = $query->paginate(10);
        
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['items.product', 'user']);
        return view('admin.orders.show', compact('order'));
    }

public function updateStatus(Request $request, Order $order)
{
    $validated = $request->validate([
        'status' => 'required|in:pending,processing,completed,cancelled',
    ]);

    $order->status = $validated['status'];

    // Optionally, sync payment status:
    if ($validated['status'] === 'completed') {
        $order->payment_status = Order::PAYMENT_STATUS_PAID;
    } elseif ($validated['status'] === 'cancelled') {
        $order->payment_status = Order::PAYMENT_STATUS_FAILED;
    }

    $order->save();

    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'status' => $order->status,
            'status_label' => ucfirst($order->status),
            'payment_status' => $order->payment_status,
            'payment_status_label' => ucfirst($order->payment_status)
        ]);
    }

    return redirect()->back()->with('success', 'Order status updated successfully.');
}

}