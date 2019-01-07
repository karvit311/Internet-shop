<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Products</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
        <script src="https://code.jquery.com/jquery-1.12.2.min.js" integrity="sha256-lZFHibXzMHo3GGeehn1hudTAP3Sc0uKXBXAzHX1sjtk=" crossorigin="anonymous"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>-->
<!--        <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>-->
        <!--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
<!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/application/css/css.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<!--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />-->
<!--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" />-->
<!--        <script src="/application/js/jcarousellite_1.1.js"></script>-->
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
                        <?php $user = new \Application\models\Users();

                        //if(){?>
<!--                        <form id="review_form" method="post" class="feedback" >-->
<!--                            <div class="input-group">-->
<!--                                <div class="input-group-prepend">-->
<!--                                    <span class="input-group-text">Name</span>-->
<!--                                </div>-->
<!--                                <input class="form-control" id="name_modal_review" style="width:550px;" aria-label="Write your name"></input>-->
<!--                            </div>-->
<!--                            <div class="input-group">-->
<!--                                <div class="input-group-prepend">-->
<!--                                    <span class="input-group-text">Your review</span>-->
<!--                                </div>-->
<!--                                <textarea class="form-control" id="text_modal_review" style="width:550px;height:200px;" aria-label="Write your comment"></textarea>-->
<!--                            </div>-->
<!--                        </form>-->
                        <form method="post" class="feedback" >
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
                        <button type="submit" name="add_new_review_submit" id="add_new_review_submit" class="btn btn-info" data-dismiss="modal" >Добавить отзыв</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">

                <?php foreach ($res_products as $res_product){?>
                <div class="column" >

                    <h2 id="title-products-view"><?= $res_product['name'];?></h2>
                    <div id="left-block-product-view">
                        <div id="pro-view-main-image">
                            <img  src="/application/photo/phone/<?= $res_product['photo'];?>" small_img_name="" image_id="<?= $res_product['id'];?>" alt="<?= $res_product['name'];?>" align=left  width=480px height=480px>
                        </div>
                        <div id="left-block-prod-view-make-bigger">
                             <span class="glyphicon glyphicon-zoom-in" name_product="<?= $res_product['name'];?>"></span>
                        </div>
                    </div>
                    <div id="right-block-product-view">
                        <div style="margin-bottom:30px;">
                            <ul id="right-block-list-all-product-view" style="font-size:12px;margin-top:40px;font-family:'Comic Sans MS', cursive, sans-serif ;" >
                                <li>
                                    <h1 class="price_products"><?= $res_product['price'].' грн';?></h1>
                                </li>
                                <?php if($res_product['quantity'] > 0){?>
                                <li id="right-block-products-view-quantity">
                                    <div class="glyphicon glyphicon-ok"></div>
                                    <div id="right-block-products-view-quantity-text">Есть в наличии</div>
                                </li>
                                <?php }?>
                                <li>
                                    <p id="right-block-product-view-big-description"><?= $res_product['big_description'];?></p>
                                </li>
                            </ul>
                            <ul id="right-block-products_view-ul-to-buy">
                                <li>
                                    <form id="right-block-products-view-quantity-select-form">
                                        <div class="form-group row">
                                            <div class="col-xs-6">
                                                <label for="quantity">Количетсво</label>
                                                <input class="form-control " id="quantity" type="number" min="1" value="1">
                                            </div>
                                        </div>
                                    </form>
                                </li>
                                <li>
                                    <button type="button" id="right-block-product-view-button-to-buy" class="btn btn-danger btn-lg">Купить</button>
                                </li>
                            </ul>
                            <div id="view-product-articul">Арт.:<?= $res_product['id']?></div>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
            <div id="left-block-small-images">
                <?php foreach($res_small_images as $res_small_image){?>
                    <img src="/application/photo/phone/small_images/<?= $res_small_image['name'];?>"  class="img-responsive product-view-img-small" name="<?= $res_small_image['name']?>"  width="110" height="110">
                <?php }?>
            </div>
            <div id="product-view-tabs">
                <ul class="nav nav-pills">
                    <li class="active"><a data-toggle="pill" href="#home">Описание</a></li>
                    <li><a data-toggle="pill" href="#adding_info_div">Дополнительная информация</a></li>
                </ul>
                <?php // foreach ($res_products as $res_product){?>
                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">

                        <h4>Описание: <?= $res_product['name'];?></h4>
                        <p ><?= $res_product['big_description']?></p>
                    </div>
                    <div id="adding_info_div" class="tab-pane fade">
                        <h4>Характеристики: <?= $res_product['name'];?></h4>
                        <p><?= $res_product['adding_info']?></p>
                    </div>
                </div>
                <?php // }?>
            </div>
            <div id="reviews">
                <h4>Отзывы</h4>
                <ul>
                    <li>
                        <div class="glyphicon glyphicon-chevron-right"></div>
                    </li>
                    <li><p id="add_reviews_link">Добавить отзыв</p></li></ul>
                <button type="button" class="btn btn-danger leave_the_comment">Написать отзыв</button>
            </div>
            <?php
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $viewed_products = new \Application\models\ViewedProduct();
            $res_viewed_products = $viewed_products->get_viewed_products_by_user($ip_address);
            $res_viewed_products->execute(array($ip_address));
            ?>
            <div id="watched_product_div">
                <h4 id="watched_product_div_h4">Просмотренные товары</h4>
                <section class="customer-logos slider">
                    <?php foreach($res_viewed_products as $res_viewed_product){?>
                        <div class="slide"><a href="/main/view/?id=<?= $res_viewed_product['id'];?>"><img src="/application/photo/phone/<?= $res_viewed_product['photo'];?>" ><p><?= $res_viewed_product['name'];?></p>
                            <h4 class="viewed_product_image_price"><?= $res_viewed_product['price'].' грн';?></h4></a></div>
                    <?php }?>
                </section>
            </div>
        </div>

    </body>
</html>
<script>
    $('.leave_the_comment').click(function(){
        $('#add_new_review').modal("show");
        $('#add_new_review_submit').click(function(){
            var name = $('#name').val();
            alert(name);
            $.ajax({
                type: "POST",
                url: "/main/AddNewReview",
                data: "name=" + name + "&review=" + review,
                dataType: "json",
                success: function (res) {
                    alert(res);
                    // var workers = JSON.stringify(res);
                    // var obj = JSON.parse(workers);
                    // $.each(obj, function(iy, ely) {
                    //     var address = ely['address'];
                    //     var date = ely['date'];
                    //     var time = ely['time'];
                    //     var supplier_id = ely['supplier_id'];
                    //     var supplier = ely['supplier'];
                    //     var info = ely['info'];
                    //     var department = ely['department'];
                    //     console.log(department);
                    //     $(".modal_delivery_date_address").html(address);
                    //     $(".modal_delivery_date_time").html(time);
                    //     $(".modal_delivery_date_date").html(date);
                    //     $(".modal_delivery_date_supplier").html(supplier);
                    //     $(".modal_delivery_date_contacts_of_supplier").html(info);
                    //     $(".modal_delivery_date_department").html(department);
                    // });
                },
                error: function () {
                    alert("Error");
                }
            });
        });
    });
</script>
<style>
    #watched_product_div_h4{
        font-weight:bold;
        margin-top:30px;
        margin-left:30px;
    }
    .viewed_product_image_price{
        margin-left:75px;
        position:absolute;
        bottom:10px;
        font-weight:bold;
    }
    .customer-logos .slide a{
        color:black;
    }
    .customer-logos .slide{
        padding:10px;
        height:340px;
        position:relative;
    }
    .customer-logos .slide:hover {
        border:1px solid #ddd;
    }
    .slide img{
        margin-bottom:20px;

    }
    .customer-logos{
        margin-top:30px;
    }
    #watched_product_div{
        height:440px;
        width:100%;
        border:1px solid #ddd;
        margin-bottom:30px;
        float:left;
    }
    .nav-pills>li>a{
        color:white;
    }
    .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li{
        background:#bdb8b8;
    }
    .nav-pills>li>a:focus, .nav-pills>li:active,.nav-pills>li>a:hover{
        background:#8a8383;
    }
    .nav-pills>li.active>a, .nav-pills>li.active>a:focus, .nav-pills>li.active>a:hover{
        background:#c77f7f;
    }
    .nav-pills>li.active>a, .nav-pills>li.active>a, .nav-pills>li.active>a{
        background:rosybrown;
    }
    #title-products-view{
        margin-left:225px;
        margin-bottom:20px;
    }
    body{
        font-family:'Comic Sans MS', cursive, sans-serif;
    }
    #add_reviews_link{
        text-decoration:underline;
    }
    #add_reviews_link a{
        color:#2c2f31;
        font-size:11px;
    }
    .glyphicon-chevron-right{
        margin-left:-10px;
        margin-right:5px;
        font-size:11px;
    }
    #reviews{
        font-family:'Comic Sans MS', cursive, sans-serif;
        float:left;
        height:155px;
        width:100%;
        border: 1px solid #ddd;
        margin-bottom:50px;
    }
    #reviews h4{
        font-weight:bold;
        margin-left:30px;
        margin-bottom:30px;
        margin-top:30px;
    }
    #reviews ul li{
        list-style:none;
        float:left;
    }
    #reviews ul{
        /*margin-left:30px;*/
    }
    #reviews button{
        margin-right:30px;
        float:right;
        margin-top:-50px;
        height:40px;
        width:155px;
    }
    #home h4{
        font-weight:bold;
    }
    #adding_info_div h4{
        font-weight:bold;
    }
    #adding_info_div table tbody td{
        padding:20px;
        padding-right: 200px;
    }
    .tab-content {
        border-top: 1px solid #ddd;
        border-left: 1px solid #ddd;
        border-right: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        padding: 10px;
        width:1135px;
    }
    #adding_info_div {
        width:60%;
    }
    .tab-content h4{
        margin-top:20px;
        margin-left:20px;
    }
    .tab-content p{
        margin-left:20px;
    }
    .tab-content p{
        margin-top:30px;
        margin-bottom:20px;
    }
    .nav-tabs {
        margin-bottom: 0;
    }
    #product-view-tabs{
        float:left;
        margin-top:50px;
        margin-bottom:50px;
        margin-right:600px;
    }
</style>
<script>
    $(document).ready(function() {
        $('#left-block-prod-view-make-bigger span').click( function(){
            var main_photo = $("#pro-view-main-image").find('img').attr('src');
            var image_id = $("#pro-view-main-image").find('img').attr('image_id');
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
                                .prepend($('<img>',{id:'dd',src:'/application/photo/phone/small_images/' + name, width:'70px',height:'70px'})
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
            $("#pro-view-main-image").find('img').attr('src', '/application/photo/phone/small_images/'+name);
        }, function() {
            var image_id = $("#pro-view-main-image").find('img').attr('image_id');
            $("#pro-view-main-image").find('img').attr('src', '/application/photo/phone/'+image_id+'.jpg');
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
<style>
    #pro-view-main-image{
        margin-top:15px;
    }
    #right-block-product-view{
        position:relative;
    }
    #view-product-articul{
        position:absolute;
        bottom:20px;
        left:20px;
    }
    #product-view-modal-img{
        margin-right:20px;
    }
    .pro-view-modal-small_images_img{
        border:1px solid rosybrown;
    }
    .pro-view-modal-small-images >ul>li{
        list-style:none;
    }
    #left-block-small-images {
        float:left;
        width:100%;
    }
    #left-block-small-images >img{
        float:left;
        margin-top:10px;
        margin-left:7px;
    }
    #left-block-prod-view-make-bigger{
        float:right;
        margin-right:30px;
        font-weight:bold;
        font-size:25px;
        color:black;
    }
    #left-block-prod-view-make-bigger a:hover{
        color:#5f6469;
    }
    #left-block-prod-view-make-bigger a{
        color:black;
    }
    #right-block-product-view-button-to-buy{
        margin-top:15px;
        width: 170px;
    }
    #right-block-products_view-ul-to-buy >li{
        margin-top:100px;
        float:left;
    }
    #right-block-products-view-quantity-select-form{
        margin-left:10px;
        margin-right:20px;
    }
    #right-block-list-all-product-view li{
        float:left;
        height:105px;
    }
    #right-block-products-view-quantity-text{
        margin-top:-18px;
        margin-left:25px;
        font-size:12px;
    }
    #title-products-view{
        font-weight:bold;
        font-family:'Comic Sans MS', cursive, sans-serif;
    }
    #right-block-products-view-quantity{
        margin-left:70px;
        margin-top:53px;
        width:200px;
    }
    #right-block-products-view-quantity-ul >div
    {
        margin:5px;
        float:left;
    }
    .glyphicon-ok{
        color:#28ad28;
        font-weight:bold;
        font-size:15px;
    }
    #right-block-product-view-big-description{
        font-size:14px;
    }
    #left-block-product-view{
        float:left;
        width:45%;
        height:100%;
        border:1px solid #f3d6d6;
    }
    #left-block-product-view >img{
        float:left;
        margin-left:20px;
        width:95%;
        height:90%;
    }
    #right-block-product-view{
        float:left;
        width:45%;
        height:100%;
        border:1px solid #f3d6d6;
    }
    .price_products{
        /*float:left;*/
        font-weight:bold;
        font-family:'Comic Sans MS', cursive, sans-serif;
        margin-top:40px;
        /*margin-left:10px;*/
        /*padding:10px;*/
        /*border:1px solid #e8dede;*/
        /*background: #f7f1f5;*/
    }
    .button-price{
        margin-top:70px;
    }
    * {
        box-sizing: border-box;
    }
    .button-price{
        /*display:none;*/
        width:55%;
        height:15%;
    }
    .column :hover{
        cursor:pointer;
    }
    .column {
        /*float: left;*/
        width: 98%;
        height:590px;
        padding: 10px;

        margin:5px;

    }
    .column ul {
        list-style:none;
    }
    .column img{
        /*margin-left:-5px;*/
        /*margin-top:-10px;*/
        /*max-width:50%;*/
    }
    /* Clearfix (clear floats) */
    .row::after {
        content: "";
        clear: both;
        display: table;
    }
</style>
<style>
    .slick-slide {
        margin: 0px 20px;
    }

    .slick-slide img {
        width: 100%;
    }

    .slick-slider
    {
        position: relative;
        display: block;
        box-sizing: border-box;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-touch-callout: none;
        -khtml-user-select: none;
        -ms-touch-action: pan-y;
        touch-action: pan-y;
        -webkit-tap-highlight-color: transparent;
    }

    .slick-list
    {
        position: relative;
        display: block;
        overflow: hidden;
        margin: 0;
        padding: 0;
    }
    .slick-list:focus
    {
        outline: none;
    }
    .slick-list.dragging
    {
        cursor: pointer;
        cursor: hand;
    }

    .slick-slider .slick-track,
    .slick-slider .slick-list
    {
        -webkit-transform: translate3d(0, 0, 0);
        -moz-transform: translate3d(0, 0, 0);
        -ms-transform: translate3d(0, 0, 0);
        -o-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }

    .slick-track
    {
        position: relative;
        top: 0;
        left: 0;
        display: block;
    }
    .slick-track:before,
    .slick-track:after
    {
        display: table;
        content: '';
    }
    .slick-track:after
    {
        clear: both;
    }
    .slick-loading .slick-track
    {
        visibility: hidden;
    }

    .slick-slide
    {
        display: none;
        float: left;
        height: 100%;
        min-height: 1px;
    }
    [dir='rtl'] .slick-slide
    {
        float: right;
    }
    .slick-slide img
    {
        display: block;
    }
    .slick-slide.slick-loading img
    {
        display: none;
    }
    .slick-slide.dragging img
    {
        pointer-events: none;
    }
    .slick-initialized .slick-slide
    {
        display: block;
    }
    .slick-loading .slick-slide
    {
        visibility: hidden;
    }
    .slick-vertical .slick-slide
    {
        display: block;
        height: auto;
        border: 1px solid transparent;
    }
    .slick-arrow.slick-hidden {
        display: none;
    }
</style>