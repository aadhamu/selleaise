

<?php $__env->startSection('content'); ?>

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
                    <?php $__currentLoopData = $product->gallery_images ?: [$product->image_url]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="carousel-item <?php echo e($loop->first ? 'active' : ''); ?>">
                            <img class="d-block w-100 img-fluid" style="max-height: 450px; object-fit: contain;" src="<?php echo e($image); ?>" alt="<?php echo e($product->name); ?>">
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            <h3 class="font-weight-semi-bold"><?php echo e($product->name); ?></h3>
            <div class="d-flex mb-3"></div>

            <h3 class="font-weight-semi-bold mb-4">₦<?php echo e(number_format($product->price, 2)); ?></h3>
            <p class="mb-4"><?php echo e($product->description); ?></p>
            
            <!-- Size Selection -->
            <?php if($product->sizes): ?>
            <div class="d-flex mb-3">
                <p class="text-success font-weight-medium mb-0 mr-3">Sizes:</p>
                <form>
                    <?php $__currentLoopData = $product->sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="size-<?php echo e($loop->index); ?>" name="size" value="<?php echo e($size); ?>">
                        <label class="custom-control-label" for="size-<?php echo e($loop->index); ?>"><?php echo e($size); ?></label>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </form>
            </div>
            <?php endif; ?>

            <!-- Color Selection -->
            <?php if($product->colors): ?>
            <div class="d-flex mb-4">
                <p class="text-success font-weight-medium mb-0 mr-3">Colors:</p>
                <form>
                    <?php $__currentLoopData = $product->colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="color-<?php echo e($loop->index); ?>" name="color" value="<?php echo e($color); ?>">
                        <label class="custom-control-label" for="color-<?php echo e($loop->index); ?>"><?php echo e($color); ?></label>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </form>
            </div>
            <?php endif; ?>

            <!-- Add to Cart Form -->
            <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
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
                    <p><?php echo e($product->description); ?></p>
                </div>
            </div>

            <!-- Optional UX Boost -->
            <div class="alert alert-success mt-4 text-center" style="font-size: 0.95rem;">
                ✅ Enjoy same-day delivery in Abuja & 7-day money-back guarantee!
            </div>
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
        <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-lg-3 col-md-6 col-6 pb-2">
            <div class="card product-item border-0">
                <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                    <img class="img-fluid w-100" src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>">
                </div>
                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                    <h6 class="text-truncate mb-3"><?php echo e($product->name); ?></h6>
                    <div class="d-flex justify-content-center">
                        <h6>₦<?php echo e(number_format($product->price, 2)); ?></h6>
                        <?php if($product->discount_price): ?>
                        <h6 class="text-muted ml-2"><del>₦<?php echo e(number_format($product->discount_price, 2)); ?></del></h6>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between bg-light border px-2 py-1">
                    <a href="<?php echo e(route('shop-details', $product->slug)); ?>" class="btn btn-xs text-dark px-1 py-0">
                        <i class="fas fa-eye text-success mr-1"></i>View
                    </a>
                    <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn btn-xs text-dark px-1 py-0">
                            <i class="fas fa-shopping-cart text-success mr-1"></i>Cart
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\selleaise\resources\views/frontend/shop-details.blade.php ENDPATH**/ ?>