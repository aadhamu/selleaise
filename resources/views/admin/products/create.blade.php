@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col space-y-6">
        <!-- Header with back button -->
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Create New Product</h1>
                <p class="mt-1 text-sm text-gray-500">Fill out the form to add a new product to your catalog</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-4 py-2.5 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Products
            </a>
        </div>

        @if($errors->any())
        <div class="rounded-md bg-red-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">There were {{ $errors->count() }} errors with your submission</h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Main Form Card -->
        <div class="bg-white shadow-xl rounded-xl overflow-hidden">
            <form action="{{ route('admin.products.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="space-y-8 p-8">
                    <!-- Basic Information Section -->
                    <div class="space-y-6">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Basic Information</h2>
                            <p class="mt-1 text-sm text-gray-500">Essential details about your product</p>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                            <!-- Product Name -->
                            <div class="sm:col-span-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Product Name <span class="text-red-500">*</span></label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-3 px-4 border @error('name') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" placeholder="e.g. Premium Leather Wallet" required>
                                </div>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div class="sm:col-span-2">
                                <label for="category_id" class="block text-sm font-medium text-gray-700">Category <span class="text-red-500">*</span></label>
                                <div class="mt-1">
                                    <select id="category_id" name="category_id" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-3 px-4 border @error('category_id') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" required>
                                        <option value="">Select a category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category_id')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="sm:col-span-6">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <div class="mt-1">
                                    <textarea id="description" name="description" rows="4" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-3 px-4 border @error('description') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" placeholder="Detailed product description">{{ old('description') }}</textarea>
                                </div>
                                @error('description')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Pricing & Inventory Section -->
                    <div class="space-y-6">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Pricing & Inventory</h2>
                            <p class="mt-1 text-sm text-gray-500">Financial and stock details</p>
                        </div>
                        
                        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                            <!-- Price -->
                            <div class="sm:col-span-2">
                                <label for="price" class="block text-sm font-medium text-gray-700">Price <span class="text-red-500">*</span></label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">₦</span>
                                    </div>
                                    <input type="number" step="0.01" min="0" name="price" id="price" value="{{ old('price') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-3 px-4 pl-7 border @error('price') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" placeholder="0.00" required>
                                </div>
                                @error('price')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Discount Price -->
                                <div class="sm:col-span-2">
                                    <label for="discount_price" class="block text-sm font-medium text-gray-700">Discount Price</label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">₦</span>
                                        </div>
                                        <input type="number" step="0.01" min="0" name="discount_price" id="discount_price" value="{{ old('discount_price', isset($product) ? $product->discount_price : '') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-3 px-4 pl-7 border @error('discount_price') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" placeholder="0.00">
                                    </div>
                                    @error('discount_price')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                            <!-- Stock -->
                            <div class="sm:col-span-2">
                                <label for="stock" class="block text-sm font-medium text-gray-700">Stock Quantity <span class="text-red-500">*</span></label>
                                <div class="mt-1">
                                    <input type="number" min="0" name="stock" id="stock" value="{{ old('stock') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm py-3 px-4 border @error('stock') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" placeholder="0" required>
                                </div>
                                @error('stock')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Status</label>
                                <div class="mt-2">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <!-- Hidden input ensures we always get a value -->
                                        <input type="hidden" name="is_active" value="0">
                                        <!-- Checkbox with explicit value -->
                                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', true) ? 'checked' : '' }}>
                                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                        <span class="ms-3 text-sm font-medium text-gray-700">{{ old('is_active', true) ? 'Active' : 'Inactive' }}</span>
                                    </label>
                                </div>
                            </div>

                        <!-- Featured -->
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Featured</label>
                            <div class="mt-2">
                                <label class="inline-flex items-center cursor-pointer">
                                    <!-- Hidden input ensures we always get a value -->
                                    <input type="hidden" name="is_featured" value="0">
                                    <!-- Checkbox with explicit value -->
                                    <input type="checkbox" name="is_featured" value="1" class="sr-only peer" {{ old('is_featured', false) ? 'checked' : '' }}>
                                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                    <span class="ms-3 text-sm font-medium text-gray-700">{{ old('is_featured', false) ? 'Yes' : 'No' }}</span>
                                </label>
                            </div>
                        </div>

                        </div>
                    </div>

                    <!-- Image Upload Section -->
                    <div class="space-y-6">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Product Image</h2>
                            <p class="mt-1 text-sm text-gray-500">Upload a high-quality product photo</p>
                        </div>
                        
                        <div class="sm:col-span-6">
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Upload a file</span>
                                            <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PNG, JPG, GIF up to 2MB
                                    </p>
                                </div>
                            </div>
                            @error('image')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- Gallery Images -->
                        <!-- <div class="space-y-6">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">Gallery Images</h2>
                                <p class="mt-1 text-sm text-gray-500">Upload additional product photos</p>
                            </div>
                            
                            <div class="sm:col-span-6">
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="gallery_images" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                <span>Upload files</span>
                                                <input id="gallery_images" name="gallery_images[]" type="file" class="sr-only" accept="image/*" multiple>
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">
                                            PNG, JPG, GIF up to 2MB each
                                        </p>
                                    </div>
                                </div>
                                @error('gallery_images')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                @error('gallery_images.*')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div> -->

                    <!-- Sizes and Colors -->
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <!-- Sizes -->
                        <div class="sm:col-span-3">
                            <label for="sizes" class="block text-sm font-medium text-gray-700">Available Sizes</label>
                            <div class="mt-2 space-y-2">
    @php
        $selectedSizes = old('sizes', isset($product) ? ($product->sizes ?? []) : []);
        $allSizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
    @endphp

    @foreach ($allSizes as $size)
        <div class="flex items-center">
            <input type="checkbox" id="size_{{ $size }}" name="sizes[]" value="{{ $size }}"
                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                {{ in_array($size, $selectedSizes) ? 'checked' : '' }}>
            <label for="size_{{ $size }}" class="ml-2 block text-sm text-gray-700">
                {{ $size }}
            </label>
        </div>
    @endforeach

    @error('sizes')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

                            @error('sizes')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Colors -->
                        <!-- <div class="sm:col-span-3">
    <label for="colors" class="block text-sm font-medium text-gray-700">Available Colors</label>
    <div class="mt-2 space-y-2">
    @php
        $selectedColors = old('colors', isset($product) ? (array) $product->colors : []);
        $allColors = ['Red', 'Blue', 'Green', 'Black', 'White', 'Yellow'];
    @endphp

    @foreach ($allColors as $color)
        <div class="flex items-center">
            <input type="checkbox" id="color_{{ $color }}" name="colors[]" value="{{ $color }}"
                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                {{ in_array($color, $selectedColors) ? 'checked' : '' }}>
            <label for="color_{{ $color }}" class="ml-2 block text-sm text-gray-700">
                {{ $color }}
            </label>
        </div>
    @endforeach

    @error('colors')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

    @error('colors')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

                    </div>
                </div> -->

                <!-- Form Footer -->
                <div class="px-8 py-4 bg-gray-50 border-t border-gray-200 flex justify-end">
                    <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-1 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Create Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Function to update all totals
    function updateTotals(response) {
        // Update item row total
        let row = $('input[name="quantity"][value="'+response.item_quantity+'"]').closest('tr');
        row.find('td:nth-child(4)').text('$' + response.item_total.toFixed(2));
        
        // Update summary totals
        $('.card-body h6:nth-child(1)').next().text('$' + response.subtotal.toFixed(2));
        $('.card-footer h5:nth-child(2)').text('$' + response.total.toFixed(2));
        
        // Add visual feedback
        row.find('td:nth-child(4)').addClass('highlight');
        setTimeout(() => {
            row.find('td:nth-child(4)').removeClass('highlight');
        }, 500);
    }

    // Quantity minus button
    $('.btn-minus').click(function(e) {
        e.preventDefault();
        let input = $(this).closest('.input-group').find('.quantity-input');
        let value = parseInt(input.val());
        
        if (value > 1) {
            input.val(value - 1);
            submitQuantityUpdate(input);
        }
    });

    // Quantity plus button
    $('.btn-plus').click(function(e) {
        e.preventDefault();
        let input = $(this).closest('.input-group').find('.quantity-input');
        let max = parseInt(input.attr('max'));
        let value = parseInt(input.val());
        
        if (value < max) {
            input.val(value + 1);
            submitQuantityUpdate(input);
        } else {
            alert('Maximum available quantity is ' + max);
        }
    });

    // Manual quantity input
    $('.quantity-input').change(function() {
        let input = $(this);
        let max = parseInt(input.attr('max'));
        let value = parseInt(input.val());
        
        if (value < 1) {
            input.val(1);
            value = 1;
        } else if (value > max) {
            input.val(max);
            value = max;
            alert('Maximum available quantity is ' + max);
            return;
        }
        
        submitQuantityUpdate(input);
    });

    // AJAX function to submit quantity update
    function submitQuantityUpdate(input) {
        let form = input.closest('form');
        let row = form.closest('tr');
        
        // Show loading indicator
        let buttons = form.find('.btn-minus, .btn-plus');
        buttons.prop('disabled', true);
        
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                updateTotals({
                    item_quantity: input.val(),
                    item_total: response.item_total,
                    subtotal: response.subtotal,
                    total: response.total
                });
            },
            error: function(xhr) {
                alert('Error updating cart: ' + xhr.responseJSON.message);
                // Revert to original value
                input.val(input.data('original-value'));
            },
            complete: function() {
                buttons.prop('disabled', false);
            }
        });
    }

    // Store original values on page load
    $('.quantity-input').each(function() {
        $(this).data('original-value', $(this).val());
    });
});
</script>
@endpush

<style>
.highlight {
    background-color: #f8f9fa;
    transition: background-color 0.5s ease;
    animation: pulse 0.5s;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}
</style>