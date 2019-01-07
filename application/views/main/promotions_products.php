<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Products</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php
        $promotion_id = $_GET['promotion_id'];
        $products_pagination = new \Application\models\Product();
        $res_products_pagination = $products_pagination->get_total_by_product_promotion($promotion_id);
        $res_products_pagination->execute(array($promotion_id));
        foreach($res_products_pagination as $res_product_pagination) {
        $total = $res_product_pagination['total'];
        $adjacents = 3;
        $page = $_GET['page'];
        $targetpage = "/main/promotionsProducts/?promotion_id=".$promotion_id."&"; //your file name
        $limit = 8; //how many items to show per page
        if (isset($_GET['page'])) {
        $start = ($page - 1) * $limit; //first item to display on this page
        } else {
        $start = 0;
        }
        /* Setup page vars for display. */
        if ($page == 0) $page = 1; //if no page var is given, default to 1.
        $prev = $page - 1; //previous page is current page - 1
        $next = $page + 1; //next page is current page + 1
        $lastpage = ceil($total / $limit); //lastpage.
        $lpm1 = $lastpage - 1; //last page minus 1
        $products = new \Application\models\Product();
        $res_products = $products->get_products_and_promotions($promotion_id,$limit,$start);
        $res_products->execute();
        include("pagination.php"); ?>
        <div class="container">
            <div class="row">
                <div id="breadcrumbs-products">
                    <ul>
                        <li><a class="btn btn-default come_back" href="/main/menu" role="button"><span class="glyphicon glyphicon-arrow-left"></span>  Вернуться</a></li>
                        <li><a class="btn btn-light" href="/main/about" role="button">AllPAN</a></li>
                    </ul>
                </div>
                <!-- DELETING SUCCESS-->
                <div class="alert alert-success deleting_product alert-dismissable" style="display: none;" id="flash-msg-deleting-product">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4><i class="icon fa fa-check"></i>Success!</h4><p>Product've  successfully deleted!</p>
                </div>
                <div class="essense_of_promotion">
                    <?php
                    $products_prom = new \Application\models\Product();
                    $res_products_promotion = $products_prom->get_products_and_promotions($promotion_id,$limit,$start);
                    $res_products_promotion->execute();
                    foreach ($res_products_promotion as $res_essense_of_promotion){}
                    $date = date_create($res_essense_of_promotion['end_date']);
                    $end_date =  date_format($date,'d F');?>
                    <h4 ><?= $res_essense_of_promotion['title'];?></h4>
                    <p><?= $res_essense_of_promotion['value_promotion'];?></p>
                    <p class="end_date_promotion">Истекает <?= $end_date;?></p>
                    <?php // }?>
                </div>
                <div id="computers" >
                    <?php foreach ($res_products as $res_product) {
                        if ($res_product['promotion_discount'] == '1') {
                            $old_price = $res_product['price'];
                            $discount = ($res_product['price'] * $res_product['promotion_discount_value']) / 100;
                            $new_price = $res_product['price'] - $discount;
                        }
                        if($res_product['promotion_offer'] == '1'){
                            $new_price = $res_product['price'];
                        }
                        if($res_product['promotion_minus'] == '1'){
                            $new_price = $res_product['price'] - $res_product['promotion_discount_value'];
                        }?>
                        <div class="column" data-price="<?= $new_price; ?>" price="<?= $new_price ?>" iid="<?= $res_product['ProductId'] ?>">
                            <div>
                                <img class="main_img" src="/application/photo/<?= $res_product['department_id']; ?>/<?= $res_product['photo']; ?>" alt="<?= $res_product['name']; ?>" align=right width=190px height=190px>
                            </div>
                            <div class="info_for_phone">
                                <ul>
                                    <li>
                                        <p class="name_main_product"><?= $res_product['name']; ?></p>
                                    </li>
                                    <li>
                                        <?php if($res_product['promotion_offer'] == '1'){?>
                                            <p class="offer_promotion_price"><?= $res_product['title']?></p>
                                        <? }else{?>
                                            <p class="old_price_products" price="<?= $res_product['price'] ?>"><?= $res_product['price'] . ' грн'; ?>
                                            </p>
                                        <?php }?>
                                    </li>
                                    <li>
                                        <p class="price_products" price="<?= $new_price ?>"><?= $new_price . ' грн'; ?></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php
            echo $pagination;
            ?>
        </div>
        <?php }?>
    </body>
</html>
<script>
    $.getJSON("https://api.ipify.org/?format=json", function(e) {
        var ip_address =  e.ip;
        $(".column").attr('ip_address',ip_address);
    });
    $('.column').click(function(){
        var id = $(this).attr('iid');
        var ip_address = $(this).attr('ip_address');
        $(location).attr("href", '/main/view/?id='+id+"&ip_address="+ip_address);
    });
</script>
<script>
    $(".column").hover(
        function() {
            var iid = $(this).attr('iid');
            var price = $(this).attr('price');
            $(this).append($('<button>')
                .text('Добавить в корзину')
                .addClass('btn btn-danger buy')
                .attr('iid',iid)
                .attr('price',price)
            )
            $.getJSON("https://api.ipify.org/?format=json", function(e) {
                var ip_address =  e.ip;
                $(".buy").each(function() {
                    $(this).attr('ip_address',ip_address);
                });
            });
            $(".buy").each(function() {
                $(this).on("click", function () {
                    var iid = $(this).attr('iid');
                    var ip_address = $(this).attr('ip_address');
                    var price = $(this).attr('price');
                    var quantity = 1;
                    $.ajax({
                        type: "POST",
                        url: "/main/AddToCart",
                        data: "iid=" + iid + "&res_ip_address=" + ip_address+"&quantity="+quantity+"&price="+price,
                        success: function (res) {
                        },
                        error: function () {

                        }
                    });
                });
            });
        },
        function() {
            $(this).find('button').remove();
        }
    );
</script>
