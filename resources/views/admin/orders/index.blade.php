@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col space-y-6">
        <!-- Header -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Orders</h1>
                <p class="mt-1 text-sm text-gray-500">Manage customer orders</p>
            </div>
        </div>

        @if(session('success'))
        <div class="rounded-md bg-green-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Orders Table -->
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h6 class="font-semibold text-gray-800">All Orders</h6>
                <div class="flex space-x-4">
                    <input type="text" placeholder="Search orders..." class="px-3 py-2 border rounded-md text-sm">
                    <select class="border rounded-md text-sm">
                        <option>All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">S/N</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Proof</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($orders as $index => $order)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $index + 1 }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $order->created_at->format('M d, Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">₦{{ number_format($order->total, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                               <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="inline update-status-form">
                                    @csrf
                                    @method('PUT')
                                    <select 
                                        name="status" 
                                        class="text-xs border rounded p-1 focus:outline-none focus:ring-1 focus:ring-blue-500 status-select"
                                        data-order="{{ $order->id }}"
                                    >
                                        @foreach(['pending', 'processing', 'completed', 'cancelled'] as $status)
                                            <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($order->payment_receipt)
<button onclick="showReceipt('{{ basename($order->payment_receipt) }}')">View Receipt</button>


                                @else
                                    <span class="text-sm text-gray-500">None</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:text-blue-900" title="View Details">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($orders->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $orders->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal for payment proof -->
<div id="receiptModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <img id="receiptImage" src="" alt="Payment Receipt" class="w-full">
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
function showReceipt(imageUrl) {
    const fullPath = `/secure-receipts/${imageUrl}`;
    document.getElementById('receiptImage').src = fullPath;
    document.getElementById('receiptModal').classList.remove('hidden');
}



</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle status updates via AJAX
    // document.querySelectorAll('.status-select').forEach(select => {
    //     select.addEventListener('change', function() {
    //         const form = this.closest('.update-status-form');
    //         const orderId = form.action.split('/').pop();
            
    //         fetch(form.action, {
    //             method: 'POST',
    //             headers: {
    //                 'Content-Type': 'application/json',
    //                 'X-CSRF-TOKEN': '{{ csrf_token() }}',
    //                 'X-Requested-With': 'XMLHttpRequest',
    //                 'Accept': 'application/json'
    //             },
    //             body: JSON.stringify({
    //                 _method: 'PUT',
    //                 status: this.value
    //             })
    //         })
    //         .then(response => response.json())
    //         .then(data => {
    //             if (data.success) {
    //                 // Update all status selects for this order
    //                 document.querySelectorAll(`.status-select[data-order="${orderId}"]`).forEach(select => {
    //                     select.value = data.status;
    //                 });
                    
    //                 // Update status badges
    //                 document.querySelectorAll(`.status-badge[data-order="${orderId}"]`).forEach(badge => {
    //                     badge.textContent = data.status_label;
    //                     badge.className = `status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getStatusBadgeClass(data.status)}`;
    //                 });
                    
    //                 // Update payment status if changed
    //                 if (data.payment_status) {
    //                     document.querySelectorAll(`.payment-status-badge[data-order="${orderId}"]`).forEach(badge => {
    //                         badge.textContent = data.payment_status_label;
    //                         badge.className = `payment-status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getPaymentStatusBadgeClass(data.payment_status)}`;
    //                     });
    //                 }
    //             }
    //         })
    //         .catch(error => console.error('Error:', error));
    //     });
    // });

     document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', function () {
            const form = this.closest('.update-status-form');
            const orderId = this.dataset.order;

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    _method: 'PUT',
                    status: this.value
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update all status selects for this order
                    document.querySelectorAll(`.status-select[data-order="${orderId}"]`).forEach(select => {
                        select.value = data.status;
                    });

                    // Update status badges
                    document.querySelectorAll(`.status-badge[data-order="${orderId}"]`).forEach(badge => {
                        badge.textContent = data.status_label;
                        badge.className = `status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getStatusBadgeClass(data.status)}`;
                    });

                    // Update payment status if changed
                    if (data.payment_status) {
                        document.querySelectorAll(`.payment-status-badge[data-order="${orderId}"]`).forEach(badge => {
                            badge.textContent = data.payment_status_label;
                            badge.className = `payment-status-badge inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${getPaymentStatusBadgeClass(data.payment_status)}`;
                        });
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
    
    function getStatusBadgeClass(status) {
        switch(status) {
            case 'pending': return 'bg-yellow-100 text-yellow-800';
            case 'processing': return 'bg-blue-100 text-blue-800';
            case 'completed': return 'bg-green-100 text-green-800';
            case 'cancelled': return 'bg-red-100 text-red-800';
            default: return 'bg-gray-100 text-gray-800';
        }
    }
    
    function getPaymentStatusBadgeClass(status) {
        switch(status) {
            case 'paid': return 'bg-green-100 text-green-800';
            case 'pending': return 'bg-yellow-100 text-yellow-800';
            case 'failed': return 'bg-red-100 text-red-800';
            default: return 'bg-gray-100 text-gray-800';
        }
    }
});
</script>

@endsection