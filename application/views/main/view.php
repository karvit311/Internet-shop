<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Products</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/application/css/view-index.css">

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
        <?php
        function cutStr($str, $length=50, $postfix='...'){
            if ( strlen($str) <= $length)
                return $str;
            $temp = substr($str, 0, $length);
            return substr($temp, 0, strrpos($temp, ' ') ) . $postfix;
        } ?>
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
                                </li>
                                <?php
                                if(isset($_SESSION['email']))
                                    $email = $_SESSION['email'];
                                else
                                    $email = 0;
                                ?>
                                <li class="view-right-third-block" style="font-size:14px;height:130px;margin-top:20px;">
                                    <?php echo cutStr($res_product['big_description'], $length=600, $postfix='...');?>
                                    <button style=" margin-top:20px;" type="button" id="right-block-product-view-button-to-buy" email="<?= $email;?>" final_price="<?= $res_product['price'];?>" real_price="<?= $res_product['price'];?>" price="<?= $new_price;?>" iid="<?= $res_product['productId'];?>" ip_address="<?= $_GET['ip_address'];?>" class="btn btn-danger btn-lg">Купить</button>
                                    <div id="view-product-articul">Арт.:<?= $res_product['productId']?></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php }?>
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
<script src="/application/js/main.js"></script>

