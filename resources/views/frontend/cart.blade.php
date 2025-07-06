@extends('layout.frontend')

@section('content')
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{ route('home') }}">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Shopping Cart</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            @if(session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger mb-4">
                {{ session('error') }}
            </div>
            @endif

            @if($items->isEmpty())
            <div class="alert alert-info">
                Your cart is empty. <a href="{{ route('shop') }}">Continue shopping</a>
            </div>
            @else
            <table class="table table-bordered text-center mb-0">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach($items as $item)
                    <tr>
                        <td class="align-middle text-left">
                            <div class="d-flex align-items-center">
                                <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" style="width: 50px; height: 50px; object-fit: cover;" class="mr-3">
                                <div>
                                    <a href="{{ route('shop-details', $item->product->slug) }}" class="font-weight-bold">{{ $item->product->name }}</a>
                                    @if($item->selected_size)
                                        <div class="text-muted small">Size: {{ $item->selected_size }}</div>
                                    @endif
                                    @if($item->selected_color)
                                        <div class="text-muted small">Color: {{ $item->selected_color }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">₦{{ number_format($item->product->price, 2) }}</td>
                        <td class="align-middle">
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <div class="input-group quantity mx-auto" style="width: 120px;">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-sm btn-primary btn-minus" type="button">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="number" name="quantity" class="form-control form-control-sm bg-secondary text-center quantity-input" 
                                        value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-sm btn-primary btn-plus" type="button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </td>
                        <td class="align-middle">₦{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                        <td class="align-middle">
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>

        <div class="col-lg-4">
            @if(!$items->isEmpty())
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h6 class="font-weight-medium" id="subtotal">₦{{ number_format($subtotal, 2) }}</h6>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <h5 class="font-weight-bold" id="total">₦{{ number_format($subtotal, 2) }}</h5>
                    </div>
                    <a href="{{ route('checkout') }}" class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.quantity-input').each(function() {
        $(this).data('original-value', $(this).val());
    });

    $('.btn-minus, .btn-plus').click(function(e) {
        e.preventDefault();
        let input = $(this).closest('.input-group').find('.quantity-input');
        let max = parseInt(input.attr('max'));
        let min = parseInt(input.attr('min'));
        let value = parseInt(input.val() || min);
        let newValue = value;

        if ($(this).hasClass('btn-minus') && value > min) {
            newValue = value - 1;
        } 
        if ($(this).hasClass('btn-plus') && value < max) {
            newValue = value + 1;
        }

        if (newValue !== value) {
            input.val(newValue).trigger('change');
        }
    });

    $('.quantity-input').change(function() {
        let input = $(this);
        let form = input.closest('form');
        let row = input.closest('tr');
        let price = parseFloat(row.find('td:nth-child(2)').text().replace(/[^\d.]/g, ''));
        let quantity = parseInt(input.val());
        let itemId = form.attr('action').split('/').pop();

        if (isNaN(quantity)) {
            input.val(input.data('original-value'));
            return;
        }

        let newTotal = (price * quantity).toFixed(2);
        row.find('td:nth-child(4)').text('₦' + newTotal);
        updateCartSummary();

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: form.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                if (response.success) {
                    $('#subtotal').text('₦' + response.subtotal);
                    $('#total').text('₦' + response.total);
                    row.find('td:nth-child(4)').text('₦' + response.item_total);
                    input.data('original-value', input.val());
                } else {
                    showError(response.message);
                    revertChanges();
                }
            },
            error: function(xhr) {
                let errorMessage = xhr.responseJSON?.message || 'Error updating quantity';
                showError(errorMessage);
                revertChanges();
            }
        });

        function revertChanges() {
            let originalValue = input.data('original-value');
            input.val(originalValue);
            let originalTotal = (price * originalValue).toFixed(2);
            row.find('td:nth-child(4)').text('₦' + originalTotal);
            updateCartSummary();
        }

        function showError(message) {
            alert(message);
        }
    });

    function updateCartSummary() {
        let subtotal = 0;

        $('tbody tr').each(function() {
            let price = parseFloat($(this).find('td:nth-child(2)').text().replace(/[^\d.]/g, ''));
            let quantity = parseInt($(this).find('.quantity-input').val());
            subtotal += price * quantity;
        });

        $('#subtotal').text('₦' + subtotal.toFixed(2));
        $('#total').text('₦' + subtotal.toFixed(2));
    }
});
</script>
@endpush
