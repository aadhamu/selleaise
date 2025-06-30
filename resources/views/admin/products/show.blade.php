@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Product Details</h1>
        <div>
            <a href="{{ route('admin.products.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Products
            </a>
            <a href="{{ route('admin.products.edit', $product->id) }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">
                <i class="fas fa-edit fa-sm text-white-50"></i> Edit
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $product->name }}</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded mb-4">
                    @else
                        <div class="bg-light p-5 text-center mb-4">
                            <i class="fas fa-image fa-5x text-gray-300"></i>
                            <p class="mt-2">No image available</p>
                        </div>
                    @endif

                    <ul class="list-group mb-4">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Status
                            <span class="badge badge-{{ $product->is_active ? 'success' : 'danger' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Price
                            <span class="font-weight-bold">₦{{ number_format($product->price, 2) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Stock
                            <span class="font-weight-bold">{{ $product->stock }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Category
                            <span class="font-weight-bold">{{ $product->category->name }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Featured
                            <span class="badge badge-{{ $product->is_featured ? 'success' : 'secondary' }}">
                                {{ $product->is_featured ? 'Yes' : 'No' }}
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Discount Price
                            <span class="font-weight-bold">₦{{ number_format($product->discount_price, 2) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Views
                            <span class="font-weight-bold">{{ $product->views }}</span>
                        </li>
                    </ul>
                </div>

                <div class="col-md-8">
                    <h4 class="mb-3">Description</h4>
                    <p>{{ $product->description ?? 'No description provided.' }}</p>

                    <div class="mt-4">
                        <h4 class="mb-3">Additional Information</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Created At</th>
                                        <td>{{ $product->created_at->format('M d, Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated At</th>
                                        <td>{{ $product->updated_at->format('M d, Y H:i') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <h4 class="mb-3">Available Sizes</h4>
                    <div class="d-flex flex-wrap gap-2">
                        @forelse($product->sizes ?? [] as $size)
                            <span class="badge badge-primary">{{ $size }}</span>
                        @empty
                            <span class="text-muted">No sizes specified</span>
                        @endforelse
                    </div>
                </div>
                
                <div class="mt-4">
                    <h4 class="mb-3">Available Colors</h4>
                    <div class="d-flex flex-wrap gap-2">
                        @forelse($product->colors ?? [] as $color)
                            <span class="badge" style="background-color: {{ $color }}; color: white;">{{ $color }}</span>
                        @empty
                            <span class="text-muted">No colors specified</span>
                        @endforelse
                    </div>
                </div>
                
                @if(!empty($product->gallery_images))
                <div class="mt-4">
                    <h4 class="mb-3">Gallery Images</h4>
                    <div class="row">
                        @foreach($product->gallery_images as $image)
                        <div class="col-md-3 mb-3">
                            <img src="{{ $image }}" alt="Gallery Image" class="img-thumbnail">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection