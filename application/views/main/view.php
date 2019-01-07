<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Products</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php
        $id = $_GET['id'];
        $products = new \Application\models\Product();
        $res_products = $products->get_product_by_id($id);
        $res_products->execute(array($id));
        $small_images = new \Application\models\SmallImages();
        $res_small_images = $small_images->get_small_image_by_product_id($id);
        $res_small_images->execute(array($id));
        ?>
        <div id="view_modal_images"  class="modal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body modal-with-main-image" style=" display: flex;justify-content: space-between;">
                        <div class="pro-view-modal-small-images" style=""></div>
                        <div id="product-view-modal-img" style="width:75%;">
                            <img src=""  class="img-responsive"  width="80%" height="80%">
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        <div id="add_new_review"  class="modal">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <?php $user = new \Application\models\Users();?>
                        <form method="post" class="feedback">
                            <div class="form-group">
                                <div style="border:1px solid #f3d6d6; padding: 5px;margin:25px 22px; " class="col-sm-11">
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" id="name"  class="form-control" placeholder="your name" />
                                </div>
                                <div style="border:1px solid #f3d6d6; padding: 5px;margin:25px 22px; " class="col-sm-11">
                                    <label for="review">Your review:</label>
                                    <textarea type="text" name="review" id="review" style="height:100px;" class="form-control" placeholder="your review" ></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" name="add_new_review_submit" id="add_new_review_submit" product_id="<?= $_GET['id'];?>" class="btn btn-info" data-dismiss="modal" >Добавить отзыв</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php foreach ($res_products as $res_product){?>
                <div class="column-view-main">
                    <h2 id="title-products-view"><?= $res_product['name'];?></h2>
                    <div id="left-block-product-view">
                        <div id="pro-view-main-image">
                            <img  src="/application/photo/<?= $res_product['department_id'];?>/<?= $res_product['photo'];?>" small_img_name="" image_id="<?= $res_product['photo'];?>" alt="<?= $res_product['name'];?>" align=left  width=480px height=480px>
                        </div>
                        <div id="left-block-prod-view-make-bigger">
                             <span class="glyphicon glyphicon-zoom-in" name_product="<?= $res_product['name'];?>" department_id="<?= $res_product['department_id'];?>"></span>
                        </div>
                    </div>
                    <div id="right-block-product-view">
                        <div class="right-block-product-view-div">
                            <ul id="right-block-list-all-product-view">
                                <li class="view-right-first-block">
                                    <?php if($res_product['discount'] == 1){?>
                                        <div class="sale-count-view-main"><span><?= '-'.$res_product['value_discount'].'%'; ?></span></div>
                                    <?php }?>
                                    <?php if($res_product['quantity'] > 0){?>
                                        <div class="view-in-stock">
                                            <div class="glyphicon glyphicon-ok "></div>
                                            <div >Есть в наличии</div>
                                        </div>
                                    <?php }?>
                                </li>
                                    <?php
                                    if($res_product['discount'] == 1){
                                        $old_price = $res_product['price'];
                                        $discount = ($res_product['price']*$res_product['value_discount'])/100;
                                        $new_price = $res_product['price'] - $discount;
                                        $new_price = round($new_price,3);
                                    }else{
                                        $new_price = $res_product['price'];
                                    }?>
                                <li class="view-right-second-block">
                                    <form id="right-block-products-view-quantity-select-form">
                                        <div class="form-group row">
                                            <div class="col-xs-6">
                                                <label for="quantity">Количетсво</label>
                                                <input class="form-control" id="quantity" type="number" min="1" value="1">
                                            </div>
                                        </div>
                                    </form>
                                    <h1 class="price_products-view"><?= round($new_price,3).' грн';?></h1>
                                </li>
                                <li class="view-right-fourth-block">
                                    <div class="my-rating-view" iid="<?= $res_product['productId'];?>"></div>
                                    <?php

                                    $sum_for_this_product = new \Application\models\Rating();
                                    $res_sum_for_this_products = $sum_for_this_product->get_sum_rating($res_product['productId']);
                                    $res_sum_for_this_products->execute(array($res_product['productId']));
                                    foreach($res_sum_for_this_products as $res_sum_for_this_product){
                                    }
                                    $sum_rate = $res_sum_for_this_product['total'];

                                    $avg_for_this_product = new \Application\models\Rating();
                                    $res_avg_for_this_products = $avg_for_this_product->get_total_rating($res_product['productId']);
                                    $res_avg_for_this_products->execute(array($res_product['productId']));
                                    foreach($res_avg_for_this_products as $res_avg_for_this_product){
                                    }
                                    $avg_rate = $res_avg_for_this_product['total'];?>
                                    <div class="view-avg-rate"><span class="view-avg-rate-span" sum_all_rate="<?= $sum_rate;?>"><?= round($avg_rate,2);?></span> %</div>
                                    <?php
                                    $all_ratings_for_this_product = new \Application\models\Rating();
                                    $res_all_rating_for_this_products = $all_ratings_for_this_product->get_total_users_rated($res_product['productId']);
                                    $res_all_rating_for_this_products->execute(array($res_product['productId']));
                                    foreach($res_all_rating_for_this_products as $res_all_rating_for_this_product){
                                    }
                                    $total_rate = $res_all_rating_for_this_product['total'];
                                    ?>
                                    <div>Всего проголосовало: <span class="view-total-rated"><?php printf('%d', $total_rate);?></span></div>
                                    <script>
                                        $.getJSON("https://api.ipify.org/?format=json", function(e) {
                                            var ip_address =  e.ip;
                                            $(".my-rating-view").attr('ip_address',ip_address);
                                        });
                                        $(".my-rating-view").starRating({
                                            starSize: 25,
                                            callback: function(currentRating, $el){
                                                var iid = $(".my-rating-view").attr('iid');
                                                var ip_address = $('.my-rating-view').attr('ip_address');
                                                $.ajax({
                                                    url: "/main/InsertRating",
                                                    method: "POST",
                                                    data: "product_id=" + iid+"&rate="+currentRating+"&ip_address="+ip_address,
                                                    success: function (data) {
                                                         var total_rated = $('.view-total-rated').text();
                                                         var res_total_rated =1;
                                                         res_total_rated += Number(total_rated);
                                                         $('.view-total-rated').text(res_total_rated);
                                                         var sum_all_rate = $('.view-avg-rate-span').attr('sum_all_rate');
                                                         sum_all_rate = Number(sum_all_rate);
                                                         sum_all_rate += Number(currentRating);
                                                         var res_avg = sum_all_rate/res_total_rated;
                                                         $('.view-avg-rate-span').text(res_avg);
                                                    }
                                                });

                                                // make a server call here
                                            }
                                        });
                                        load_business_data();
                                        function load_business_data() {
                                            var product_id_for_rating = $(".my-rating-view").attr('iid');
                                            $(this).attr('id',product_id_for_rating);
                                            $.ajax({
                                                url: "/main/Fetch",
                                                method: "POST",
                                                data: "product_id=" + product_id_for_rating,
                                                success: function (data) {
                                                    $(".my-rating-view").starRating('setRating', data);
                                                }
                                            });
                                        }
                                        // alert($(".my-rating").starRating('getRating'));
                                    </script>
                                </li>
                                <li class="view-right-third-block">
                                    <p id="right-block-product-view-big-description"><?= $res_product['big_description'];?></p>
                                    <button type="button" id="right-block-product-view-button-to-buy" real_price="<?= $res_product['price'];?>" price="<?= $new_price;?>" iid="<?= $res_product['productId'];?>" ip_address="<?= $_GET['ip_address'];?>" class="btn btn-danger btn-lg">Купить</button>
                                    <div id="view-product-articul">Арт.:<?= $res_product['productId']?></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php }?>
<!--            </div>-->
            <div id="left-block-small-images">
                <?php foreach($res_small_images as $res_small_image){?>
                    <img src="/application/photo/small_images/<?= $res_small_image['department_id'];?>/<?= $res_small_image['name'];?>"  class="img-responsive product-view-img-small" department_id="<?= $res_small_image['department_id']?>" name="<?= $res_small_image['name']?>"  width="110" height="110">
                <?php }?>
            </div>

            <div id="product-view-tabs">
                <ul class="nav nav-pills">
                    <li class="active"><a data-toggle="pill" href="#home">Описание</a></li>
                    <li class="nav-tab-no-active"><a data-toggle="pill" href="#adding_info_div">Дополнительная информация</a></li>
                </ul>
                <?php
                $products_description = new \Application\models\Product();
                $res_products_description = $products_description->get_product_by_id($id);
                $res_products_description->execute(array($id));
                foreach ($res_products_description as $res_product_description){?>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">

                        <h4>Описание: <?= $res_product_description['name'];?></h4>
                        <p ><?= $res_product_description['big_description']?></p>
                    </div>
                    <div id="adding_info_div" class="tab-pane fade">
                        <h4>Характеристики: <?= $res_product_description['name'];?></h4>
                        <p><?= $res_product_description['adding_info']?></p>
                    </div>
                </div>
                <?php  }?>
            </div>
            <div id="reviews">
                <h4>Отзывы</h4>
                <!-- ADDING TOCART SUCCESS-->
                <div class="alert alert-success adding_review alert-dismissable" style="display: none;width:450px;margin-left:100px;margin-top:-90px;height:200px;" id="flash-msg-adding-review">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4><i class="icon fa fa-check"></i>Success!</h4><p>The review will append after to be approved!</p>
                </div>
                <div class="review-view-main-information">
                    <p class="review-view-main-information-information">The review will append after to be approved!</p>
                </div>
                <style>
                    .review-view-main-information{
                        display:none;
                        margin-left:240px;
                        margin-top:-60px;
                        font-size:14px;
                        font-weight:bold;
                        border:1px solid #ddd;
                        padding:10px;
                        width:340px;
                    }
                    .review-view-main-information-success{
                        color:green;
                    }
                    .review-view-main-information-information{
                        color:#b1b1b7;

                    }
                </style>
                <ul>
                    <li>
                        <div class="glyphicon glyphicon-chevron-right"></div>
                    </li>
                    <li><p id="add_reviews_link">Добавить отзыв</p></li></ul>
                <button type="button" class="btn btn-danger leave_the_comment">Написать отзыв</button>
            </div>
            <?php
            $ip_address = $_GET['ip_address'];
            $viewed_products = new \Application\models\ViewedProduct();
            $res_viewed_products = $viewed_products->get_viewed_products_by_user($ip_address);
            $res_viewed_products->execute(array($ip_address));
            ?>
            <div id="watched_product_div">
                <h4 id="watched_product_div_h4">Просмотренные товары</h4>
                <section class="customer-logos slider">
                    <?php foreach($res_viewed_products as $res_viewed_product){?>
                        <div class="slide"><a href="/main/view/?id=<?= $res_viewed_product['id'];?>&ip_address=<?= $_GET['ip_address'];?>"><img  src="/application/photo/<?= $res_viewed_product['department_id'];?>/<?= $res_viewed_product['photo'];?>" ><p><?= $res_viewed_product['name'];?></p>
                            <h4 class="viewed_product_image_price"><?= $res_viewed_product['price'].' грн';?></h4></a></div>
                    <?php }?>
                </section>
            </div>
            </div>
        </div>
    </body>
</html>
<script>
    $('#quantity').change(function(){
        var quantity = $(this).val();
        $('#right-block-product-view-button-to-buy').attr('quantity',quantity);
        var price = $('#right-block-product-view-button-to-buy').attr('price');
        var final_price = price*quantity;
        var final_price = parseFloat(final_price);
        var final_price = final_price.toFixed(2);
        $('#right-block-product-view-button-to-buy').attr('final_price',final_price);
        $('.price_products-view').html(final_price+" грн");
    });
</script>
<script>
    $('#right-block-product-view-button-to-buy').click(function(){
        var ip_address = $(this).attr('ip_address');
        var quantity = $('#quantity').val();
        var iid = $(this).attr('iid');
        var new_price = $(this).attr('final_price');
        var real_price = $(this).attr('real_price');
        $.ajax({
            type: "POST",
            url: "/main/AddToCart",
            data: "iid=" + iid + "&res_ip_address=" + ip_address+"&quantity="+quantity+"&price="+new_price+"&real_price="+real_price,
            success: function (res) {
                $(location).attr("href", '/main/cart/?ip_address='+ip_address+"&action=oneclick");
            },
            error: function () {
            }
        });
    });
</script>
<script>
    $('.leave_the_comment').click(function(){
        $('#add_new_review').modal("show");
        $.getJSON("https://api.ipify.org/?format=json", function(e) {
            var ip_address =  e.ip;
            $("#add_new_review_submit").each(function() {
                $(this).attr('ip_address',ip_address);
            });
        });
        $('#add_new_review_submit').click(function(){
            var name = $('#name').val();
            var review = $('#review').val();
            var ip_address = $(this).attr('ip_address');
            var product_id = $(this).attr('product_id');
            $.ajax({
                type: "POST",
                url: "/main/AddNewReview",
                data: "name=" + name + "&review=" + review+"&ip_address="+ip_address+"&product_id="+product_id,
                success: function (res) {
                    if($.trim(res) == 1) {
                        $('.review-view-main-information').css('display','block');
                        setTimeout(function () {
                            $('.review-view-main-information').fadeOut(2000);
                            location.reload();
                        }, 2000);
                    }
                },
                error: function () {
                    alert("Error");
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#left-block-prod-view-make-bigger span').click( function(){
            var main_photo = $("#pro-view-main-image").find('img').attr('src');
            var image_id = $("#pro-view-main-image").find('img').attr('image_id');
            var department_id = $(this).attr('department_id');
            var name_product = $(this).attr('name_product');
            $.ajax({
                type: "POST",
                url: "/main/GetImage",
                data: "image_id=" + image_id,
                dataType: "json",
                success: function (res) {
                    var images = JSON.stringify(res);
                    var obj = JSON.parse(images);
                    $.each(obj, function(iy, ely) {
                        var name = ely['name'];
                        var id = ely['id'];
                        $('#view_modal_images').modal("show");
                        $(".pro-view-modal-small-images").each(function() {
                            $('#product-view-modal-img').find('img').attr('src',main_photo);
                            $('.pro-view-modal-small-images').append($('<ul><li>')
                                .prepend($('<img>',{id:'dd',src:'/application/photo/small_images/'+department_id+'/' + name, width:'70px',height:'70px'})
                                .addClass('pro-view-modal-small_images_img')
                                )
                            );
                        });
                        $('.pro-view-modal-small_images_img').hover(function(){
                            $(this).css('width', '72px');
                            $(this).css('height', '72px');
                            var src = $(this).attr('src');
                            $("#product-view-modal-img").find('img').attr('src', src);
                        }, function() {
                            $("#product-view-modal-img").find('img').attr('src', src);
                            $(this).css('width', '70px');
                            $(this).css('height', '70px');
                        });
                    });
                },
                error: function () {
                    alert("Error");
                }
            });
        });
        $('.product-view-img-small').hover(function(){
            $(this).css('width', '112px');
            $(this).css('height', '112px');
            $(this).css('border','1px solid rosybrown');
            var name = $.trim($(this).attr('name'));
            var department_id = $(this).attr('department_id');
            $("#pro-view-main-image").find('img').attr('src', '/application/photo/small_images/'+department_id+'/'+name);
        }, function() {
            var name = $.trim($(this).attr('name'));
            var department_id = $(this).attr('department_id');
            var image_id = $("#pro-view-main-image").find('img').attr('image_id');
            // alert(image_id);
            $("#pro-view-main-image").find('img').attr('src', '/application/photo/'+department_id+'/'+image_id);
            $(this).css('width', '110px');
            $(this).css('height', '110px');
            $(this).css('border','1px solid white');
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('.customer-logos').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1500,
            arrows: false,
            dots: false,
            pauseOnHover: false,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 4
                }
            }, {
                breakpoint: 520,
                settings: {
                    slidesToShow: 3
                }
            }]
        });
    });
</script>
