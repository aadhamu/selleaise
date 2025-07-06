@extends('layout.frontend')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
     
        <h1 class="display-4 text-success mb-3">Thank You For Your Order!</h1>
        <p class="lead text-muted">Your order <strong>#{{ $order->order_number }}</strong> has been received and is being processed.</p>
        <p class="text-muted">We've sent a confirmation to <strong>{{ $order->email }}</strong></p>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 font-weight-bold">Order Summary</h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach($order->items as $item)
                        <div class="list-group-item border-0 px-4 py-4">
                            <div class="d-flex align-items-start">
                                <div class="mr-4" style="width: 80px; flex-shrink: 0;">
                                    <img src="{{ $item->product->image_url ?? asset('images/default-product.png') }}" 
                                         alt="{{ $item->product->name }}" 
                                         class="img-fluid rounded border"
                                         style="max-height: 80px; object-fit: contain;">
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="font-weight-bold mb-1">{{ $item->product->name }}</h6>
                                    <div class="d-flex flex-wrap text-muted small mb-2">
                                        @if($item->selected_size)
                                        <span class="mr-3">Size: {{ $item->selected_size }}</span>
                                        @endif
                                        @if($item->selected_color)
                                        <span class="d-flex align-items-center">
                                            Color: 
                                            <span class="ml-1" style="background-color: {{ $item->selected_color }}; display: inline-block; width: 16px; height: 16px; border-radius: 50%; border: 1px solid #eee;"></span>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="text-muted small">Qty: {{ $item->quantity }}</div>
                                        <div class="font-weight-bold">₦{{ number_format($item->price * $item->quantity, 2) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center py-2">
                        <span>Subtotal</span>
                        <span>₦{{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <!-- <div class="d-flex justify-content-between align-items-center py-2">
                        <span>Shipping</span>
                        <span>₦{{ number_format($order->shipping, 2) }}</span>
                    </div> -->
                    <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                        <strong>Total</strong>
                        <strong>₦{{ number_format($order->total, 2) }}</strong>
                    </div>
                </div>
            </div>
            
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 font-weight-bold">Customer Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <h6 class="small text-muted mb-1">Contact Information</h6>
                            <p class="mb-0">{{ $order->email }}</p>
                            <p class="mb-0">{{ $order->phone }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="small text-muted mb-1">Billing Address</h6>
                            <p class="mb-0">{{ $order->first_name }} {{ $order->last_name }}</p>
                            <p class="mb-0">{{ $order->address1 }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center py-4">
                <a href="{{ route('shop') }}" class="btn btn-primary px-5 py-3">
                    <i class="fas fa-arrow-left mr-2"></i> Continue Shopping
                </a>
                <a href="/" class="btn btn-outline-secondary px-5 py-3 ml-3">
                    <i class="fas fa-home mr-2"></i> Back to Home
                </a>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .checkmark-circle {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        position: relative;
    }
    .checkmark-circle-bg {
        stroke: #28a745;
        stroke-width: 2;
    }
    .checkmark-check {
        stroke: #28a745;
        stroke-width: 2;
        stroke-linecap: round;
        animation: checkmark-animation 0.6s ease-in-out;
    }
    @keyframes checkmark-animation {
        0% { stroke-dashoffset: 50; }
        100% { stroke-dashoffset: 0; }
    }
    .list-group-item {
        transition: background-color 0.2s;
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
    }
</style>
@endpush

@endsection