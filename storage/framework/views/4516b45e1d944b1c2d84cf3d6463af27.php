

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <!-- Header Section -->
    <div class="flex flex-col space-y-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">Order #<?php echo e($order->order_number); ?></h1>
                <p class="mt-1 text-sm text-gray-500">Placed on <?php echo e($order->created_at->format('F j, Y \a\t g:i A')); ?></p>
            </div>
            <a href="<?php echo e(route('admin.orders.index')); ?>" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Orders
            </a>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column (2/3 width) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Order Status Card -->
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Order Status
                        </h3>
                    </div>
                    <div class="p-6">
                        <form action="<?php echo e(route('admin.orders.update-status', $order)); ?>" method="POST" class="update-status-form">
                            <?php echo method_field('PUT'); ?>
                            <?php echo csrf_field(); ?>
                            <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-4">
                                <select name="status" class="status-select block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                    <?php $__currentLoopData = ['pending' => 'Pending', 'processing' => 'Processing', 'completed' => 'Completed', 'cancelled' => 'Cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value); ?>" <?php echo e($order->status === $value ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Update Status
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Order Items Card -->
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Order Items (<?php echo e($order->items->count()); ?>)
                        </h3>
                    </div>
                    <div class="divide-y divide-gray-200">
                        <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="p-6 flex flex-col sm:flex-row">
                            <div class="flex-shrink-0 mb-4 sm:mb-0">
                                <img src="<?php echo e($item->product->image_url ?? asset('images/default-product.png')); ?>" alt="<?php echo e($item->product->name ?? 'Product'); ?>" class="w-20 h-20 rounded-md object-cover border border-gray-200">
                            </div>
                            <div class="sm:ml-6 flex-1">
                                <div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between">
                                    <h4 class="text-sm font-medium text-gray-900"><?php echo e($item->product->name ?? 'Product'); ?></h4>
                                    <p class="mt-1 sm:mt-0 sm:ml-4 text-sm font-medium text-gray-900">₦<?php echo e(number_format($item->price, 2)); ?></p>
                                </div>
                                <div class="mt-2 grid grid-cols-2 gap-4 text-sm text-gray-500">
                                    <div>
                                        <span class="font-medium">Quantity:</span> <?php echo e($item->quantity); ?>

                                    </div>
                                    <div>
                                        <span class="font-medium">Total:</span> ₦<?php echo e(number_format($item->price * $item->quantity, 2)); ?>

                                    </div>
                                    <?php if($item->selected_size || $item->selected_color): ?>
                                    <div class="col-span-2">
                                        <?php if($item->selected_size): ?>
                                        <span class="font-medium">Size:</span> <?php echo e($item->selected_size); ?>

                                        <?php endif; ?>
                                        <?php if($item->selected_color): ?>
                                        <span class="ml-2 font-medium">Color:</span> <?php echo e($item->selected_color); ?>

                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <!-- Right Column (1/3 width) -->
            <div class="space-y-6">
                <!-- Customer Information Card -->
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Customer Details
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3 text-sm">
                            <?php
                                $billing = json_decode($order->billing_address, true); // decode as associative array
                            ?>
                            <div>
                                <p class="text-gray-500">Name</p>
                                <p class="font-medium t"><?php echo e($billing['first_name'] ?? ''); ?> <?php echo e($billing['last_name'] ?? ''); ?></p>
                            </div>
                            <div>
                                <p class="text-gray-500">Email</p>
                                <p class="font-medium text-gray-900"><?php echo e($billing['email']); ?></p>
                            </div>
                            <?php if($order->phone): ?>
                            <div>
                                <p class="text-gray-500">Phone</p>
                                <p class="font-medium text-gray-900"><?php echo e($order->phone); ?></p>
                            </div>
                            <?php endif; ?>
                            <div class="pt-2 mt-2 border-t border-gray-200">
                                <p class="text-gray-500">Account Type</p>
                                <p class="font-medium text-gray-900">
                                    <?php if($order->user): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Registered User
                                    </span>
                                    <?php else: ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Guest Checkout
                                    </span>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary Card -->
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Order Summary
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium text-gray-900"> ₦<?php echo e(number_format($order->subtotal, 2)); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Shipping</span>
                                <span class="font-medium text-gray-900"> ₦<?php echo e(number_format($order->shipping, 2)); ?></span>
                            </div>
                            <div class="flex justify-between pt-3 mt-3 border-t border-gray-200">
                                <span class="text-base font-medium text-gray-900">Total</span>
                                <span class="text-base font-medium text-gray-900"> ₦<?php echo e(number_format($order->total, 2)); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Information Card -->
                <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h3 class="text-lg font-medium text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            Payment Information
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3 text-sm">
                            <div>
                                <p class="text-gray-500">Payment Method</p>
                                <p class="font-medium text-gray-900">Payment gateway</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Payment Status</p>
                                <p class="font-medium text-gray-900">
                                    <span class="capitalize inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        <?php echo e($order->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 
                                           ($order->payment_status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800')); ?>" data-order="<?php echo e($order->id); ?>">
                                        <?php echo e($order->payment_status); ?>

                                    </span>
                                </p>
                            </div>
                            <?php if($order->payment_receipt): ?>
                            <div class="pt-2 mt-2 border-t border-gray-200">
                                <!-- <p class="text-gray-500 mb-2">Payment Proof</p> -->
                                <!-- <button onclick="showReceipt('<?php echo e(Storage::url($order->payment_receipt)); ?>')" 
                                    class="w-full inline-flex justify-center items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    View Payment Receipt
                                </button> -->
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Address Information Cards -->
                <div class="space-y-6">
                    <!-- Billing Address Card -->
                    <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Billing Address
                            </h3>
                        </div>
                        <div class="p-6">
                            <address class="not-italic text-sm space-y-2">
                                <p class="font-medium text-gray-900"><?php echo e($billing['first_name'] ?? ''); ?> <?php echo e($billing['last_name'] ?? ''); ?></p>
                                <?php if($order->company): ?>
                                <p><?php echo e($order->company); ?></p>
                                <?php endif; ?>
                                <p><?php echo e($billing['address1']); ?></p>
                                <?php if($order->address2): ?>
                                <p><?php echo e($order->address2); ?></p>
                                <?php endif; ?>
                                <p><?php echo e($order->city); ?> <?php echo e($order->state); ?> <?php echo e($order->zip); ?></p>
                                <p><?php echo e($order->country); ?></p>
                                <?php if($billing['phone']): ?>
                                <p class="mt-2">
                                    <span class="text-gray-500">Phone:</span> <?php echo e($billing['phone']); ?>

                                </p>
                                <?php endif; ?>
                            </address>
                        </div>
                    </div>

                    <!-- Shipping Address Card (if different) -->
                    <?php if($order->shipping_address && $order->shipping_address !== $order->billing_address): ?>
                    <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"></path>
                                </svg>
                                Shipping Address
                            </h3>
                        </div>
                        <div class="p-6">
                            <address class="not-italic text-sm space-y-2">
                                <p class="font-medium text-gray-900"><?php echo e($order->shipping_address['first_name'] ?? ''); ?> <?php echo e($order->shipping_address['last_name'] ?? ''); ?></p>
                                <?php if($order->shipping_address['company'] ?? false): ?>
                                <p><?php echo e($order->shipping_address['company']); ?></p>
                                <?php endif; ?>
                                <p><?php echo e($order->shipping_address['address1'] ?? ''); ?></p>
                                <?php if($order->shipping_address['address2'] ?? false): ?>
                                <p><?php echo e($order->shipping_address['address2']); ?></p>
                                <?php endif; ?>
                                <p><?php echo e($order->shipping_address['city'] ?? ''); ?>, <?php echo e($order->shipping_address['state'] ?? ''); ?> <?php echo e($order->shipping_address['zip'] ?? ''); ?></p>
                                <p><?php echo e($order->shipping_address['country'] ?? ''); ?></p>
                                <?php if($order->shipping_address['phone'] ?? false): ?>
                                <p class="mt-2">
                                    <span class="text-gray-500">Phone:</span> <?php echo e($order->shipping_address['phone']); ?>

                                </p>
                                <?php endif; ?>
                            </address>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Receipt Modal -->
<div id="receiptModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Payment Receipt</h3>
                        <img id="receiptImage" src="" alt="Payment Receipt" class="w-full border border-gray-200 rounded-md">
                        <iframe id="receiptPdf" src="" style="display:none; width:100%; height:500px; border: 1px solid #e5e7eb; border-radius: 0.375rem;"></iframe>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="document.getElementById('receiptModal').classList.add('hidden')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function showReceipt(url) {
        const isPdf = url.toLowerCase().endsWith('.pdf');
        
        if (isPdf) {
            document.getElementById('receiptImage').style.display = 'none';
            document.getElementById('receiptPdf').style.display = 'block';
            document.getElementById('receiptPdf').src = url;
        } else {
            document.getElementById('receiptImage').style.display = 'block';
            document.getElementById('receiptPdf').style.display = 'none';
            document.getElementById('receiptImage').src = url;
        }
        
        document.getElementById('receiptModal').classList.remove('hidden');
    }
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle status form submission
    document.querySelectorAll('.update-status-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const select = form.querySelector('.status-select');
            const orderId = form.action.split('/').pop();

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    _method: 'PUT',
                    status: select.value
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Status updated successfully');
                    // Reload or update DOM as needed
                    window.location.reload(); // optional
                } else {
                    alert('Failed to update status');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong');
            });
        });
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\selleaise\resources\views/admin/orders/show.blade.php ENDPATH**/ ?>