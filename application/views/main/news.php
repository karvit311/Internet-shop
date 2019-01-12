<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>New products</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php
        function cutStr($str, $length=50, $postfix='...')
        {
            if ( strlen($str) <= $length)
                return $str;

            $temp = substr($str, 0, $length);
            return substr($temp, 0, strrpos($temp, ' ') ) . $postfix;
        }
        ?>
        <?php
        $products_pagination = new \Application\models\Product();
        $res_products_pagination = $products_pagination->get_total_by_new_product();
        foreach($res_products_pagination as $res_product_pagination) {
        $total = $res_product_pagination['total'];
        $adjacents = 3;
        $page = $_GET['page'];
        $targetpage = "/admin/News/?"; //your file name
        $limit =2; //how many items to show per page
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
        $res_products = $products->get_products_by_news($limit,$start);
        $res_products->execute();
        include("pagination.php"); ?>
        <div class="container">
            <div class="row">
                <div id="breadcrumbs-products">
                    <ul>
                        <li><a class="btn btn-default come_back" href="/main/menu" role="button"><span class="glyphicon glyphicon-arrow-left"></span>  Вернуться</a></li>
                        <li><a class="btn btn-light" href="/main/about" role="button">AllPAN</a></li>
                        <li class="greater-sign"> ></li>
                        <li> <a class="btn btn-light" href="#" role="button">New Products </a></li>
                    </ul>
                </div>
                <!-- DELETING SUCCESS-->
                <div class="alert alert-success deleting_product alert-dismissable" style="display: none;" id="flash-msg-deleting-product">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4><i class="icon fa fa-check"></i>Success!</h4><p>Product've  successfully deleted!</p>
                </div>
                <!-- ADDING TOCART SUCCESS-->
                <div class="alert alert-success adding_product alert-dismissable" style="display: none;" id="flash-msg-adding-tocart">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4><i class="icon fa fa-check"></i>Success!</h4><p>Product've  successfully added to cart!</p>
                </div>
                <div class="wrapper">
                    <!-- Sidebar -->
                    <nav id="sidebar">
                        <div class="sidebar-header">
                            <h3>Other adjustments</h3>
                        </div>
                        <ul class="list-unstyled components">
                            <li>
                                <a href="/main/BeOver/?page=1" >Will soon be over  </a>
                            </li>
                            <li>
                                <a href="/main/SpecialOffers/?page=1">Special offers</a>
                            </li>
                            <li>
                                <a href="/main/Popular/?page=1">Popular products</a>
                            </li>
                            <li>
                                <a href="/main/Discount/?page=1">Discounts</a>
                            </li>
                            <li>
                                <a href="/main/Promotion/?page=1">Promotions</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <!-- Video -->
                <div class="video_left_block">
                    <iframe class="" src="https://www.youtube.com/embed/vlDzYIIOYmM" allowfullscreen width="265px"></iframe>
                </div>
                <div class="body-products" style="display:flex;">
                    <div id="computers" style="min-width:1189px;">
                        <?php
                        if(isset($_SESSION['email']))
                            $email = $_SESSION['email'];
                        else
                            $email = 0;
                        ?>
                        <?php foreach ($res_products as $res_product){?>
                            <div class="column <?= $res_product['brand'];?> <?= $res_product['colour'];?>" email="<?= $email;?>" iid="<?= $res_product['id'];?>" real_price="<?= $res_product['price'];?>" data-price="<?= $res_product['price']; ?>" price="<?= $res_product['price']?>" >
                                <div class="column-div">
                                    <?php if($res_product['special_offer'] == '1'){?>
                                        <div data-description="2 в 1" class="button button-2in1">2 в 1</div>
                                    <?php }?>
                                    <?php if($res_product['discount'] == '1' && $res_product['new_product']== '1'){
                                        $about_discount = new \Application\models\Product();
                                        $res_about_discount = $about_discount->get_discount_by_special_offer_and_discount();
                                        foreach($res_about_discount as $res_ab_discount){
                                        }
                                        ?>
                                        <div data-description="Скидка - <?= $res_ab_discount['value_discount'] . '%'; ?>" class="button button-discount"><?= $res_ab_discount['value_discount'] . '%'; ?></div>
                                    <?php }?>
                                    <?php if($res_product['new_product'] == '1' ){?>
                                        <div data-description="Новинка" class="button button-new">Новинка</div>
                                    <?php }?><br>
                                    <?php if($res_product['popular'] == '1' && $res_product['new_product']== '1'){?>
                                        <div data-description="Топ продаж" class="button button-top">Топ продаж</div>
                                    <?php }?>
                                    <?php if($res_product['quantity']<10 && $res_product['popular'] == '1'){?>
                                        <div class="button button-over">Заканчивается</div>
                                    <?php }?>
                                </div>
                                <div>
                                    <img class="main_img" src="/application/photo/<?= $res_product['department_id'];?>/<?= $res_product['photo'];?>" alt="<?= $res_product['name'];?>" align=right  width=190px height=190px>
                                </div>
                                <div class="info_for_phone">
                                    <ul>
                                        <li>
                                            <p iid="<?= $res_product['id'] ?>" class="name_main_product"><?php echo cutStr($res_product['name'], $length=100, $postfix='...');?></p>
                                        </li>
                                        <li>
                                            <?php
                                            $product_id = $res_product['id'];
                                            $all_products = new \Application\models\Rating();
                                            $res_all_products = $all_products->get_rating_by_product_id($product_id);
                                            $res_all_products->execute(array($product_id));
                                            foreach ($res_all_products as $row) {}
                                            $total_ratings = new \Application\models\Rating();
                                            $res_total_ratings = $total_ratings->get_total_rating($product_id);
                                            $res_total_ratings->execute(array($product_id));
                                            foreach ($res_total_ratings as $res_total_rating) {}
                                            $rating = $res_total_rating['total'];
                                            $percent = $rating*100/5; ?>
                                            <div class="star-rating" title="70%">
                                                <div class="back-stars">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <div class="front-stars" style="width: <?= $percent;?>%">
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $all_ratings_for_this_product = new \Application\models\Rating();
                                            $res_all_rating_for_this_products = $all_ratings_for_this_product->get_total_users_rated($product_id);
                                            $res_all_rating_for_this_products->execute(array($product_id));
                                            foreach($res_all_rating_for_this_products as $res_all_rating_for_this_product){
                                            }
                                            $total_rate = $res_all_rating_for_this_product['total'];
                                            ?>
                                            <div class="products-total-rated">Всего отзывов: <span><?php printf('%d', $total_rate);?></span></div>
                                        </li>
                                        <li>
                                            <p class="price_products" price="<?= $res_product['price']?>"><?= $res_product['price'].' грн';?></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                    <div class="col-md-3 newsticker-div">
                        <h3>New products</h3>
                        <?php
                        $products = new \Application\models\Product();
                        $res_products = $products->get_products();
                        ?>
                        <div id="block-news ">
                            <img id="news-prev" src="/application/photo/icons/img-prev.png" />
                            <div id="newsticker">
                                <ul>
                                    <?php
                                    foreach ($res_products as $key => $new) {?>
                                        <li sclass="newsticker-li">
                                            <a href="/"><img src="/application/photo/<?= $res_product['department_id'];?>/<?= $new['photo'];?>"  title="<?= $new['name'];?>" width="170px" heigth="240px"></a>
                                        </li>
                                    <?php }?>
                                </ul>
                            </div>
                            <img id="news-next" src="/application/photo/icons/img-next.png" />
                        </div>
                    </div>
                </div>
                <!-- Modal confirm -->
                <div class="modal" id="confirmModal" style="display: none; z-index: 1050;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-body" id="confirmMessage">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" id="confirmOk">Ok</button>
                                <button type="button" class="btn btn-default" id="confirmCancel">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                echo $pagination;
            ?>
        </div>
    <?php }?>
    </body>
</html>
<script src="/application/js/main.js"></script>

