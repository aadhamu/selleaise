<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SellEase | Premium Online Shopping</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="SellEase - Your premium destination for quality products with seamless shopping experience">
    <meta name="keywords" content="ecommerce, online shopping, premium products">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?php echo e(asset('eshopper-1.0.0/lib/owlcarousel/assets/owl.carousel.min.css')); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #2ecc71; /* Vibrant green */
            --primary-dark: #27ae60;
            --secondary-color: #34495e; /* Soft black */
            --dark-color: #2c3e50; /* Darker soft black */
            --light-color: #ffffff;
            --accent-color: #f1c40f; /* For highlights */
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--secondary-color);
            background-color: #f9f9f9;
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: var(--dark-color);
        }

        .bg-dark {
            background-color: var(--secondary-color) !important;
        }

        .bg-primary {
            background-color: var(--primary-color) !important;
        }

        .text-primary {
            color: var(--primary-color) !important;
        }

        .text-white {
            color: var(--light-color) !important;
        }

        /* Header Styles */
        .top-bar {
            background-color: var(--dark-color);
            color: white;
            font-size: 0.9rem;
        }

        .top-bar a {
            color: rgba(255,255,255,0.8);
            transition: var(--transition);
        }

        .top-bar a:hover {
            color: white;
            text-decoration: none;
        }

        .social-icon {
            color: rgba(255,255,255,0.7);
            transition: var(--transition);
        }

        .social-icon:hover {
            color: var(--primary-color);
            transform: translateY(-2px);
        }

        /* Navbar Styles */
        .navbar {
            background-color: var(--light-color) !important;
            box-shadow: var(--box-shadow);
        }

        .navbar-brand {
            font-weight: 700;
        }

        .nav-item {
            margin: 0 0.5rem;
        }

        .nav-link {
            color: var(--dark-color) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary-color) !important;
            background-color: rgba(46, 204, 113, 0.1);
        }

        /* Search Box */
        .search-box {
            border-radius: var(--border-radius);
            border: 1px solid #e0e0e0;
            overflow: hidden;
            transition: var(--transition);
        }

        .search-box:hover {
            border-color: var(--primary-color);
        }

        .search-box input {
            border: none;
            padding: 0.75rem 1rem;
        }

        .search-box .input-group-append {
            background-color: var(--primary-color);
            color: white;
            padding: 0 1.25rem;
            cursor: pointer;
            transition: var(--transition);
        }

        .search-box .input-group-append:hover {
            background-color: var(--primary-dark);
        }

        /* Button Styles */
        .btn {
            border-radius: var(--border-radius);
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            transition: var(--transition);
            border: none;
        }

        .btn-primary {
            background-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(46, 204, 113, 0.3);
        }

        .btn-outline-primary {
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-icon {
            width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background-color: white;
            color: var(--primary-color);
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            border: 1px solid #e0e0e0;
        }

        .btn-icon:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            border-color: var(--primary-color);
        }

        /* Footer Styles */
        .footer {
            background-color: var(--secondary-color);
            color: white;
            padding: 3rem 0;
        }

        .footer a {
            color: rgba(255,255,255,0.7);
            transition: var(--transition);
        }

        .footer a:hover {
            color: var(--primary-color);
            text-decoration: none;
        }

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-links a {
            display: inline-block;
            padding: 0.25rem 0;
        }

        .footer-links a:hover {
            transform: translateX(5px);
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1.5rem;
        }



        /* Back to Top Button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 99;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 4px 12px rgba(46, 204, 113, 0.3);
            border: none;
        }

        .back-to-top:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
        }

        .back-to-top.active {
            opacity: 1;
            visibility: visible;
        }

        /* Card Styles */
        .product-card {
            border: none;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            background-color: var(--light-color);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .product-img {
            height: 200px;
            object-fit: cover;
        }

        /* Utility Classes */
        .rounded-lg {
            border-radius: var(--border-radius);
        }

        .shadow-sm {
            box-shadow: var(--box-shadow);
        }

        .transition {
            transition: var(--transition);
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .navbar-collapse {
                background-color: white;
                padding: 1rem;
                box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
                border-radius: var(--border-radius);
                margin-top: 0.5rem;
            }
            
            .service-item {
                margin-bottom: 1.5rem;
            }
        }
    </style>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo e(asset('eshopper-1.0.0/css/style.css')); ?>" rel="stylesheet">

    <?php echo $__env->yieldContent('style'); ?>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>

<body>


    <!-- Main Header -->
    <div class="container-fluid bg-white shadow-sm">
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="/" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-bold">
                        <span class="text-success">Sell</span><span style="color: var(--secondary-color);">Ease</span>
                    </h1>
                </a>
            </div>
            <div class="col-lg-6 col-6 text-left">
                <form action="">
                    <div class="input-group search-box">
                        <input type="text" class="form-control" placeholder="Search for products...">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 col-6 text-right">
                <a href="<?php echo e(route('admin.login')); ?>" class="btn-icon mr-2">
                    <i class="fas fa-user"></i>
                </a>
                <a href="<?php echo e(route('cart')); ?>" class="btn-icon position-relative">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        
                    </span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <div class="container-fluid mb-0">
        <div class="row border-top px-xl-5">
            <div class="col-lg-12 px-0">
                <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-bold">
                            <span class="text-success">Sell</span><span style="color: var(--secondary-color);">Ease</span>
                        </h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="/" class="nav-item nav-link active">Home</a>
                            <a href="<?php echo e(route('shop')); ?>" class="nav-item nav-link">Shop</a>
                            <a href="<?php echo e(route('contact')); ?>" class="nav-item nav-link">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0">
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Account</a>
                                <div class="dropdown-menu rounded-lg shadow-sm border-0">
                                    <a href="<?php echo e(route('admin.login')); ?>" class="dropdown-item">Login</a>
                                    <a href="#" class="dropdown-item">Register</a>
                                    <a href="#" class="dropdown-item">My Account</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <?php echo $__env->yieldContent('hero'); ?>

    <!-- Customer Service Banner -->
    

    <?php echo $__env->yieldContent('content'); ?>

    <!-- Footer Start -->
    <div class="container-fluid footer">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-6 mb-5 pr-3 pr-xl-5">
                <a href="" class="text-decoration-none">
                    <h1 class="mb-4 display-5 font-weight-bold">
                        <span class="text-success">Sell</span><span class="text-white">Ease</span>
                    </h1>
                </a>
                <p class="text-white-50 mb-4">SellEase Premium online shopping destination offering quality products with seamless shopping experience.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-success mr-3"></i>123 Business Avenue, City, Country</p>
                <p class="mb-2"><i class="fa fa-envelope text-success mr-3"></i>info@sellease.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-success mr-3"></i>+1 234 567 8900</p>
            </div>
            <div class="col-lg-8 col-md-6">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-white mb-4">Quick Links</h5>
                        <ul class="list-unstyled footer-links">
                            <li><a href="/"><i class="fa fa-angle-right mr-2"></i>Home</a></li>
                            <li><a href="<?php echo e(route('shop')); ?>"><i class="fa fa-angle-right mr-2"></i>Our Shop</a></li>
                            <li><a href="#"><i class="fa fa-angle-right mr-2"></i>Featured Products</a></li>
                            <li><a href="<?php echo e(route('cart')); ?>"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a></li>
                            <li><a href="<?php echo e(route('contact')); ?>"><i class="fa fa-angle-right mr-2"></i>Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-white mb-4">Customer Service</h5>
                        <ul class="list-unstyled footer-links">
                            <li><a href="#"><i class="fa fa-angle-right mr-2"></i>My Account</a></li>
                            <li><a href="#"><i class="fa fa-angle-right mr-2"></i>Order Tracking</a></li>
                            <li><a href="#"><i class="fa fa-angle-right mr-2"></i>Wishlist</a></li>
                            <li><a href="#"><i class="fa fa-angle-right mr-2"></i>Terms & Conditions</a></li>
                            <li><a href="#"><i class="fa fa-angle-right mr-2"></i>Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-white mb-4">Payment Methods</h5>
                        <div class="d-flex flex-wrap">
                            <div class="bg-white rounded-lg p-2 mr-2 mb-2">
                                <i class="fab fa-cc-visa fa-2x text-dark"></i>
                            </div>
                            <div class="bg-white rounded-lg p-2 mr-2 mb-2">
                                <i class="fab fa-cc-mastercard fa-2x text-dark"></i>
                            </div>
                            <div class="bg-white rounded-lg p-2 mr-2 mb-2">
                                <i class="fab fa-cc-paypal fa-2x text-dark"></i>
                            </div>
                            <div class="bg-white rounded-lg p-2 mr-2 mb-2">
                                <i class="fab fa-cc-amex fa-2x text-dark"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row footer-bottom border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-white-50">
                    &copy; <span class="text-success">2025 SellEase</span>. All Rights Reserved.
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <div class="d-inline-flex">
                    <a class="text-white-50 px-2" href="#">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-white-50 px-2" href="#">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-white-50 px-2" href="#">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-white-50 px-2" href="#">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="<?php echo e(asset('eshopper-1.0.0/lib/easing/easing.min.js')); ?>"></script>
    <script src="<?php echo e(asset('eshopper-1.0.0/lib/owlcarousel/owl.carousel.min.js')); ?>"></script>
    
    <!-- Custom Script -->
    <script>
        // Back to top button
        $(window).scroll(function() {
            if ($(this).scrollTop() > 300) {
                $('.back-to-top').addClass('active');
            } else {
                $('.back-to-top').removeClass('active');
            }
        });
        
        $('.back-to-top').click(function(e) {
            e.preventDefault();
            $('html, body').animate({scrollTop: 0}, '300');
        });

        // Smooth scrolling for anchor links
        $('a[href*="#"]').on('click', function(e) {
            e.preventDefault();
            
            $('html, body').animate(
                {
                    scrollTop: $($(this).attr('href')).offset().top - 100,
                },
                500,
                'linear'
            );
        });
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\selleaise\resources\views/layout/frontend.blade.php ENDPATH**/ ?>