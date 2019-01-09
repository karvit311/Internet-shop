<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Discount</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php
        $products_pagination = new \Application\models\Product();
        $res_products_pagination = $products_pagination->get_total_by_discount();
        foreach($res_products_pagination as $res_product_pagination) {
            $total = $res_product_pagination['total'];
            $adjacents = 3;
            $page = $_GET['page'];
            $targetpage = "/main/Discount/?"; //your file name
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
            $res_products = $products->get_prices_by_discount($limit,$start);
            $res_products->execute();
            include("pagination.php"); ?>
            <div class="container">
                <div class="row">
                    <div id="breadcrumbs-products">
                        <ul>
                            <li><a class="btn btn-default come_back " href="/main/menu" role="button"><span class="glyphicon glyphicon-arrow-left"></span>  Вернуться</a></li>
                            <li><a class="btn btn-light" href="/main/about" role="button">AllPAN</a></li>
                            <li class="greater-sign"> ></li>
                            <li> <a class="btn btn-light" href="#" role="button">Discount </a></li>
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
                                    <a href="/main/News/?page=1">New products</a>
                                </li>
                                <li>
                                    <a href="/main/Popular/?page=1">Popular products</a>
                                </li>
                                <li>
                                    <a href="/main/SpecialOffers/?page=1">Special offers</a>
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
                            <?php foreach ($res_products as $res_product){
                                $old_price = $res_product['price'];
                                $discount = ($res_product['price']*$res_product['value_discount'])/100;
                                $new_price = $res_product['price'] - $discount;
                                $date = date_create($res_product['end_date']);
                                $end_date =  date_format($date,'d F');
                               ?>
                                <div class="column <?= $res_product['brand'];?> <?= $res_product['colour'];?>" email="<?= $email;?>" data-price="<?= $new_price ?>" iid="<?= $res_product['id']; ?>" real_price="<?= $res_product['price'];?>" price="<?= $new_price?>" >
                                    <div >
                                        <img src="/application/photo/<?= $res_product['department_id'];?>/<?= $res_product['photo'];?>" alt="<?= $res_product['name'];?>" align=left  width=215px height=215px>
                                    </div>
                                    <div class="info_for_phone">
                                        <ul>
                                            <li>
                                                <p class="info_name_product"><?= $res_product['name'];?></p>
                                            </li>
                                            <li>
                                                <div class="sale-count"><span><?= '-'.$res_product['value_discount'].'%'; ?></span></div>
                                                <p class="price-products-discount"  price="<?= $res_product['price']?>"><?= $res_product['price'].' грн';?></p>
                                                <p class="new_price_products"  price="<?= $new_price?>"><?= $new_price.' грн';?></p>
                                                <p>Истекает <?= $end_date;?></p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                        <div class="col-md-3 discount_new_product_main newsticker-div">
                            <h3>New products</h3>
                            <?php
                            $products = new \Application\models\Product();
                            $res_products = $products->get_products();
                            ?>
                            <div id="block-news">
                                <img id="news-prev" src="/application/photo/icons/img-prev.png" />
                                <div id="newsticker">
                                    <ul>
                                        <?php
                                        foreach ($res_products as $key => $new) {?>
                                            <li class="newsticker-li">
                                                <a href="/"><img src="/application/photo/<?= $new['department_id'];?>/<?= $new['photo'];?>"  title="<?= $new['name'];?>" width="170px" heigth="240px"></a>
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
