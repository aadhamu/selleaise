

<?php $__env->startSection('content'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="min-h-screen bg-gray-50">
    <!-- Main Content -->

        <!-- Dashboard Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                    <div class="p-5 flex items-center">
                        <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                            <i class="fas fa-box text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Products</p>
                            <p class="text-2xl font-semibold text-gray-900"><?php echo e($productCount); ?></p>
                            <p class="text-xs text-green-500 mt-1"></p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                    <div class="p-5 flex items-center">
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <i class="fas fa-shopping-cart text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Orders</p>
                            <p class="text-2xl font-semibold text-gray-900"><?php echo e($orderCount); ?></p>
                            <p class="text-xs text-green-500 mt-1"></p>
                        </div>
                    </div>
                </div>
           
                <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                    <div class="p-5 flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                            <i class="fas fa-tags text-xl"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Categories</p>
                            <p class="text-2xl font-semibold text-gray-900"><?php echo e($categoryCount); ?></p>
                            <p class="text-xs text-green-500 mt-1"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="bg-white rounded shadow p-4">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Sales Overview</h2>
                        <select class="text-sm border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                            <option>Last 7 days</option>
                            <option>Last 30 days</option>
                            <option selected>Last 12 months</option>
                        </select>
                    </div>
                   <div class="h-64">
    <canvas id="salesChart" class="w-full h-full"></canvas>
</div>

                </div>

                </div>
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Recent Orders</h2>
                        <a href="<?php echo e(route('admin.orders.index')); ?>" class="text-sm text-indigo-600 hover:text-indigo-800">View all</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Sample order data - replace with real data -->
                                 <?php $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <?php
                                        $billing = json_decode($order->billing_address, true); // decode as associative array
                                        $fullName = $billing['first_name'] . ' ' . $billing['last_name'];
                                    ?>
                                 <tr>
                                     <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?php echo e($order->order_number); ?></td>
                                     <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($fullName); ?></td>
                                     <td class="px-6 py-4 whitespace-nowrap">
                                         <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"><?php echo e(ucfirst($order->payment_status)); ?></span>
                                     </td>
                                     <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> ₦<?php echo e($order->total); ?></td>
                                 </tr>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <!-- <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Recent Activity</h2>
                    <a href="#" class="text-sm text-indigo-600 hover:text-indigo-800">View all</a>
                </div>
                <div class="space-y-4"> -->
                    <!-- Sample activity items -->
                    <!-- <div class="flex items-start">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                            <i class="fas fa-box"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">New product added</p>
                            <p class="text-sm text-gray-500">"Premium Headphones" was added to the store</p>
                            <p class="text-xs text-gray-400 mt-1">2 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">New order received</p>
                            <p class="text-sm text-gray-500">Order #ORD-1235 from Sarah Williams</p>
                            <p class="text-xs text-gray-400 mt-1">5 hours ago</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">New customer registered</p>
                            <p class="text-sm text-gray-500">Michael Brown created an account</p>
                            <p class="text-xs text-gray-400 mt-1">1 day ago</p>
                        </div>
                    </div>
                </div>
            </div>
        </main> -->

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- JavaScript for interactive elements -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('salesChart')?.getContext('2d');
    if (!ctx) {
        console.error("Canvas not found!");
        return;
    }

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($chartLabels); ?>,
            datasets: [{
                label: 'Monthly Sales (₦)',
                data: <?php echo json_encode($chartData); ?>,
                backgroundColor: 'rgba(99, 102, 241, 0.6)',
                borderColor: 'rgba(99, 102, 241, 1)',
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => '₦' + value.toLocaleString()
                    }
                }
            }
        }
    });
});

    // Mobile sidebar toggle
    document.getElementById('openSidebar').addEventListener('click', function() {
        document.getElementById('sidebar').classList.remove('-translate-x-full');
    });
    
    document.getElementById('closeSidebar').addEventListener('click', function() {
        document.getElementById('sidebar').classList.add('-translate-x-full');
    });
    
    // User menu toggle
    document.getElementById('userMenuButton').addEventListener('click', function() {
        document.getElementById('userMenu').classList.toggle('hidden');
    });
    
    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        const userMenu = document.getElementById('userMenu');
        const userMenuButton = document.getElementById('userMenuButton');
        
        if (!userMenu.contains(event.target) && !userMenuButton.contains(event.target)) {
            userMenu.classList.add('hidden');
        }
    });

 

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\selleaise\selleaise\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>