

<?php $__env->startSection('content'); ?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Our Shop</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Shop</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Shop Start -->
<style>
    .product-img-container {
        height: 250px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
    }
    .product-img-container img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }
    .product-item:hover .product-img-container img {
        transform: scale(1.05);
    }

    .btn-xs {
        font-size: 0.75rem;
        line-height: 1;
        padding: 0.25rem 0.4rem;
    }
</style>

<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <!-- Shop Product Start -->
        <div class="col-12">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <form action="<?php echo e(route('shop')); ?>" method="GET" class="w-75">
                            <input type="hidden" name="price_range" value="<?php echo e(request('price_range')); ?>">
                            <input type="hidden" name="color" value="<?php echo e(request('color')); ?>">
                            <input type="hidden" name="size" value="<?php echo e(request('size')); ?>">
                        </form>
                        <div class="dropdown ml-4">
                            <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                Sort by
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                <a class="dropdown-item" href="<?php echo e(route('shop', array_merge(request()->query(), ['sort' => 'latest']))); ?>">Latest</a>
                                <a class="dropdown-item" href="<?php echo e(route('shop', array_merge(request()->query(), ['sort' => 'popularity']))); ?>">Popularity</a>
                                <a class="dropdown-item" href="<?php echo e(route('shop', array_merge(request()->query(), ['sort' => 'price_asc']))); ?>">Price: Low to High</a>
                                <a class="dropdown-item" href="<?php echo e(route('shop', array_merge(request()->query(), ['sort' => 'price_desc']))); ?>">Price: High to Low</a>
                            </div>
                        </div>
                    </div>
                </div>

                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-6 col-md-3 mb-3">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img-container position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid" src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>">
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
                                <a href="<?php echo e(route('shop-details', $product->slug)); ?>" class="btn btn-xs text-dark px-1 py-0 font-weight-normal">
                                    <i class="fas fa-eye text-primary mr-1"></i> View
                                </a>
                                <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-xs text-dark px-1 py-0 font-weight-normal">
                                        <i class="fas fa-shopping-cart text-primary mr-1"></i> Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <div class="col-12 pb-1">
                    <?php echo e($products->appends(request()->query())->links()); ?>

                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xamppp\htdocs\selleaise\resources\views/frontend/shop.blade.php ENDPATH**/ ?>