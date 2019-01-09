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
        $department_id = $_GET['department_id'];
        $products_pagination = new \Application\models\Product();
        $res_products_pagination = $products_pagination->get_total_products_by_department_id($department_id);
        $res_products_pagination->execute(array($department_id));
        foreach($res_products_pagination as $res_product_pagination) {
            $total = $res_product_pagination['total'];
            $adjacents = 3;
            $page = $_GET['page'];
            $targetpage = "/main/products/?department_id=".$department_id."&"; //your file name
            $limit = 12; //how many items to show per page
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
            $res_products = $products->get_products_by_department_id($department_id,$limit,$start);
            $res_products->execute();
            include("pagination.php");
            $departments = new \Application\models\Department();
            $res_departments = $departments->get_department_conditionals_id($department_id);//отдел на который мы зашли
            $res_departments->execute(array($department_id));
            foreach($res_departments as $res_department){
                $department_name = $res_department['department'];
                $parent_id = $res_department['parent_id'];//12
                $main_departments = new \Application\models\Department();
                $res_main_departments = $main_departments->get_department_conditionals_id($parent_id);//главный отдел
                $res_main_departments->execute(array($parent_id));
                foreach($res_main_departments as $res_main_department){
                    $name_main_department = $res_main_department['department'];
                    $id_main_department = $res_main_department['id'];//12
                }
                $all_departments_in_one_category = new \Application\models\Department();
                $res_all_departments_in_one_categories = $all_departments_in_one_category->get_departments_parent($parent_id);//все отделы
                $res_all_departments_in_one_categories->execute(array($parent_id));
                $count_departments_all_subcategory = new \Application\models\Department();
                $res_count_departments_all_subcategories = $count_departments_all_subcategory->get_departments_parent_count($parent_id);//все отделы
                $res_count_departments_all_subcategories->execute(array($parent_id));
                foreach($res_count_departments_all_subcategories as $res_count_departments_all_subcategorie){
                }
            }
            ?>
            <?php
            function cutStr($str, $length=50, $postfix='...'){
                if ( strlen($str) <= $length)
                    return $str;
                $temp = substr($str, 0, $length);
                return substr($temp, 0, strrpos($temp, ' ') ) . $postfix;
            } ?>
            <div class="container">
                <div class="row">
                    <div id="breadcrumbs-products">
                        <ul>
                            <li><a class="btn btn-default come_back" href="/main/menu" role="button"><span class="glyphicon glyphicon-arrow-left"></span>  Вернуться</a></li>
                            <li><a class="btn btn-light" href="/main/about" role="button">AllPAN</a></li>
                            <li class="greater-sign"> ></li>
                            <li> <a class="btn btn-light" href="#" role="button"><?= $name_main_department;?> </a></li>
                            <li class="greater-sign"> ></li>
                            <li><a class="btn btn-light" href="#" role="button"><?= $department_name;?></a></li>
                        </ul>
                    </div>
                    <!-- DELETING SUCCESS-->
                    <div class="alert alert-success deleting_product alert-dismissable" style="display: none;" id="flash-msg-deleting-product">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <h4><i class="icon fa fa-check"></i>Success!</h4><p>Product've  successfully deleted!</p>
                    </div>
                    <div id="categories_products_left_block">
                        <h4>Категории</h4>
                        <ul id="menu">
                            <?php
                            $all_parent_departments = new \Application\models\Department();
                            $res_all_parent_departments = $all_parent_departments->get_departments_parent(1);
                            $res_all_parent_departments->execute(array(1));
                            foreach($res_all_parent_departments as $res_all_parent_department){
                                $parent_department = $res_all_parent_department['department'];
                                $parent_id = $res_all_parent_department['id'];
                                $all_children_departments = new \Application\models\Department();
                                $res_all_children_departments = $all_children_departments->get_departments_parent($parent_id);
                                $res_all_children_departments->execute(array($parent_id));
                                $res_count_departments_all_subcategories = $count_departments_all_subcategory->get_departments_parent_count($parent_id);//все отделы
                                $res_count_departments_all_subcategories->execute(array($parent_id));
                                foreach($res_count_departments_all_subcategories as $res_count_departments_all_subcategorie){
                                }?>
                                <li><span><?= $parent_department;?>(<?= $res_count_departments_all_subcategorie['total'];?>)</span>
                                    <ul>
                                        <?php foreach($res_all_children_departments as $res_all_children_department){
                                            $count_departments_in_only_one_category = new \Application\models\Department();
                                            $res_count_departments_in_only_one_categories = $count_departments_in_only_one_category->get_departments_only_category_count($res_all_children_department['id']);//все отделы
                                            $res_count_departments_in_only_one_categories->execute(array($res_all_children_department['id']));
                                            foreach($res_count_departments_in_only_one_categories as $res_count_departments_in_only_one_categorie){?>
                                                <li><a href="/main/products/?department_id=<?= $res_all_children_department['id']?>&page=1"><?= $res_all_children_department['department']; ?>(<?=  $res_count_departments_in_only_one_categorie["total"];?>)</a></li>
                                            <?php }
                                        }?>
                                    </ul>
                                </li>
                            <?php }?>
                        </ul>
                        <hr>
                        <h4>Цена</h4>
                        <div id="slider-range"></div>
                        <div id="slider-container">
                            <p>
                                <input type="text" id="amount" style="border: 0; color: #f6931f; font-weight: bold;" />
                            </p>
                        </div>
                        <hr>
                        <div id="filters">
                            <?php $department_id = $_GET['department_id'];
                            $brands_check_exist = new \Application\models\Product();
                            $res_brands_check_exist = $brands_check_exist->get_brands_by_department_id($department_id);
                            $res_brands_check_exist->execute(array($department_id));
                            foreach($res_brands_check_exist as $res_brand_check_exist){}
                            if($res_brand_check_exist['brand'] != ''){?>
                                <h4>Бренд</h4>
                                <ul id="categories">
                                    <?php $department_id = $_GET['department_id'];
                                    $brands = new \Application\models\Product();
                                    $res_brands = $brands->get_brands_by_department_id($department_id);
                                    $res_brands->execute(array($department_id));
                                    foreach($res_brands as $res_brand){
                                        if($res_brand['brand']!= ''){?>
                                            <li>
                                                <input type="checkbox" value="<?= $res_brand['brand'];?>" id="filter-<?= $res_brand['brand'];?>" checked="checked" />
                                                <label for="filter-<?= $res_brand['brand'];?>"><?= $res_brand['brand'];?></label>
                                            </li>
                                        <?php }?>
                                    <?}?>
                                </ul>
                            <?php }?>
                            <hr>
                            <?php $colors_check_if_exist = new \Application\models\Product();
                            $res_colors_check_if_exist = $colors_check_if_exist->get_colors_by_department_id($department_id);
                            $res_colors_check_if_exist->execute(array($department_id));
                            foreach($res_colors_check_if_exist as $res_color_check_if_exist){}
                            if($res_color_check_if_exist['colour'] !=''){?>
                                <h4>Цвет</h4>
                                <ul id="color-type">
                                    <?php
                                    $colors = new \Application\models\Product();
                                    $res_colors = $colors->get_colors_by_department_id($department_id);
                                    $res_colors->execute(array($department_id));
                                    foreach($res_colors as $res_color){
                                        if($res_color['colour'] != ''){?>
                                            <li>
                                                <input type="checkbox" value="<?= $res_color['colour'];?>" id="filter-color-<?= $res_color['colour'];?>" checked="checked" />
                                                <label for="filter-color-<?= $res_color['colour'];?>"><?= $res_color['colour'];?></label>
                                            </li>
                                        <?php }?>
                                    <?php }?>
                                </ul>
                            <?php }?>
                        </div>
                        <hr>
                    </div>
                    <div class="body-products" style="display:flex;">
                        <div id="computers" style="min-width:1189px;">
                            <?php foreach ($res_products as $res_product){
                                if($res_product['discount'] == 1){
                                    $old_price = $res_product['price'];
                                    $discount = ($res_product['price']*$res_product['value_discount'])/100;
                                    $new_price = $res_product['price'] - $discount;
                                    $new_price = round($new_price,3);
                                }else{
                                    $new_price = $res_product['price'];
                                }
                            ?>
                            <?php
                            if(isset($_SESSION['email']))
                                $email = $_SESSION['email'];
                            else
                                $email = 0;
                            ?>
                            <div class="column <?= $res_product['brand']; ?> <?= $res_product['colour']; ?>" email="<?= $email; ?>" data-price="<?= $new_price; ?>" real_price="<?= $res_product['price'];?>" price="<?= $new_price ?>" iid="<?= $res_product['id'] ?>" value_discount="<?php $about_discount = new \Application\models\Product();
                                 $res_about_discount = $about_discount->get_discount_by_product_id($res_product['id']);
                                 $res_about_discount->execute(array($res_product['id']));
                                 foreach ($res_about_discount as $res_ab_discount) {if($res_product['discount'] ==1){ echo $res_ab_discount['value_discount'];}}?>">
                                <div class="column-div">
                                     <?php if ($res_product['discount'] == '1' && $res_ab_discount['value_discount']>0) {
                                        $about_discount = new \Application\models\Product();
                                        $res_about_discount = $about_discount->get_discount_by_product_id($res_product['id']);
                                        $res_about_discount->execute(array($res_product['id']));
                                        foreach ($res_about_discount as $res_ab_discount) {
                                            ?>
                                            <div data-description="Скидка - <?= $res_ab_discount['value_discount'] . '%'; ?>" class="button button-discount"><?= $res_ab_discount['value_discount'] . '%'; ?></div>
                                            <?php
                                        }
                                    }?>
                                    <?php if ($res_product['special_offer'] == '1') { ?>
                                        <div data-description="2 в 1" class="button button-2in1">2 в 1</div>
                                    <?php } ?>

                                    <?php if($res_product['new_product'] == '1'){?>
                                        <div data-description="Новинка" class="button button-new">Новинка</div>
                                    <?php }?><br>
                                    <?php if($res_product['popular'] == '1'){?>
                                        <div data-description="Топ продаж" class="button button-top">Топ продаж</div>
                                    <?php }?>
                                    <?php if($res_product['quantity']<10 && $res_product['popular'] == '1'){?>
                                        <div class="button button-over">Заканчивается</div>
                                    <?php }?>
                                </div>
                                <div>
                                    <?php
                                    $department_id = $_GET['department_id'];
                                    $all_parent_departments = new \Application\models\Department();
                                    $res_all_parent_departments = $all_parent_departments->get_deparment_by_id($department_id);
                                    $res_all_parent_departments->execute(array($department_id));
                                    foreach($res_all_parent_departments as $res_all_parent_department){
                                        $department_name = $res_all_parent_department['department'];
                                    }
                                    ?>
                                    <img iid="<?= $res_product['id'] ?>" class="main_img" src="/application/photo/<?= $department_id;?>/<?= $res_product['photo'];?>" alt="<?= $res_product['name'];?>" align=right  width=190px height=190px>
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
                                            $percent = $rating*100/5;?>
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
                                            <p class="price_products"  price="<?= $res_product['price']?>"><?= $res_product['price'].' грн';?></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <?php
                         }?>
                    </div>
                    <div class="news-of-company-main-products">
                        <?php $get_news = new \Application\models\News();
                        $res_get_news = $get_news->get_limited_news();
                        foreach($res_get_news as $res_get_new){
                            $wordCount = 34;
                            $outputText = implode(' ', (array_slice(explode(' ', $res_get_new['content']), 0, $wordCount))).' ...';?>
                            <a href="/main/NewsOfCompany/?id=<?= $res_get_new['id'];?>">
                                <div class="block_right_worker_new">
                                    <span><p class="title_right_block_new"><?= $res_get_new['title'];?></p></span>
                                    <img width="220px" height="170px" src="/application/photo/news/<?= $res_get_new['img'];?>" />
                                    <div class="content_right_block_new">
                                        <p><?= $outputText;?></p>
                                    </div>
                                </div>
                                <hr>
                            </a>
                        <?php }?>
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
<script src="/application/js/main-products.js"></script>

