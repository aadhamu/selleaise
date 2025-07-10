@extends('layout.frontend')

@section('content')

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
  <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
      <h1 class="font-weight-semi-bold text-uppercase mb-3">Shop Detail</h1>
      <div class="d-inline-flex">
          <p class="m-0"><a href="/">Home</a></p>
          <p class="m-0 px-2">-</p>
          <p class="m-0">Shop Detail</p>
      </div>
  </div>
</div>
<!-- Page Header End -->

<!-- Shop Detail Start -->
<div class="container-fluid px-xl-5">
    <div class="row justify-content-center">
        <!-- Product Images -->
        <div class="col-lg-6 pb-5 d-flex justify-content-center align-items-center">
            <div id="product-carousel" class="carousel slide" data-ride="carousel" style="max-width: 500px; width: 100%;">
                <div class="carousel-inner border rounded shadow-sm bg-white">
                    @foreach($product->gallery_images ?: [$product->image_url] as $image)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                            <img class="d-block w-100 img-fluid" style="max-height: 450px; object-fit: contain;" src="{{ $image }}" alt="{{ $product->name }}">
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                    <i class="fa fa-2x fa-angle-left text-success"></i>
                </a>
                <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                    <i class="fa fa-2x fa-angle-right text-success"></i>
                </a>
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-lg-6 pb-5">
            <h3 class="font-weight-semi-bold">{{ $product->name }}</h3>
            <div class="d-flex mb-3"></div>

            <h3 class="font-weight-semi-bold mb-4">₦{{ number_format($product->price, 2) }}</h3>
            <p class="mb-4">{{ $product->description }}</p>
            
            <!-- Size Selection -->
            @if($product->sizes)
            <div class="d-flex mb-3">
                <p class="text-success font-weight-medium mb-0 mr-3">Sizes:</p>
                <form>
                    @foreach($product->sizes as $size)
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="size-{{ $loop->index }}" name="size" value="{{ $size }}">
                        <label class="custom-control-label" for="size-{{ $loop->index }}">{{ $size }}</label>
                    </div>
                    @endforeach
                </form>
            </div>
            @endif

            <!-- Color Selection -->
            @if($product->colors)
            <div class="d-flex mb-4">
                <p class="text-success font-weight-medium mb-0 mr-3">Colors:</p>
                <form>
                    @foreach($product->colors as $color)
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="color-{{ $loop->index }}" name="color" value="{{ $color }}">
                        <label class="custom-control-label" for="color-{{ $loop->index }}">{{ $color }}</label>
                    </div>
                    @endforeach
                </form>
            </div>
            @endif

            <!-- Add to Cart Form -->
            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                @csrf
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-success btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control bg-secondary text-center" name="quantity" value="1">
                        <div class="input-group-btn">
                            <button type="button" class="btn btn-success btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success px-3">
                        <i class="fa fa-shopping-cart mr-1"></i> Add To Cart
                    </button>
                </div>
                <input type="hidden" name="size" id="selected-size">
                <input type="hidden" name="color" id="selected-color">
            </form>

            <!-- Product Description Tabs -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <h4 class="mb-3" style="color: var(--secondary-color);">Product Description</h4>
                    <p>{{ $product->description }}</p>
                </div>
            </div>

            <!-- Optional UX Boost -->
             
        </div>
    </div>
</div>
<!-- Shop Detail End -->

<!-- Related Products -->
<div class="container-fluid py-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5" style="color: var(--secondary-color);"><span class="px-2">You May Also Like</span></h2>
    </div>
    <div class="row px-xl-5">
        @foreach($relatedProducts as $product)
        <div class="col-lg-3 col-md-6 col-6 pb-2">
            <div class="card product-item border-0">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="{{ $product->image_url }}" alt="{{ $product->name }}">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                    <div class="d-flex justify-content-center">
                        <h6>₦{{ number_format($product->price, 2) }}</h6>
                        @if($product->discount_price)
                        <h6 class="text-muted ml-2"><del>₦{{ number_format($product->discount_price, 2) }}</del></h6>
                        @endif
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border px-2 py-1">
                    <a href="{{ route('shop-details', $product->slug) }}" class="btn btn-xs text-dark px-1 py-0">
                        <i class="fas fa-eye text-success mr-1"></i>View
                    </a>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn btn-xs text-dark px-1 py-0">
                            <i class="fas fa-shopping-cart text-success mr-1"></i>Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Additional Styling -->
<style>
.btn-xs {
    font-size: 0.75rem;
    line-height: 1;
    padding: 0.25rem 0.4rem;
}
.carousel-inner img {
    border-radius: 10px;
    background-color: #f9f9f9;
}
</style>

@endsection
