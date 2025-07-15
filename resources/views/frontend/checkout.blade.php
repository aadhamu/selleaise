@extends('layout.frontend')

@section('content')
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{ route('home') }}">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Checkout</p>
        </div>
    </div>
</div>

<style>
    .bank-details {
        border-left: 4px solid #28a745;
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }
    .detail-row {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    .copy-btn {
        cursor: pointer;
        padding: 0.15rem 0.5rem;
        margin-left: 10px;
    }
    .is-invalid {
        border-color: #dc3545;
    }
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875em;
    }
    #receiptPreview {
        max-width: 100%;
        max-height: 200px;
        margin-top: 10px;
        display: none;
    }
    .checkout-section {
        display: none;
    }
    .checkout-section.active {
        display: block;
    }
    .btn-back {
        margin-right: 10px;
    }
</style>

<!-- Checkout Process -->
<div class="container-fluid pt-5">
    <!-- Step 1: Billing Information -->
    <div id="billingSection" class="checkout-section active">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" name="first_name" id="first_name" required>
                            <div class="invalid-feedback" id="first_name_error"></div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" name="last_name" id="last_name" required>
                            <div class="invalid-feedback" id="last_name_error"></div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="email" name="email" id="email" required>
                            <div class="invalid-feedback" id="email_error"></div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" name="phone" id="phone" required>
                            <div class="invalid-feedback" id="phone_error"></div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address</label>
                            <input class="form-control" type="text" name="address1" id="address1" required>
                            <div class="invalid-feedback" id="address1_error"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
    <div class="card-header bg-secondary border-0">
        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
    </div>
    <div class="card-body">
        <h5 class="font-weight-medium mb-3">Products</h5>
        @foreach($items as $item)
        <div class="d-flex justify-content-between">
            <p>{{ $item->product->name }} (x{{ $item->quantity }})</p>
            <p> ₦{{ number_format($item->product->price * $item->quantity, 2) }}</p>
        </div>
        @endforeach
        <hr class="mt-0">
        <div class="d-flex justify-content-between mb-3 pt-1">
            <h6 class="font-weight-medium">Subtotal</h6>
            <h6 class="font-weight-medium"> ₦{{ number_format($subtotal, 2) }}</h6>
        </div>
        {{-- Removed shipping charges --}}
    </div>
    <div class="card-footer border-secondary bg-transparent">
        <div class="d-flex justify-content-between mt-2">
            <h5 class="font-weight-bold">Total</h5>
            <h5 class="font-weight-bold"> ₦{{ number_format($total, 2) }}</h5>
        </div>
    </div>
</div>


                <button type="button" id="manualpayment"  class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">
                    Make manual transafer
                </button>
                <button type="button" id="proceedToPaymentBtn" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">
                    Proceed to Payment
                </button>
            </div>
        </div>
    </div>
 
    <!-- Step 2: Payment Details -->
    <div id="paymentDetailsSection" class="checkout-section">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <button type="button" class="btn btn-secondary btn-back mb-3" onclick="backToBilling()">
                    <i class="fa fa-arrow-left"></i> Back to Billing
                </button>
                
                <div class="bank-details">
                    <h4 class="font-weight-semi-bold mb-3">Payment Instructions</h4>
                    <h5 class="font-weight-bold">Order Total: ₦{{ number_format($total, 2) }}</h5>
                    <hr>
                    
                    <h6 class="font-weight-bold mt-4">Please transfer the exact amount to:</h6>
                    
                    <div class="mt-3">
                        <div class="detail-row mb-2">
                            <span class="font-weight-bold">Bank Name:</span>
                            <span>Moniepoint</span>
                        </div>
                        <div class="detail-row mb-2">
                            <span class="font-weight-bold">Account Name:</span>
                            <span>Lillian Oriaku</span>
                        </div>
                        <div class="detail-row mb-2">
                            <span class="font-weight-bold">Account Number:</span>
                            <span>8236930152</span>
                            <button class="btn btn-sm btn-outline-secondary copy-btn" onclick="copyToClipboard('8236930152')">
                                <i class="fa fa-copy"></i> Copy
                            </button>
                        </div>
                    </div>
                    
                    <div class="alert alert-info mt-4">
                        <p><strong>Important:</strong></p>
                        <ul>
                            <li>Payment must be made within 24 hours</li>
                            <li>Upload your payment receipt after transfer</li>
                        </ul>
                    </div>
                </div>
                
                <button type="button" id="uploadReceiptBtn" class="btn btn-success btn-lg">
                    <i class="fa fa-upload"></i> Upload Receipt
                </button>
            </div>
        </div>
    </div>

    <!-- Step 3: Receipt Upload -->
    <div id="receiptUploadSection" class="checkout-section">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <button type="button" class="btn btn-secondary btn-back mb-3" onclick="backToPayment()">
                    <i class="fa fa-arrow-left"></i> Back to Payment
                </button>
                
                <form id="finalCheckoutForm" action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Hidden Billing Fields -->
                     <input type="hidden" name="payment_reference" id="payment_reference">

                    <input type="hidden" name="first_name" id="hidden_first_name">
                    <input type="hidden" name="last_name" id="hidden_last_name">
                    <input type="hidden" name="email" id="hidden_email">
                    <input type="hidden" name="phone" id="hidden_phone">
                    <input type="hidden" name="address1" id="hidden_address1">
                    <input type="hidden" name="payment_method" value="bank_transfer">
                    <input type="hidden" name="order_total" value="{{ $total }}">
                    
                    <div class="form-group">
    <label for="payment_receipt">Payment Receipt</label>
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="payment_receipt" name="payment_receipt" required accept="image/*,.pdf">
        <label class="custom-file-label" for="payment_receipt">Choose file</label>
    </div>
    <small class="form-text text-muted">
        Accepted formats: JPG, PNG, PDF (Max 10MB)
    </small>

    <div id="receiptPreview" class="mt-2"></div>
</div>

                    
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fa fa-check"></i> Submit Order
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const PAYSTACK_PUBLIC_KEY = "{{ $paystackKey }}";
    const ORDER_TOTAL = {{ $total * 100 }};
    const ORDER_TOTAL_DISPLAY = {{ $total }};
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://js.paystack.co/v1/inline.js"></script>

<script>
document.getElementById('proceedToPaymentBtn').addEventListener('click', function (e) {
    e.preventDefault();

    if (!PAYSTACK_PUBLIC_KEY) {
        alert('Paystack key is missing.');
        return;
    }

    const reference = 'ORD-' + Math.floor((Math.random() * 1000000000) + 1);




    const proceedBtn = document.getElementById('proceedToPaymentBtn');
proceedBtn.disabled = true;
proceedBtn.innerText = "Processing...";


    const handler = PaystackPop.setup({
        key: PAYSTACK_PUBLIC_KEY,
        email: document.getElementById("email").value,
        amount: ORDER_TOTAL,
        currency: "NGN",
        ref: reference,
        callback: function (response) {
            fetch("{{ route('checkout.store') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    first_name: document.getElementById("first_name").value,
                    last_name: document.getElementById("last_name").value,
                    email: document.getElementById("email").value,
                    phone: document.getElementById("phone").value,
                    address1: document.getElementById("address1").value,
                    payment_method: "paystack",
                    payment_reference: response.reference,
                    order_total: ORDER_TOTAL_DISPLAY
                })
            })
                .then(res => {
                    if (!res.ok) throw new Error("Network response was not ok");
                    return res.json();
                })
                .then(data => {
                    if (data.success) {
                        window.location.href = `/thank-you/${data.order_id}`;
                    } else {
                        alert("Payment verified but order creation failed: " + (data.message || "Unknown error."));
                    }
                })
                .catch(err => {
                    console.error("Checkout error:", err);
                    alert("Something went wrong. Please contact support.");
                });
        },
        onClose: function () {
            alert("Payment window closed.");
        }
    });

    handler.openIframe();
});

let billingData = {};

function validateBillingForm() {
    let isValid = true;

    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').text('');

    const fields = ['first_name', 'last_name', 'email', 'phone', 'address1'];
    fields.forEach(field => {
        const value = $(`#${field}`).val().trim();
        if (!value) {
            $(`#${field}`).addClass('is-invalid');
            $(`#${field}_error`).text('This field is required');
            isValid = false;
        }

        if (field === 'email' && value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
            $(`#${field}`).addClass('is-invalid');
            $(`#${field}_error`).text('Please enter a valid email');
            isValid = false;
        }
    });

    return isValid;
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('Copied to clipboard: ' + text);
    });
}

function backToBilling() {
    $('#paymentDetailsSection').removeClass('active');
    $('#billingSection').addClass('active');
}

function backToPayment() {
    $('#receiptUploadSection').removeClass('active');
    $('#paymentDetailsSection').addClass('active');
}

$(document).ready(function () {
    $('#manualpayment').click(function () {
        if (validateBillingForm()) {
            billingData = {
                first_name: $('#first_name').val(),
                last_name: $('#last_name').val(),
                email: $('#email').val(),
                phone: $('#phone').val(),
                address1: $('#address1').val()
            };

            $('#hidden_first_name').val(billingData.first_name);
            $('#hidden_last_name').val(billingData.last_name);
            $('#hidden_email').val(billingData.email);
            $('#hidden_phone').val(billingData.phone);
            $('#hidden_address1').val(billingData.address1);

            $('#billingSection').removeClass('active');
            $('#paymentDetailsSection').addClass('active');
        }
    });

    $('#uploadReceiptBtn').click(function () {
        $('#paymentDetailsSection').removeClass('active');
        $('#receiptUploadSection').addClass('active');
    });

    // Handle receipt preview for both image and PDF
    $('#payment_receipt').on('change', function () {
        const file = this.files[0];
        const previewContainer = $('#receiptPreview');
        previewContainer.html(''); // Clear previous preview

        if (!file) return;

        const fileType = file.type;

        if (fileType.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = $('<img>', {
                    src: e.target.result,
                    class: 'img-fluid img-thumbnail mt-2',
                    css: { maxHeight: '300px' }
                });
                previewContainer.append(img);
            };
            reader.readAsDataURL(file);
        } else if (fileType === 'application/pdf') {
            const embed = $('<embed>', {
                src: URL.createObjectURL(file),
                type: 'application/pdf',
                width: '100%',
                height: '400px'
            });
            previewContainer.append(embed);
        } else {
            previewContainer.html('<p class="text-danger">Unsupported file format. Please upload JPG, PNG, or PDF.</p>');
        }

        // Update file name on label
        $(this).next('.custom-file-label').text(file.name);
    });

   $('#finalCheckoutForm').submit(function () {
    const file = $('#payment_receipt')[0].files[0];

    if (!validateBillingForm()) return false;

    if (!file) {
        alert('Please upload your payment receipt');
        return false;
    }

    if (file.size > 10 * 1024 * 1024) {
        alert('File too large. Maximum allowed size is 10MB.');
        return false;
    }

    return true;
});

});
</script>

@endpush

@endsection