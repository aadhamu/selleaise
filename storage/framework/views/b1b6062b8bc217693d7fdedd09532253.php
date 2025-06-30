<?php $__env->startSection('hero'); ?>
<!-- Hero Carousel -->
<div class="container-fluid px-0">
    <div id="header-carousel" class="carousel slide" data-ride="carousel" data-interval="5000">
        <div class="carousel-inner">
            <div class="carousel-item active" style="height: 500px;">
                <img class="img-fluid w-100 h-100" src="<?php echo e(asset('eshopper-1.0.0/img/caro1.jpeg')); ?>" 
                     alt="Image" style="object-fit: cover;">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        
                        <h3 class="display-4 font-weight-bold mb-4" style="color: var(--secondary-color);">Fast And Simple Buys</h3>
                        <a href="<?php echo e(route('shop')); ?>" class="btn btn-success py-2 px-3">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="height: 500px;">
                <img class="img-fluid w-100 h-100" src="<?php echo e(asset('eshopper-1.0.0/img/caro2.jpeg')); ?>" 
                     alt="Image" style="object-fit: cover;">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        
                        <h3 class="display-4 font-weight-bold mb-4"  style="color: var(--secondary-color);">Buy Smarter</h3>
                        <a href="<?php echo e(route('shop')); ?>" class="btn btn-success py-2 px-3">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="height: 500px;">
                <img class="img-fluid w-100 h-100" src="<?php echo e(asset('eshopper-1.0.0/img/caro3.jpeg')); ?>" 
                     alt="Image" style="object-fit: cover;">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        
                        <h3 class="display-4 font-weight-bold mb-4"  style="color: var(--secondary-color);">Manage Better</h3>
                        <a href="<?php echo e(route('shop')); ?>" class="btn btn-success py-2 px-3">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
        </a>
        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-next-icon mb-n2"></span>
            </div>
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Featured Start -->
    
    <!-- Featured End -->

    <!-- Featured Products Start -->
    <style>
        /* Added styles for consistent product images */
        .product-img {
            height: 250px; /* Fixed height for all product images */
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
        }
        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: contain; /* Changed from cover to contain to show full product */
            transition: transform 0.3s ease;
        }
        .product-item:hover .product-img img {
            transform: scale(1.05);
        }


                /* Customer Service Banner */
        .service-banner {
            background-color: var(--light-color);
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--box-shadow);
            margin: 2rem 0;
            border-top: 3px solid var(--primary-color);
        }

        .service-item {
            text-align: center;
            padding: 1rem;
            transition: var(--transition);
        }

        .service-item:hover {
            transform: translateY(-5px);
        }

        .service-icon {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
    </style>



        <!-- Customer Service Banner -->
    <div class="container">
        <div class="service-banner">
            <div class="row text-center" >
                <div class="col-md-3 col-6 service-item">
                    <div class="service-icon">
                        <i class="fas fa-undo"></i>
                    </div>
                    <h5 class="font-weight-bold" style="color: var(--secondary-color);">Easy Returns</h5>
                    <p class="small text-success">30-day return policy</p>
                </div>
                <div class="col-md-3 col-6 service-item">
                    <div class="service-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h5 class="font-weight-bold" style="color: var(--secondary-color);">Secure Payment</h5>
                    <p class="small text-success">100% secure checkout</p>
                </div>
                <div class="col-md-3 col-6 service-item">
                    <div class="service-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h5 class="font-weight-bold" style="color: var(--secondary-color);">24/7 Support</h5>
                    <p class="small text-success">Dedicated support</p>
                </div>
            </div>
        </div>
    </div>

    <!-- New Arrivals Start -->
    <!-- <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5" style="color: var(--secondary-color);"><span class="px-2">New Arrivals</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            <?php $__currentLoopData = $newArrivals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid" src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3 font-weight-bold" style="color: var(--secondary-color);"><?php echo e($product->name); ?></h6>
                        <div class="d-flex justify-content-center">
                            <h6 class="text-success">₦<?php echo e(number_format($product->price, 2)); ?></h6>
                            <?php if($product->discount_price): ?>
                            <h6 class="text-muted ml-2"><del>₦<?php echo e(number_format($product->discount_price, 2)); ?></del></h6>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="<?php echo e(route('shop-details', $product->slug)); ?>" class="btn btn-sm  p-0" style="color: var(--secondary-color);">
                            <i class="fas fa-eye font-weight-bold text-success mr-1 p-0 font-weight-bold"></i>View Detail
                        </a>
                        <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-sm  p-0" style="color: var(--secondary-color);">
                                <i class="fas fa-shopping-cart font-weight-bold text-success mr-1 p-0 font-weight-bold"></i>Add To Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div> -->
    <div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5" style="color: var(--secondary-color);">
            <span class="px-2">New Arrivals</span>
        </h2>
    </div>

    <div class="row px-xl-5 pb-3">
        <?php $__currentLoopData = $newArrivals->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid" src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3 font-weight-bold" style="color: var(--secondary-color);"><?php echo e($product->name); ?></h6>
                        <div class="d-flex justify-content-center">
                            <h6 class="text-success">₦<?php echo e(number_format($product->price, 2)); ?></h6>
                            <?php if($product->discount_price): ?>
                                <h6 class="text-muted ml-2"><del>₦<?php echo e(number_format($product->discount_price, 2)); ?></del></h6>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="<?php echo e(route('shop-details', $product->slug)); ?>" class="btn btn-sm p-0" style="color: var(--secondary-color);">
                            <i class="fas fa-eye font-weight-bold text-success mr-1 p-0"></i>View Detail
                        </a>
                        <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-sm p-0" style="color: var(--secondary-color);">
                                <i class="fas fa-shopping-cart font-weight-bold text-success mr-1 p-0"></i>Add To Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <?php if($newArrivals->count() >= 4): ?>
        <div class="text-center mt-3">
            <a href="<?php echo e(route('shop')); ?>" class="btn btn-outline-success">Go to Shop</a>
        </div>
    <?php endif; ?>
</div>

    <!-- New Arrivals End -->
    









    <!-- Subscribe Start -->
<div class="container-fluid py-5" style="background: linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.8)), url('<?php echo e(asset('eshopper-1.0.0/img/caro1.jpeg')); ?>') no-repeat center center; background-size: cover;">
    <div class="row justify-content-md-center px-xl-5">
        <div class="col-md-8 col-12 text-center">
            <h2 class="section-title px-5 mb-3"><span class="bg-light px-2">Curated with Care</span></h2>
            <p class="lead mb-4" style="text-shadow: 0 1px 2px rgba(0,0,0,0.1);">
                Handpicked styles and bestsellers you'll love. Shop our top-rated selections, just for you.
            </p>
            <a href="#featured" class="btn btn-outline-dark px-4 py-2">Explore Featured</a>
        </div>
    </div>
</div>
    <!-- Subscribe End -->

        <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5" style="color: var(--secondary-color);"><span class="px-2">Featured Products</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            <?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid" src="<?php echo e($product->image_url); ?>" alt="<?php echo e($product->name); ?>">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3 font-weight-bold" style="color: var(--secondary-color);"><?php echo e($product->name); ?></h6>
                        <div class="d-flex justify-content-center">
                            <h6 class="text-success">₦<?php echo e(number_format($product->price, 2)); ?></h6>
                            <?php if($product->discount_price): ?>
                            <h6 class="text-muted ml-2"><del>₦<?php echo e(number_format($product->discount_price, 2)); ?></del></h6>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="<?php echo e(route('shop-details', $product->slug)); ?>" class="btn btn-sm  p-0 font-weight-bold" style="color: var(--secondary-color);">
                            <i class="fas fa-eye text-success mr-1 font-weight-bold"></i>View Detail
                        </a>
                        <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-sm  p-0" style="color: var(--secondary-color);">
                                <i class="fas fa-shopping-cart text-success mr-1 font-weight-bold"></i>Add To Cart
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <!-- Featured Products End -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.frontend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\selleaise\resources\views/frontend/welcome.blade.php ENDPATH**/ ?>