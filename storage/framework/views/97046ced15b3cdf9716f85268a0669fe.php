

<?php $__env->startSection('content'); ?>
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="<?php echo e(route('home')); ?>">Home</a></p>
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
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="d-flex justify-content-between">
            <p><?php echo e($item->product->name); ?> (x<?php echo e($item->quantity); ?>)</p>
            <p> ₦<?php echo e(number_format($item->product->price * $item->quantity, 2)); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <hr class="mt-0">
        <div class="d-flex justify-content-between mb-3 pt-1">
            <h6 class="font-weight-medium">Subtotal</h6>
            <h6 class="font-weight-medium"> ₦<?php echo e(number_format($subtotal, 2)); ?></h6>
        </div>
        
    </div>
    <div class="card-footer border-secondary bg-transparent">
        <div class="d-flex justify-content-between mt-2">
            <h5 class="font-weight-bold">Total</h5>
            <h5 class="font-weight-bold"> ₦<?php echo e(number_format($total, 2)); ?></h5>
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
                    <h5 class="font-weight-bold">Order Total: ₦<?php echo e(number_format($total, 2)); ?></h5>
                    <hr>
                    
                    <h6 class="font-weight-bold mt-4">Please transfer the exact amount to:</h6>
                    
                    <div class="mt-3">
                        <div class="detail-row mb-2">
                            <span class="font-weight-bold">Bank Name:</span>
                            <span>Opay</span>
                        </div>
                        <div class="detail-row mb-2">
                            <span class="font-weight-bold">Account Name:</span>
                            <span>Chima Oji Olibey Samuel</span>
                        </div>
                        <div class="detail-row mb-2">
                            <span class="font-weight-bold">Account Number:</span>
                            <span>9037441520</span>
                            <button class="btn btn-sm btn-outline-secondary copy-btn" onclick="copyToClipboard('9037441520')">
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
                
                <form id="finalCheckoutForm" action="<?php echo e(route('checkout.store')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <!-- Hidden Billing Fields -->
                     <input type="hidden" name="payment_reference" id="payment_reference">

                    <input type="hidden" name="first_name" id="hidden_first_name">
                    <input type="hidden" name="last_name" id="hidden_last_name">
                    <input type="hidden" name="email" id="hidden_email">
                    <input type="hidden" name="phone" id="hidden_phone">
                    <input type="hidden" name="address1" id="hidden_address1">
                    <input type="hidden" name="payment_method" value="bank_transfer">
                    <input type="hidden" name="order_total" value="<?php echo e($total); ?>">
                    
                    <div class="form-group">
                        <label for="payment_receipt">Payment Receipt</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="payment_receipt" name="payment_receipt" required accept="image/*,.pdf">
                            <label class="custom-file-label" for="payment_receipt">Choose file</label>
                        </div>
                        <small class="form-text text-muted">
                            Accepted formats: JPG, PNG, PDF (Max 2MB)
                        </small>
                        <img id="receiptPreview" class="img-fluid mt-2" alt="Receipt Preview">
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fa fa-check"></i> Submit Order
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    const PAYSTACK_PUBLIC_KEY = "<?php echo e($paystackKey); ?>";
    const ORDER_TOTAL = <?php echo e($total * 100); ?>;
    const ORDER_TOTAL_DISPLAY = <?php echo e($total); ?>;
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

    const handler = PaystackPop.setup({
        key: PAYSTACK_PUBLIC_KEY,
        email: "ogbenihappy05@gmail.com",
        amount: ORDER_TOTAL,
        currency: "NGN",
        ref: reference,
        callback: function(response) {
            // Make sure Paystack callback ran
            console.log("Paystack payment reference:", response.reference);

            fetch("<?php echo e(route('checkout.store')); ?>", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>",
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
        onClose: function() {
            alert("Payment window closed.");
        }
    });

    handler.openIframe();
});
// Global variables to store billing data
let billingData = {};

function validateBillingForm() {
    let isValid = true;
    
    // Reset errors
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').text('');
    
    // Validate each field
    const fields = ['first_name', 'last_name', 'email', 'phone', 'address1'];
    fields.forEach(field => {
        const value = $(`#${field}`).val().trim();
        if (!value) {
            $(`#${field}`).addClass('is-invalid');
            $(`#${field}_error`).text('This field is required');
            isValid = false;
            
            // Special validation for email
            if (field === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                $(`#${field}`).addClass('is-invalid');
                $(`#${field}_error`).text('Please enter a valid email');
                isValid = false;
            }
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

$(document).ready(function() {
    // Proceed to Payment
    $('#manualpayment').click(function() {
        if (validateBillingForm()) {
            // Store billing data
            billingData = {
                first_name: $('#first_name').val(),
                last_name: $('#last_name').val(),
                email: $('#email').val(),
                phone: $('#phone').val(),
                address1: $('#address1').val()
            };
            
            // Set hidden fields
            $('#hidden_first_name').val(billingData.first_name);
            $('#hidden_last_name').val(billingData.last_name);
            $('#hidden_email').val(billingData.email);
            $('#hidden_phone').val(billingData.phone);
            $('#hidden_address1').val(billingData.address1);
            
            // Show payment section
            $('#billingSection').removeClass('active');
            $('#paymentDetailsSection').addClass('active');
        }
    });
    
    // Upload Receipt
    $('#uploadReceiptBtn').click(function() {
        $('#paymentDetailsSection').removeClass('active');
        $('#receiptUploadSection').addClass('active');
    });
    
    // Preview receipt image
    $('#payment_receipt').change(function() {
        const file = this.files[0];
        const preview = $('#receiptPreview');
        
        if (file && file.type.match('image.*')) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.attr('src', e.target.result);
                preview.show();
            }
            
            reader.readAsDataURL(file);
        } else {
            preview.hide();
        }
        
        // Update file label
        const fileName = file ? file.name : 'Choose file';
        $(this).next('.custom-file-label').text(fileName);
    });
    
    // Final form submission
    $('#finalCheckoutForm').submit(function() {
        if (!validateBillingForm()) {
            return false;
        }
        
        if (!$('#payment_receipt').val()) {
            alert('Please upload your payment receipt');
            return false;
        }
        
        return true;
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\selleaise\resources\views/frontend/checkout.blade.php ENDPATH**/ ?>