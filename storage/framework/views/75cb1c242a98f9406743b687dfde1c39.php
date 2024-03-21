<body>


    <!--[if lte IE 9]>
    	<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  <![endif]-->



    <!--********************************
   		Code Start From Here
	******************************** -->




    <!--==============================
     Preloader
  ==============================-->
    <div class="preloader ">
        <button class="th-btn style3 preloaderCls">Cancel Preloader </button>
        <div class="preloader-inner">
            <span class="loader"></span>
        </div>
    </div><!--==============================
    Sidemenu
============================== -->
    <div class="sidemenu-wrapper  d-lg-block d-md-block d-sm-block ">
        <div class="sidemenu-content">
            <button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>
            <div class="widget woocommerce widget_shopping_cart">
                <h3 class="widget_title">Shopping cart</h3>
                <div class="widget_shopping_cart_content">
                    <ul id="noticart" class="woocommerce-mini-cart cart_list product_list_widget ">
                        <?php if(session('cart')): ?>
                        <?php $__currentLoopData = session('cart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="woocommerce-mini-cart-item mini_cart_item">
                            <a data-id="<?php echo e($id); ?>" href="#"  class="remove remove_from_cart_button remove-from-cart"><i class="far fa-times"></i></a>
                            <a href="<?php echo e(route('product.show',  $id  )); ?>"><img src="<?php echo e(url('public/products/' .$details['image']  )); ?>" alt="Cart Image"><?php echo e($details['name']); ?></a>
                            <span class="quantity"><?php echo e($details['quantity']); ?> ×
                                <span class="woocommerce-Price-amount amount">
                                    <span class="woocommerce-Price-currencySymbol"><?php echo e($shop->currency->name); ?></span><?php echo e($details['price']); ?></span>
                            </span>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                    </ul>
                                                <?php $total = 0 ?>
                                                <?php $__currentLoopData = (array) session('cart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $total += $details['price'] * $details['quantity'] ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <p class="woocommerce-mini-cart__total total">
                        <strong>Subtotal:</strong>
                        <span class="woocommerce-Price-amount amount">
                            <span id="subtotal" class="woocommerce-Price-currencySymbol"><?php echo e($total); ?> <?php echo e($shop->currency->name); ?></span></span>
                    </p>
                    <p class="woocommerce-mini-cart__buttons buttons">
                        <a href="<?php echo e(route('cart')); ?>" class="th-btn wc-forward">View cart</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
   <!--==============================
    Mobile Menu
  ============================== -->
    <div class="th-menu-wrapper">
        <div class="th-menu-area text-center">
            <button class="th-menu-toggle"><i class="fal fa-times"></i></button>
            <div class="mobile-logo">
                <a href="<?php echo e(route('website.shopp',$shop->slug)); ?>"><img src="<?php echo e(url('public/website/assets/img/logo.svg')); ?>" alt="Pizzan"></a>
            </div>
            <div class="th-mobile-menu">
                <ul>
                    <li class="menu-item-has-children">
                        <a href="<?php echo e(route('website.shopp',$shop->slug)); ?>">Home</a>
                    </li>

                </ul>
            </div>
        </div>
    </div><!--==============================
	Header Area
==============================-->
    <header class="th-header header-layout5">
        <div class="header-top">
            <div class="container">
                <div class="row justify-content-center justify-content-lg-between align-items-center">
                    <div class="col-auto d-none d-lg-block">
                        <p class="header-notice">Welcome To Our Resturant</p>
                    </div>
                    <div class="col-auto">
                        <div class="header-links">
                            <ul>
                                <li><i class="fal fa-location-dot"></i><?php echo e($shop->address); ?></li>
                                <li>
                                    <div class="header-social">
                                        <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                                        <a href="https://www.twitter.com/"><i class="fab fa-twitter"></i></a>
                                        <a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sticky-wrapper">
            <!-- Main Menu Area -->
            <div class="menu-area">
                <div class="container">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto">
                            <div class="header-logo">
                                <a href="<?php echo e(route('website.shopp',$shop->slug)); ?>">
                                    <img src="<?php echo e(url('public/shops/' . $shop->logo)); ?>" alt="Pizzan">
                                </a>
                            </div>
                        </div>
                        <div class="col-auto me-xl-auto">
                            <nav class="main-menu d-none d-lg-inline-block">
                                <ul>
                                    <li class="menu-item-has-children">
                                        <a href="<?php echo e(route('website.shopp',$shop->slug)); ?>">Home</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-auto">
                            <div class="header-button">
                                <button type="button" class="simple-icon sideMenuToggler ">
                                    <i class="far fa-cart-shopping"></i>
                                    <span id="orderCount" class="badge"><?php echo e(count((array) session('cart'))); ?></span>
                                </button>
                                <button type="button" class="th-menu-toggle d-inline-block d-lg-none"><i class="far fa-bars"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="logo-bg"></div>
            </div>
        </div>
    </header>
<?php /**PATH /home/jcwbgkteayia/public_html/Menu/resources/views/website/includes/header.blade.php ENDPATH**/ ?>