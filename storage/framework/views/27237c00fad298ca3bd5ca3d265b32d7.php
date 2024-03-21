<?php $__env->startSection('title', "$shop->slug"); ?>
<?php $__env->startSection('body'); ?>
<div class="breadcumb-wrapper " data-bg-src="<?php echo e(url('public/shops/' . $shop->cover)); ?>">
    <div class="container z-index-common">
        <div class="breadcumb-content">
            <h1 class="breadcumb-title text-center"><?php echo e($shop->name); ?></h1>
        </div>
    </div>
</div>


<section class="th-product-wrapper space-top space-extra-bottom">
    <div class="container">
        <?php if(session('done')): ?>
        <div class="woocommerce-notices-wrapper">
            <div class="woocommerce-message">
            <?php echo e(session('done')); ?>

            </div>
        </div>
        <?php endif; ?>
        <div class="th-sort-bar">
                <div class="testi-grid-tab">
                    <div class="tab-slide th-carousel" data-asnavfor=".testi-grid-slide" data-slide-show="3" data-lg-slide-show="3" data-md-slide-show="3" data-sm-slide-show="3" data-xs-slide-show="3" data-center-mode="true" data-xl-center-mode="true" data-ml-center-mode="true" data-lg-center-mode="true" data-md-center-mode="true" data-sm-center-mode="true" data-xs-center-mode="true" data-arrows="true" data-xl-arrows="true" data-ml-arrows="true" data-lg-arrows="true" data-sm-arrows="true" data-xs-arrows="true"  data-infinite="true">
                        <?php $__currentLoopData = $shop->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div>
                            <button id="mc-submit" value="<?php echo e($category->id); ?>" type="button" class="border-0 bg-smoke2 category center text-center justify-content-center">
                                <div class="slide-img center ">
                                    <img src="<?php echo e(url('public/categories/' . $category->image)); ?>" alt="avater">
                                </div>
                                <label class="pt-2"> <?php echo e($category->name); ?></label>
                            </button>
                            <input type="hidden" id="shopId" class="form-control" name="shop_id" value="<?php echo e($shop->id); ?>">


                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="testi-grid-area">
                    <div class="th-carousel testi-grid-slide" data-asnavfor=".tab-slide" data-slide-show="3" data-fade="true">

                    </div>
                </div>

            <div class="widget widget_search   ">
                <form  action="#" method="POST" class="search-form">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('GET'); ?>
                    <input type="text"  id="search" name="keyword"  placeholder="Search..." autocomplete="off">
                    <input type="hidden" name="shop_id" value="<?php echo e($shop->id); ?>" id="search_shop">
                    <button type="submit"><i class="far fa-search"></i></button>
                </form>

                <div class="mycard row">
                </div>
            </div>
        </div>
        <div class="row gy-40 ">
            <div id="cat_name" class="col-12">
            </div>
        </div>
            <div class="row gy-40 " id="products">

            <?php $__currentLoopData = $shop->product; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="col-xl-3 col-lg-4 col-sm-6 col-6">
                <div class="th-menu">
                    <div class="">
                        <img  class="" src="<?php echo e(url('public/products/' .$product->image_temp)); ?>" alt="menu Image">
                        <?php if($product->sale !== null): ?>
                        <div class="th-menu_discount">
                            <span class="sale"><?php echo e($product->sale.'% OFF'); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="th-menu-content">
                        <h3 class="th-menu_title"><a href="<?php echo e(route('product.show', $product->id )); ?>"><?php echo e($product->name); ?></a></h3>
                        <span class="th-menu_price"><?php echo e($product->finalprice); ?> <?php echo e($shop->currency->name); ?></span>
                    </div>
                    <div class="actions pt-1">
                        <button data-product-id="<?php echo e($product->id); ?>" type="button" class="icon-btn add_cart"><i class="far fa-cart-plus"></i></button>
                    </div>
                    <div class="fire"><img src="<?php echo e(url('public/website/assets/img/update_2/shape/fire.png')); ?>" alt="shape"></div>
                </div>
            </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



        </div>

    </div>
</section>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

<script>

    $('.category').on('click', function() {


        // Remove the 'active' class from all category buttons
        $('.category').removeClass('active');

        // Add the 'active' class to the clicked category button
        $(this).addClass('active');


        var cat_id = this.value;
        var shop_id = $('#shopId').val();

        $.ajax({
            url: "<?php echo e(url('productByCategory')); ?>",
            type: "GET",
            data: {
                cat_id: cat_id,
                shop_id: shop_id,
                _token: '<?php echo e(csrf_token()); ?>'
            },
            dataType: 'json',
            success: function(result) {

                var category = result.category;
                $("#cat_name").html(`
                <div class="th-menu">
                    <h2>${category.name}</h2>
                    </div>
                    `);
                $("#products").html(productsHtml);


                var productsHtml = '';

                if (result.products.length === 0 ) {
                    productsHtml = `<div class="col-12">
                <div class="th-menu">
                    <h2>Coming Soon!</h2></div>
                    </div>`;

                }else{
                    $.each(result.products, function(key, value) {
                        var productDiv = `
                        <div class="col-xl-3 col-lg-4 col-sm-6 col-6">
                <div class="th-menu">
                    <div class="">
                        <img  class="" src="${value.image_src}" alt="${value.image_alt}">
                        <div class="th-menu_discount">
                            <span class="sale">${value.sale}% OFF</span>
                        </div>
                    </div>
                    <div class="th-menu-content">
                        <h3 class="th-menu_title"><a href="${value.product_link}"><?php echo e($product->name); ?></a></h3>
                        <span class="th-menu_price">${value.finalprice} ${value.currency}</span>
                    </div>
                    <div class="actions pt-1">
                        <button data-product-id="${value.id}" type="button" class="icon-btn add_cart"><i class="far fa-cart-plus"></i></button>
                    </div>
                    <div class="fire"><img src="<?php echo e(url('public/website/assets/img/update_2/shape/fire.png')); ?>" alt="shape"></div>
                </div>
            </div>
                             `;
                        productsHtml += productDiv;


                    });
                }



                $("#products").html(productsHtml);

            }
        });
    });

</script>

<script>
    var debounceTimer;

    $('#search').on('keyup', function () {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(search, 300);
    });
    search();


    function search() {

        var keyword = $('#search').val();
        var shop_id = $('#search_shop').val();
        if (keyword.trim() === '') {
            // Clear the table when the keyword is empty
            $('.mycard').html('');
            return;
        }



        $.post('<?php echo e(route("website.shop")); ?>',
            {

                _token: '<?php echo e(csrf_token()); ?>',
                keyword: keyword,
                shop_id: shop_id,

            },


            function (data) {

                table_post_row(data);
                console.log(data);

            });
    }

    const productShowRoute = "<?php echo e(route('product.show', ':productId')); ?>";
    const productcartRoute = "<?php echo e(route('add.to.cart', ':productId')); ?>";

    // table row with ajax
    function table_post_row(res) {
        let htmlView = '';

        if (res.products.length <= 0) {
            htmlView += `
      <div class="row gy-4 filter-active">
        <h5 class="product-detail col-12">No data.</h5>
      </div>`;
        } else {
            htmlView += `
<h3 class="mobile-heading col-12">Search Result</h3>`;

            for (let i = 0; i < res.products.length; i++) {
                const productLink = productShowRoute.replace(':productId', res.products[i].id);
                const productCart = productcartRoute.replace(':productId', res.products[i].id);


                htmlView += `
                <div class="col-xl-3 col-lg-4 col-sm-6 col-6">
                    <div class="th-menu">
                        <div class="">
                            <img class="" src="<?php echo e(url('public/products/${res.products[i].image_temp}')); ?>" alt="menu Image">
                            <div class="th-menu_discount">
                                <span class="sale">${res.products[i].sale}% OFF</span>
                            </div>
                        </div>
                        <div class="th-menu-content">
                            <h3 class="th-menu_title"><a href="${productLink}">${res.products[i].name}</a></h3>
                            <span class="th-menu_price">${res.products[i].finalprice}<?php echo e($shop->currency->name); ?></span>
                        </div>
                        <div class="actions pt-1">
                        <button data-product-id="${res.products[i].id}" type="button" class="icon-btn add_cart"><i class="far fa-cart-plus"></i></button>
                    </div>
                        <div class="fire"><img src="<?php echo e(url('public/website/assets/img/update_2/shape/fire.png')); ?>" alt="shape"></div>
                    </div>
                </div>

`;
            }

        }

        $('.mycard').html(htmlView);

    }

</script>
<script>
    // Update the existing script to handle the "Add to Cart" button click
$(document).ready(function () {

    deleteOrder();

$(document).on("click", ".add_cart", function (e) {
e.preventDefault();

var productId = $(this).data('product-id');


$.ajax({
    url: '/Menu/add-to-cart/' + productId,
    method: 'GET',
    dataType: 'json',
    success: function (response) {
        alert(response.success); // or display a success message in your UI

		$("#noticart").html("");



			   if (response.cartLength > 0) {
    for (const key in response.cart) {
        const order = response.cart[key];
		const productId = key;
        $("#noticart").append(`
            <li class="woocommerce-mini-cart-item mini_cart_item">
                <a href="#" type="button"  data-id="${productId}" class="remove remove_from_cart_button remove-from-cart mego"><i class="far fa-times"></i></a>
                <a href="/Menu/product/${productId}"><img src="<?php echo e(url('/public/products')); ?>/${order.image}" alt="Cart Image">${order.name}</a>
                <span class="quantity">${order.quantity} ×
                    <span class="woocommerce-Price-amount amount">
                        <span class="woocommerce-Price-currencySymbol">${order.price}</span> <?php echo e($shop->currency->name); ?></span>
                </span>
            </li>
        `);
    }
    $("#orderCount").text(response.cartLength);

}



        // Fetch and update the subtotal
        deleteOrder();
        updateSubtotal();
    },
    error: function (error) {
        alert(error.responseJSON.error); // or display an error message in your UI
    }
});
});





function deleteOrder() {
    $(".remove-from-cart").click(function (ev) {
        ev.preventDefault();
        var ele = $(this);
        console.log(ele.attr("data-id"));
        if (confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '<?php echo e(route('remove.from.cart')); ?>',
                method: "DELETE",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    id: ele.attr("data-id")
                },
                success: function (response) {

                    $("#noticart").html("");
                    $("#orderCount").text(0);


                    const notificationCount = response.cartLength;

                    if (response.cartLength > 0) {
                        for (const key in response.cart) {
                            const order = response.cart[key];
                            const productId = key;
                            $("#noticart").append(`
                                <li class="woocommerce-mini-cart-item mini_cart_item">
                                    <a data-id="${productId}" href="#" type="button" class="remove remove_from_cart_button remove-from-cart"><i class="far fa-times"></i></a>
                                    <a href="/Menu/product/${productId}"><img src="<?php echo e(url('/public/products')); ?>/${order.image}" alt="Cart Image">${order.name}</a>
                                    <span class="quantity">${order.quantity} ×
                                        <span class="woocommerce-Price-amount amount">
                                            <span class="woocommerce-Price-currencySymbol">${order.price}</span> <?php echo e($shop->currency->name); ?></span>
                                    </span>
                                </li>
                            `);
                        }
                        $("#orderCount").text(response.cartLength);
                    }

                    // Fetch and update the subtotal
                    updateSubtotal();
                    deleteOrder();


                }
            });
        }
    });
}

// Function to update the subtotal dynamically
function updateSubtotal() {
$.ajax({
    url: '<?php echo e(route('cart.get-subtotal')); ?>', // Replace with the actual route to fetch the subtotal
    method: 'GET',
    dataType: 'json',
    success: function (response) {
        $('#subtotal').text( response.subtotal + ' <?php echo e($shop->currency->name); ?>');
    },
    error: function (error) {
        console.error('Error fetching subtotal:', error);
    }
});
}
});


</script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.includes.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/jcwbgkteayia/public_html/Menu/resources/views/website/shop.blade.php ENDPATH**/ ?>