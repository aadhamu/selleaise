<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = $this->getCart();

        if ($cart->items()->count() === 0) {
            return redirect()->route('cart')->with('error', 'Your cart is empty!');
        }

        $items = $cart->items()->with('product')->get();

        $subtotal = $items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $total = $subtotal;
        $paystackKey = config('services.paystack.public_key');

        return view('frontend.checkout', compact('items', 'subtotal', 'total', 'paystackKey'));
    }

    public function store(Request $request)
    {
        $cart = $this->getCart();

        if ($cart->items()->count() === 0) {
            return response()->json(['success' => false, 'message' => 'Your cart is empty.']);
        }

        $items = $cart->items()->with('product')->get();
        $subtotal = $items->sum(fn($item) => $item->product->price * $item->quantity);
        $total = $subtotal;

        try {
            $validated = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'address1' => 'required|string|max:255',
                'payment_method' => 'required|string',
                'order_total' => 'required|numeric',
            ]);

            $receiptPath = null;

            if ($request->payment_method === 'bank_transfer') {
                $request->validate([
                    'payment_receipt' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
                ]);

                $receipt = $request->file('payment_receipt');
                $receiptName = $receipt->hashName();
                $receipt->storeAs('receipts', $receiptName, 'public');
                $receiptPath = 'receipts/' . $receiptName;
            } elseif ($request->payment_method === 'paystack') {
                $request->validate([
                    'payment_reference' => 'required|string',
                ]);

                $reference = $request->payment_reference;

                $verifyResult = $this->verifyPaystackPayment($reference);

                if (!$verifyResult['status']) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Payment verification failed: ' . $verifyResult['message']
                    ]);
                }
            }

            $order = Order::create([
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'billing_address' => json_encode([
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],
                    'address1' => $validated['address1'],
                ]),
                'payment_method' => $validated['payment_method'],
                'payment_receipt' => $receiptPath,
                'subtotal' => $subtotal,
                'shipping' => 0, // Optional: keep in DB but set to zero
                'total' => $validated['order_total'],
                'user_id' => auth()->id(),
                'status' => 'pending'
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'selected_size' => $item->selected_size,
                    'selected_color' => $item->selected_color
                ]);
            }

            $cart->items()->delete();

            return redirect()->route('checkout.success', ['order' => $order->id])
                ->with('success', 'Order placed successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again or contact support.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    protected function verifyPaystackPayment($reference)
    {
        try {
            $response = Http::withOptions(['verify' => false])
                ->withToken(config('services.paystack.secret_key'))
                ->get("https://api.paystack.co/transaction/verify/" . rawurlencode($reference));

            if (!$response->ok()) {
                return ['status' => false, 'message' => 'Request failed'];
            }

            $data = $response->json();

            if (($data['data']['status'] ?? '') !== 'success') {
                return ['status' => false, 'message' => 'Transaction not successful'];
            }

            return ['status' => true, 'data' => $data['data']];
        } catch (\Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    protected function getCart()
    {
        if (Auth::check()) {
            return Cart::with('items.product')->where('user_id', Auth::id())->firstOrFail();
        }

        $sessionId = session()->getId();
        return Cart::with('items.product')->where('session_id', $sessionId)->firstOrFail();
    }

    public function thankYou(Order $order)
    {
        return view('frontend.thank-you', compact('order'));
    }
}
