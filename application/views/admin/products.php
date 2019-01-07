<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$_SESSION['urlpage'] = "<a href='/admin/index'>Товары</a>";?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Products</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
<!--    <style>-->
<!--        .modal_small_img_uploads button{-->
<!--            margin-left:-10px;-->
<!--            margin-top:-5px;-->
<!--            color:red;-->
<!--            opacity:1;-->
<!--        }-->
<!--        .modal_small_img_uploads img{-->
<!--            width:120px;-->
<!--            height:100px;-->
<!--        }-->
<!--        .modal_small_img_uploads hr{-->
<!--            border-top:1px solid #f1b5b5;-->
<!--        }-->
<!--        .modal_small_img_uploads input{-->
<!--            margin:10px;-->
<!--        }-->
<!--    </style>-->
    <body><?php
        $department_id = $_GET['department_id'];
        $products_pagination = new \Application\models\Product();
        $res_products_pagination = $products_pagination->get_total_products_by_department_id($department_id);
        $res_products_pagination->execute(array($department_id));
        foreach($res_products_pagination as $res_product_pagination) {
            $total = $res_product_pagination['total'];
            $adjacents = 3;
            $page = $_GET['page'];
            $targetpage = "/admin/products/?department_id=".$department_id."&";//your file name
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
            $res_departments = $departments->get_department_conditionals_id($department_id);//конкретний отдел
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
            <div class="container">
                <div class="row">
                    <div id="breadcrumbs-products">
                        <ul>
                            <li><a class="btn btn-default come_back" href="/admin/index"  role="button"><span class="glyphicon glyphicon-arrow-left"></span>  Вернуться</a></li>
                            <li><a class="btn btn-light"  href="/admin/about" role="button">AllPAN</a></li>
                            <li class="greater-sign"> ></li>
                            <li> <a class="btn btn-light"  href="#" role="button"><?= $name_main_department;?> </a></li>
                            <li class="greater-sign"> ></li>
                            <li><a class="btn btn-light"  href="#" role="button"><?= $department_name;?></a></li>
                        </ul>
                    </div>
                    <?php
                    print_r($_SESSION);
//                    if (session_status() != PHP_SESSION_NONE) {
//                        if (isset($_SESSION['loggedin'])) {
//                            if ($_SESSION['loggedin'] == 1) {

                                if ($_SESSION['admin'] = "admin") {
                                    if (isset($_SESSION['admin_role'])) {
                                    if ($_SESSION['admin_role'] == 'admin-product' || $_SESSION['admin_role'] == 'admin') {
                                        $department_id = $_GET['department_id'];
                                        $all_parent_departments = new \Application\models\Department();
                                        $res_all_parent_departments = $all_parent_departments->get_deparment_by_id($department_id);
                                        $res_all_parent_departments->execute(array($department_id));
                                        foreach ($res_all_parent_departments as $res_all_parent_department) {
                                            $department_name = $res_all_parent_department['department'];
                                        }
                                        ?>
                                        <?php
                                        function cutStr($str, $length = 50, $postfix = '...')
                                        {
                                            if (strlen($str) <= $length)
                                                return $str;
                                            $temp = substr($str, 0, $length);
                                            return substr($temp, 0, strrpos($temp, ' ')) . $postfix;
                                        }

                                        ?>
                                        <!-- DELETING SUCCESS-->
                                        <div class="alert alert-success deleting_product alert-dismissable"
                                             style="display: none;" id="flash-msg-deleting-product">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">
                                                ×
                                            </button>
                                            <h4><i class="icon fa fa-check"></i>Success!</h4>
                                            <p>Product've successfully deleted!</p>
                                        </div>
                                        <!-- ADDING SUCCESS-->
                                        <div class="alert alert-success adding_product alert-dismissable"
                                             style="display: none;" id="flash-msg-adding-product">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">
                                                ×
                                            </button>
                                            <h4><i class="icon fa fa-check"></i>Success!</h4>
                                            <p>Product've successfully added!</p>
                                        </div>
                                        <!-- EDITION SUCCESS-->
                                        <div class="alert alert-success edition_product alert-dismissable"
                                             style="display: none;" id=" flash-msg-edition-product">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">
                                                ×
                                            </button>
                                            <h4><i class="icon fa fa-check"></i>Success!</h4>
                                            <p>Product've successfully edited!</p>
                                        </div>
                                        <div id="categories_products_left_block">
                                            <h4>Категории</h4>
                                            <ul id="menu">
                                                <?php
                                                $all_parent_departments = new \Application\models\Department();
                                                $res_all_parent_departments = $all_parent_departments->get_departments_parent(1);
                                                $res_all_parent_departments->execute(array(1));
                                                foreach ($res_all_parent_departments as $res_all_parent_department) {
                                                    $parent_department = $res_all_parent_department['department'];
                                                    $parent_id = $res_all_parent_department['id'];
                                                    $all_children_departments = new \Application\models\Department();
                                                    $res_all_children_departments = $all_children_departments->get_departments_parent($parent_id);
                                                    $res_all_children_departments->execute(array($parent_id));
                                                    $res_count_departments_all_subcategories = $count_departments_all_subcategory->get_departments_parent_count($parent_id);//все отделы
                                                    $res_count_departments_all_subcategories->execute(array($parent_id));
                                                    foreach ($res_count_departments_all_subcategories as $res_count_departments_all_subcategorie) {
                                                    } ?>
                                                    <li>
                                                        <span><?= $parent_department; ?>(<?= $res_count_departments_all_subcategorie['total']; ?>)</span>
                                                        <ul>
                                                            <?php foreach ($res_all_children_departments as $res_all_children_department) {
                                                                $count_departments_in_only_one_category = new \Application\models\Department();
                                                                $res_count_departments_in_only_one_categories = $count_departments_in_only_one_category->get_departments_only_category_count($res_all_children_department['id']);//все отделы
                                                                $res_count_departments_in_only_one_categories->execute(array($res_all_children_department['id']));
                                                                foreach ($res_count_departments_in_only_one_categories as $res_count_departments_in_only_one_categorie) {
                                                                    ?>
                                                                    <li>
                                                                        <a href="/admin/products/?department_id=<?= $res_all_children_department['id'] ?>&page=1"><?= $res_all_children_department['department']; ?>
                                                                            (<?= $res_count_departments_in_only_one_categorie["total"]; ?>
                                                                            )</a></li>
                                                                <?php }
                                                            } ?>
                                                        </ul>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                            <hr>
                                            <h4>Цена</h4>
                                            <div id="slider-range"></div>
                                            <div id="slider-container">
                                                <p>
                                                    <input type="text" id="amount"/>
                                                </p>
                                            </div>
                                            <hr>
                                            <div id="filters">
                                                <?php $department_id = $_GET['department_id'];
                                                $brands_check_exist = new \Application\models\Product();
                                                $res_brands_check_exist = $brands_check_exist->get_brands_by_department_id($department_id);
                                                $res_brands_check_exist->execute(array($department_id));
                                                foreach ($res_brands_check_exist as $res_brand_check_exist) {
                                                }
                                                if ($res_brand_check_exist['brand'] != '') {
                                                    ?>
                                                    <h4>Бренд</h4>
                                                    <ul id="categories">
                                                        <?php
                                                        $brands = new \Application\models\Product();
                                                        $res_brands = $brands->get_brands_by_department_id($department_id);
                                                        $res_brands->execute(array($department_id));
                                                        foreach ($res_brands as $res_brand) {
                                                            if ($res_brand['brand'] != '') {
                                                                ?>
                                                                <li>
                                                                    <input type="checkbox"
                                                                           value="<?= $res_brand['brand']; ?>"
                                                                           id="filter-<?= $res_brand['brand']; ?>"
                                                                           checked="checked"/>
                                                                    <label for="filter-<?= $res_brand['brand']; ?>"><?= $res_brand['brand']; ?></label>
                                                                </li>
                                                            <?php }
                                                        } ?>
                                                    </ul>
                                                <?php } ?>
                                                <hr>
                                                <?php $colors_check_if_exist = new \Application\models\Product();
                                                $res_colors_check_if_exist = $colors_check_if_exist->get_colors_by_department_id($department_id);
                                                $res_colors_check_if_exist->execute(array($department_id));
                                                foreach ($res_colors_check_if_exist as $res_color_check_if_exist) {
                                                }
                                                if ($res_color_check_if_exist['colour'] != '') {
                                                    ?>
                                                    <h4>Цвет</h4>
                                                    <ul id="color-type">
                                                        <?php
                                                        $colors = new \Application\models\Product();
                                                        $res_colors = $colors->get_colors_by_department_id($department_id);
                                                        $res_colors->execute(array($department_id));
                                                        foreach ($res_colors as $res_color) {
                                                            if ($res_color['colour'] != '') {
                                                                ?>
                                                                <li>
                                                                    <input type="checkbox"
                                                                           value="<?= $res_color['colour']; ?>"
                                                                           id="filter-color-<?= $res_color['colour']; ?>"
                                                                           checked="checked"/>
                                                                    <label for="filter-color-<?= $res_color['colour']; ?>"><?= $res_color['colour']; ?></label>
                                                                </li>
                                                            <?php }
                                                        } ?>
                                                    </ul>
                                                <?php } ?>
                                            </div>
                                            <hr>
                                        </div>
                                        <button type="button" id="add_new_product" class="btn btn-default">Add new
                                            product
                                        </button>
                                        <div id="computers">
                                            <?php foreach ($res_products as $res_product) { ?>
                                                <div class="column-admin <?= $res_product['brand']; ?> <?= $res_product['colour']; ?>"
                                                     data-price="<?= $res_product['price']; ?>"
                                                     price="<?= $res_product['price'] ?>">
                                                    <div class="column-div">
                                                        <?php if ($res_product['special_offer'] == '1') { ?>
                                                            <!--                                                    <img class="column-image-2-in-1" src="/application/photo/icons/2_in_1.jpg" width="45px;" height="45px;">-->
                                                            <div data-description="2 в 1" class="button button-2in1">2 в
                                                                1
                                                            </div>
                                                        <?php } ?>
                                                        <?php
                                                        if ($res_product['discount'] == '1') {
                                                            $about_discount = new \Application\models\Product();
                                                            $res_about_discount = $about_discount->get_discount_by_department_id_and_discount($department_id);
                                                            $res_about_discount->execute(array($department_id));
                                                            foreach ($res_about_discount as $res_ab_discount) {
                                                                if ($res_ab_discount['id'] == $res_product['id']) { ?>
                                                                    <div data-description="Скидка - <?= $res_ab_discount['value_discount'] . '%'; ?>"
                                                                         class="button button-discount"><?= $res_ab_discount['value_discount'] . '%'; ?></div>
                                                                    <?php
                                                                }
                                                            }
                                                        } ?>
                                                        <?php
                                                        if ($res_product['new_product'] == '1') {
                                                            ?>
                                                            <div data-description="Новинка" class="button button-new">
                                                                Новинка
                                                            </div>
                                                            <!--                                                    <img class="column-img-new" src="/application/photo/icons/new.png" width="45px;" height="45px;">-->
                                                            <?php
                                                        } ?><br>
                                                        <?php
                                                        if ($res_product['popular'] == '1') {
                                                            ?>
                                                            <div data-description="Топ продаж"
                                                                 class="button button-top">Топ продаж
                                                            </div>
                                                            <!--                                                    <img src="/application/photo/icons/bestsellers.png" width="35px;" height="35px;">-->
                                                            <?php
                                                        } ?>
                                                        <?php if ($res_product['quantity'] < 10 && $res_product['popular'] == '1') { ?>
                                                            <div class="button button-over">Заканчивается</div>
                                                        <?php } ?>
                                                    </div>
                                                    <div>
                                                        <img class="main_img"
                                                             src="/application/photo/<?= $department_id; ?>/<?= $res_product['photo']; ?>"
                                                             alt="<?= $res_product['name']; ?>" align=right width=190px
                                                             height=190px>
                                                    </div>
                                                    <div class="info_for_phone">
                                                        <ul>
                                                            <li>
                                                                <p class="name_main_product"><?php echo cutStr($res_product['name'], $length = 100, $postfix = '...'); ?></p>
                                                            </li>
                                                            <li>
                                                                <p class="price_products"
                                                                   price="<?= $res_product['price'] ?>"><?= $res_product['price'] . ' грн'; ?></p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <button type="submit" iid="<?= $res_product['id'] ?>"
                                                            name="<?= $res_product['name'] ?>"
                                                            price="<?= $res_product['price'] ?>"
                                                            name="<?= $res_product['name'] ?>"
                                                            class="btn-default button-edit">Edit
                                                    </button>
                                                    <button type="submit" iid="<?= $res_product['id'] ?>"
                                                            price="<?= $res_product['price'] ?>"
                                                            name="<?= $res_product['name'] ?>" class=" button-delete">
                                                        Delete
                                                    </button>
                                                </div>
                                                <?php
                                            } ?>
                                        </div>
                                        <!-- Modal confirm -->
                                        <div class="modal" id="confirmModal" style="display: none; z-index: 1050;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body" id="confirmMessage"></div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" id="confirmOk">
                                                            Ok
                                                        </button>
                                                        <button type="button" class="btn btn-default"
                                                                id="confirmCancel">Cancel
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="add_new_product_Modal" class="modal">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h3 class="modal-title">Add new Product</h3>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            &times;
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <form method="post" id="add_form" enctype="multipart/form-data"
                                                          class="feedback">
                                                        <div class="modal-body add_modal">
                                                            <div id="modal_add_about_images">
                                                                <div class="modal_main_image_block form-group">
                                                                    <h4>MAIN IMAGE</h4>
                                                                    <div class="image_modal_add">
                                                                        <img width=215px height=215px>
                                                                    </div>
                                                                    <div>
                                                                        <input type="file" id="file" name="file"/>
                                                                    </div>
                                                                </div>
                                                                <div class="small_images"
                                                                     id="small-images-products-admin">
                                                                    <h4>SMALL IMAGES</h4>
                                                                    <div class="modal_small_img_uploads">
                                                                    </div>
                                                                    <div id="objects">
                                                                        <div id="addimage0" class="addimage">
                                                                            <input type="hidden" name="MAX_FILE_SIZE"
                                                                                   value="2000000"/>
                                                                            <input type="file" class="file"
                                                                                   id="small_imgs_input" name="file[]"
                                                                                   multiple/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="info_for_phone_modal">
                                                                <ul>
                                                                    <li>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">Name</span>
                                                                            </div>
                                                                            <input type="text"
                                                                                   class="form-control name_add"
                                                                                   name="name">
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="input-group">
                                                                            <?php
                                                                            $departments = new \Application\models\Department();
                                                                            $res_departments = $departments->get_deparment_by_id($department_id);
                                                                            $res_departments->execute(array($department_id));
                                                                            foreach ($res_departments as $res_department) {
                                                                                $department = $res_department['department']; ?>
                                                                                <label for="SelectDepartment">Выбрать из
                                                                                    существующих отделов:</label>
                                                                                <input type="text" name="department_add"
                                                                                       department_id="<?= $res_department['id'] ?>"
                                                                                       class="form-control department_add"
                                                                                       value="<?= $department ?>"
                                                                                       disabled/>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">Brand</span>
                                                                            </div>
                                                                            <input type="text"
                                                                                   class="form-control brand_add"
                                                                                   name="brand">
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">Colour</span>
                                                                            </div>
                                                                            <input type="text"
                                                                                   class="form-control colour_add"
                                                                                   name="colour">
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">Price</span>
                                                                            </div>
                                                                            <input type="text"
                                                                                   class="form-control price_products_add"
                                                                                   name="price">
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">Description</span>
                                                                            </div>
                                                                            <textarea
                                                                                    class="form-control big_description_add"
                                                                                    cols="55"
                                                                                    name="big_description"></textarea>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">Adding info</span>
                                                                            </div>
                                                                            <textarea
                                                                                    class="form-control adding_info_add"
                                                                                    cols="55"
                                                                                    name="adding_info"></textarea>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">Quantity</span>
                                                                            </div>
                                                                            <input type="number"
                                                                                   class="form-control quantity_add"
                                                                                   name="quantity" min="1"/>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="input-group" id="checkboxes">
                                                                            <div class="discount-div">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text">Discount</span>
                                                                                </div>
                                                                                <input id="discount_add" type="checkbox"
                                                                                       name="discount" value="1"/>
                                                                            </div>
                                                                            <div class="promo-div">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text">Promotion</span>
                                                                                </div>
                                                                                <input id="promotion_add"
                                                                                       type="checkbox" name="promotion"
                                                                                       value="1"/>
                                                                            </div>
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">Popular</span>
                                                                            </div>
                                                                            <input id="popular_add" type="checkbox"
                                                                                   name="popular" value="1"/>
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">New</span>
                                                                            </div>
                                                                            <input id="new_product_add" type="checkbox"
                                                                                   name="new_product" value="1"/>
                                                                            <div class="special_offer-div">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text">Special Offer</span>
                                                                                </div>
                                                                                <input id="special_offer_add"
                                                                                       type="checkbox"
                                                                                       name="special_offer" value="1"/>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <p><input type="submit"
                                                                      id="submit_form-products-admin-add-product"
                                                                      name="submit_add" value="Сохранить товар"/></p>
                                                        </div>
                                                    </form>
                                                    <!-- Modal footer -->
                                                    <div class="modal-footer"></div>
                                                </div>
                                            </div>
                                        </div>   <!-- end Modal-->
                                        <div id="edit_product" class="modal">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h3 class="modal-title">Edition of product</h3>
                                                        <button type="button" class="close" data-dismiss="modal">
                                                            &times;
                                                        </button>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <form method="post" enctype="multipart/form-data" class="feedback">
                                                        <div class="modal-body edit_modal">
                                                            <div id="modal_edit_about_images">
                                                                <div class="modal_main_image_block">
                                                                    <h4>MAIN IMAGE</h4>
                                                                    <div class="image_modal_edit">
                                                                        <img width=215px height=215px>
                                                                    </div>
                                                                    <div>
                                                                        <input type="file" id="file" name="file"/>
                                                                    </div>
                                                                </div>
                                                                <div class="small_images">
                                                                    <h4>SMALL IMAGES</h4>
                                                                    <div class="small_images_modal_edit">
                                                                    </div>
                                                                    <div class="modal_small_img_uploads">
                                                                    </div>
                                                                    <div id="objects">
                                                                        <div id="addimage0" class="addimage">
                                                                            <input type="hidden" name="MAX_FILE_SIZE"
                                                                                   value="2000000"/>
                                                                            <input type="file" class="file"
                                                                                   name="file[]" multiple/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="info_for_phone_modal">
                                                                <ul>
                                                                    <li>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">ID</span>
                                                                            </div>
                                                                            <input type="text"
                                                                                   class="form-control id-modal"
                                                                                   name="id" disabled>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">Name</span>
                                                                            </div>
                                                                            <input type="text"
                                                                                   class="form-control name_modal_edit"
                                                                                   name="name">
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">Brand</span>
                                                                            </div>
                                                                            <input type="text"
                                                                                   class="form-control brand_modal_edit"
                                                                                   name="brand">
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">Colour</span>
                                                                            </div>
                                                                            <input type="text"
                                                                                   class="form-control colour_modal_edit"
                                                                                   name="colour">
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">Price</span>
                                                                            </div>
                                                                            <input type="text"
                                                                                   class="form-control price_edit"
                                                                                   name="price">
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">Description</span>
                                                                            </div>
                                                                            <textarea
                                                                                    class="form-control big_description"
                                                                                    cols="54"
                                                                                    name="big_description"></textarea>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">Adding info</span>
                                                                            </div>
                                                                            <textarea class="form-control adding_info"
                                                                                      cols="54"
                                                                                      name="adding_info"></textarea>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">Quantity</span>
                                                                            </div>
                                                                            <input type="number"
                                                                                   class="form-control quantity"
                                                                                   name="quantity" min="1"/>
                                                                        </div>
                                                                    </li>
                                                                    <li>
                                                                        <div class="input-group" id="checkboxes">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">Discount</span>
                                                                            </div>
                                                                            <input id="discount" class="discount_edit"
                                                                                   type="checkbox" name="discount"
                                                                                   value="1"/>
                                                                            <div class="discount_input">
                                                                                <input type="number"
                                                                                       placeholder="Введите скидку"
                                                                                       class="form-control quantity_discount"
                                                                                       disabled min="1"><br><br>
                                                                                <div class='input-group date'
                                                                                     id='datetimepicker6'>
                                                                                    <input type='text'
                                                                                           class="form-control"
                                                                                           id="bday" disabled
                                                                                           name="bday"/>
                                                                                    <span class="input-group-addon">
                                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                                            </span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">Promotion</span>
                                                                            </div>
                                                                            <input id="promotion" type="checkbox"
                                                                                   name="promotion" value="1"/>
                                                                            <div class="input-group">
                                                                                <label for="SelectPromotion"
                                                                                       class="promotion-edition-select-modal">Выбрать
                                                                                    промо-акцию:</label>
                                                                                <?php $promotions = new \Application\models\Promotion();
                                                                                $res_promotions = $promotions->get_promotions(); ?>
                                                                                <select class="form-group"
                                                                                        id="SelectPromotion"
                                                                                        name="select-promotion"
                                                                                        disabled>
                                                                                    <option selected value="-1">Все
                                                                                        промо-акции
                                                                                    </option>
                                                                                    <?php foreach ($res_promotions as $res_promotion) { ?>
                                                                                        <option id="promotion_select_modal"
                                                                                                name="promotion_select_modal"
                                                                                                value="<?= $res_promotion['id']; ?>"
                                                                                                promotion_id="<?= $res_promotion['id']; ?>"><?= $res_promotion['title']; ?></option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">Popular</span>
                                                                            </div>
                                                                            <input id="popular" type="checkbox"
                                                                                   name="popular" value="1"/>
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">New</span>
                                                                            </div>
                                                                            <input id="new_product" type="checkbox"
                                                                                   name="new_product" value="1"/>
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text">Special Offer</span>
                                                                            </div>
                                                                            <input id="special_offer" type="checkbox"
                                                                                   name="special_offer" value="1"/>
                                                                            <div class="special_offer_input">
                                                                                <p>Два товара по цене одного!</p>
                                                                                <div class='input-group date'
                                                                                     id='datetimepicker8'>
                                                                                    <input type='text'
                                                                                           class="form-control"
                                                                                           id="bday_special_offer"
                                                                                           disabled name="bday"/>
                                                                                    <span class="input-group-addon">
                                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                                            </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <p><input type="submit" id="submit_form_edit"
                                                                      name="submit_add" value="Сохранить товар"/></p>
                                                        </div>
                                                    </form>
                                                    <!-- Modal footer -->
                                                    <div class="modal-footer"></div>
                                                </div>
                                            </div>
                                        </div> <!-- end edit modal -->
                                        <?php
                                    } else {
                                        ?>
                                        <!-- ERROR PRIVILEGE-->
                                        <div class="alert alert-danger  alert-dismissable error-privilege"
                                             id="flash-msg-privilege-orders">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">
                                                ×
                                            </button>
                                            <h4><i class="icon fa fa-check"></i>ERROR!</h4>
                                            <p>У Вас нет прав на редактирование товара!</p>
                                        </div>
                                        <?php
                                    }
                                }else{ ?>
                                    <script type="text/javascript">
                                        window.location.href = '/main/Login';
                                    </script>
                                <?php }
                                } else {
                                    header('Location: /main/Login');
                                }
                           // }
                        //}
                    //}?>
                    </div>
                <?php
                    echo $pagination;
                ?>
            </div>
        <?php }?>
    </body>
</html>
<script>
    $("#menu ul").hide();
    $("#menu li span").click(function() {
        $("#menu ul:visible").slideUp("normal");
        if (($(this).next().is("ul")) && (!$(this).next().is(":visible"))) {
            $(this).next().slideDown("normal");
        }
    });
</script>
<script>
    $(function($) {
        $(".adding_info_add").summernote();
    });
    $(function($) {
        $(".big_description_add").summernote();
    });
</script>
<script>
    $(function($) {
        $(".adding_info").summernote();
    });
    jQuery(function($) {
        $(".big_description").summernote();
    });
</script>
<script>
    $('#edit_product').on("hidden.bs.modal", function() {
        location.reload();
    });
    $('#add_new_product_Modal').on('hide.bs.modal', function () {
        location.reload();
    });
    $('#add_new_product_Modal').on('hidden.bs.modal', function () {
        location.reload();
    });
    $('#add_new_product').click(function(){
        $('#add_new_product_Modal').modal("show");
        $('#submit_form-products-admin-add-product').on('click', function () {
            location.reload();
        });
        $('#submit_form-products-admin-add-product').click(function () {
            location.reload();
        });
        $.urlParam = function(name){
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
            return results[1] || 0;
        }
        var department_id_from_url = $.urlParam('department_id');
        $('form[id="add_form"]').validate({
            rules: {
                file: {
                    required: true
                },
                myselect: { valueNotEquals: "-1"
                },
                name: {
                    required: true
                },
                quantity: {
                    required: true
                },
                quantity_discount:{
                    required: true
                },
                description_popular:{
                    required: true
                },
                description_special_offer:{
                    required: true
                },
            },
            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error');
                $(element).closest('.form-group input[type=file]').addClass('has-error');
                $(element).closest('.form-group select[name=myselect]').addClass('has-error');
                $(element).closest('.input-group ').addClass('has-error');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error');
                $(element).closest('.form-group input[type=file]').removeClass('has-error');
                $(element).closest('.form-group select[name=myselect]').removeClass('has-error');
                $(element).closest('.input-group ').removeClass('has-error');
            }
        });
        $.validator.addMethod("valueNotEquals", function(value, element, arg){
            return arg != value;
        }, "Value must not equal arg.");
        $('#discount_add').change(function() {
            if ($('#discount_add').prop('checked') == true) {
                $('.discount-div')
                .addClass('form-group')
                .append($('<div>')
                    .addClass('discount_input')
                    .append($('<input>')
                        .attr('placeholder', 'Введите скидку')
                        .attr('type', 'number')
                        .addClass('form-control quantity_discount')
                        .attr('name', 'quantity_discount')
                        .attr('min', 1)
                    )
                    .append($('<div>')
                        .append($('<div>')
                            .addClass('input-group date')
                            .attr('id', 'datetimepicker3')
                            .append($('<input>')
                                .attr('type', 'text')
                                .addClass('form-control')
                                .attr('id', 'discount_end_date')
                                .attr('name', 'discount_end_date')
                            )
                            .append($('<span>')
                                .addClass('input-group-addon')
                                .append($('<span>')
                                    .addClass('glyphicon glyphicon-calendar')
                                )
                            )
                        )
                    )
                )
            $('#datetimepicker3').datetimepicker({
                // format: 'DD/MM/YYYY',
                defaultDate: new Date()
            });
        }else{
            $('.discount_input').remove();
            $('.discount-div').css('margin-bottom','-5px');
        }
    });
        $('#promotion_add').change(function() {
            if ($('#promotion_add').prop('checked') == true) {
                $('.promo-div').addClass('form-group').append($('<div>')
                    .addClass('promotion_input')
                    .append($('<select>')
                        .addClass('form-control  description_promotion')
                        .attr('name', 'description_promotion')
                    )
                )
                $.ajax({
                    type:"post",
                    url:"/admin/GetAllPromotions",
                    dataType:"json",
                    success:function(res){
                        $.each(res, function(iy, ely) {
                            var title = ely['title'];
                            var promotion_id = ely['id'];
                            $('.description_promotion').append($('<option>')
                                .text(title)
                                .attr('promotion_id',promotion_id)
                            );

                        });
                    },
                    error:function(){
                    }
                });
                $('#datetimepicker4').datetimepicker({
                    // format: 'DD/MM/YYYY',
                    defaultDate: new Date()
                });
            }else{
                $('.promotion_input').remove();
                $('.promo-div').css('margin-bottom','-5px');
            }
        });
        $('#special_offer_add').click(function(){
            if ($('#special_offer_add').prop('checked') == true) {
                $('.special_offer-div')
                .addClass('form-group')
                    .append($('<div>')
                        .addClass('form-group')
                        .append($('<div>')
                            .addClass('input-group date')
                            .attr('id', 'datetimepicker5')
                            .append($('<input>')
                                .attr('type', 'text')
                                .addClass('form-control')
                                .attr('id', 'special_offer_end_date')
                                .attr('name', 'special_offer_end_date')
                            )
                            .append($('<span>')
                                .addClass('input-group-addon')
                                .append($('<span>')
                                    .addClass('glyphicon glyphicon-calendar')
                                )
                            )
                        )
                    )
                $('#datetimepicker5').datetimepicker({
                    // format: 'DD/MM/YYYY',
                    defaultDate: new Date()
                });
            }else{
                $('.special_offer_input').remove();
                $('.special_offer-div').css('margin-bottom','-5px');
            }
        });
        $('.modal_main_image_block input[type=file]').change(function(e) {
            $.urlParam = function(name){
                var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
                return results[1] || 0;
            }
            var department_id_from_url = $.urlParam('department_id');
            var info = e.target.files;
            var fileName = e.target.files[0].name;
            var fd = new FormData();
            var files = $('#file')[0].files[0];
            fd.append('file',files);
            $.ajax({
                url: "/admin/Upload/?department_id_from_url="+department_id_from_url,
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response != 0) {
                        var photo = response;
                        var t =0;
                    $('#submit_form-products-admin-add-product').click(function () {
                        $('form[id="add_form"]').validate();
                        if ($('form[id="add_form"]').valid()) {
                            if ($('#new_product_add').is(':checked')) {
                                var new_product = '1';
                            } else {
                                var new_product = '0';
                            }
                            if ($('#discount_add').is(':checked')) {
                                var discount = '1';
                                var value_discount = $('.quantity_discount').val();
                                var end_date_discount = $('#datetimepicker3 input#discount_end_date').val();
                            } else {
                                var discount = '0';
                                var value_discount = '0';
                                var end_date_discount = '0';
                            }
                            if ($('#popular_add').is(':checked')) {
                                var popular = '1';
                            } else {
                                var popular = '0';
                            }
                            if ($('#promotion_add').is(':checked')) {
                                var promotion = '1';
                                var value_promotion = $(".description_promotion option:selected").attr('promotion_id');
                            } else {
                                var promotion = '0';
                                var value_promotion = '0';
                                var end_date_promotion = '0';
                            }
                            if ($('#special_offer_add').is(':checked')) {
                                var special_offer = '1';
                                var end_date_special_offer = $('#datetimepicker5 input#special_offer_end_date').val();
                            } else {
                                var special_offer = '0';
                                var end_date_special_offer = '0';
                            }
                            var name = $('.name_add').val();
                            var brand = $('.brand_add').val();
                            var colour = $('.colour_add').val();
                            var price = $('.price_products_add').val();
                            var adding_info = $('.adding_info_add').val();
                            var big_description = $('.big_description_add').val();
                            var quantity = $('.quantity_add').val();
                            var department_id = $('.department_add').attr('department_id');
                            $.ajax({
                                type: "POST",
                                url: "/admin/InsertNewProduct",
                                data: "name=" + name + "&value_discount=" + value_discount + "&end_date_discount=" + end_date_discount + "&value_promotion=" + value_promotion + "&end_date_promotion=" + end_date_promotion + "&end_date_special_offer=" + end_date_special_offer + "&brand=" + brand + "&colour=" + colour + "&big_description=" + big_description + "&adding_info=" + adding_info + "&price=" + price + "&quantity=" + quantity + "&discount=" + discount + "&promotion=" + promotion + "&new_product=" + new_product + "&special_offer=" + special_offer + "&popular=" + popular + "&department_id=" + department_id + "&photo=" + photo,
                                success: function (res) {
                                    if($.trim(res)==1){
                                        location.reload();
                                    }

                                },
                                error: function (res) {
                                }
                            });
                        } else {
                            alert('no valid!');
                        }
                    });
                       // location.reload();
                    $('.preview_small').click(function () {
                        $('#addimage0  input[type="file"]').val('');
                        var iid = $(this).find('img').attr('iid');
                        $(this).remove();
                        $(this).find('img').remove();
                    });
                    t = t + 1;
                    $('.image_modal_add').find('img').attr('src','/application/photo/'+department_id_from_url+'/'+fileName);
                    $('.modal_main_image_block').append($('<div>')
                        .addClass('preview')
                        .css('width', '160px')
                        .css('margin-left', '50px')
                        .css('padding', '10px')
                        .append($('<img>')
                            .attr('src', '/application/photo/'+department_id_from_url+'/' + response)
                            .css('width', '120px')
                            .css('height', '100px')
                        )
                        .append($('<button>')
                            .attr('type', 'button')
                            .css('margin-left', '-10px')
                            .css('margin-top', '-5px')
                            .addClass('close')
                            .attr('aria-label', 'Close')
                            .append($('<span>')
                                .attr('aria-hidden', true)
                                .html('&times;')
                            )
                        )
                    )
                    $('.preview').show();
                    $('.preview').click(function () {
                        $('.small_images').css('display','none');
                        $(this).find('img').remove();
                        $(this).find('button').remove();
                        $('.modal_main_image_block').find('img').attr('src','');
                        // $('.modal_main_image_block input[type="file"]').val('');
                    });
                } else {
                    alert('file not uploaded');
                }
            },
        });
    });
    $('.small_images').on('click','a', function () {
        var rel = $(this).attr("rel");
        $("#addimage" + rel).fadeOut(300, function () {
            $("#addimage" + rel).remove();
            $('#addimage' + (rel )).find('input:file').val('');
            $('.preview_small' + (rel)).find('img').remove();
            $('.preview_small' + (rel)).find('button').remove();
            $('.preview_small' + (rel)).find('hr').remove();
        });
    });

}).on("hidden.bs.modal", function() {
        location.reload();
    });
    $(function () {
        var minPrice = 100,
        maxPrice = 60000,
        $filter_lists = $("#filters ul"),
        $filter_checkboxes = $("#filters :checkbox"),
        $items = $("#computers div.column-admin");
        $filter_checkboxes.click(filterSystem);
        $('#slider-container').slider({
            range: true,
            min: minPrice,
            max: maxPrice,
            values: [minPrice, maxPrice],
            slide: function (event, ui) {
                $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                minPrice = ui.values[0];
                maxPrice = ui.values[1];
                filterSystem();
            }
        });
        $("#amount").val("$" + minPrice + " - $" + maxPrice);
        function filterSlider(elem) {
            var price = parseInt($(elem).data("price"), 10);
            console.log(price);
            return price >= minPrice && price <= maxPrice;
        }
        function filterCheckboxes(elem) {
            var $elem = $(elem),
            passAllFilters = true;
            $filter_lists.each(function () {
                var classes = $(this).find(':checkbox:checked').map(function () {
                    return $(this).val();
                }).get();
                console.log('classes', classes);
                var passThisFilter = false;
                $.each(classes, function (index, item) {
                    if ($elem.hasClass(item)) {
                        console.log('hasClass', item);
                        passThisFilter = true;
                        return false; //stop inner loop
                    }
                });
                if (!passThisFilter) {
                    passAllFilters = false;
                    return false; //stop outer loop
                }
            });
            return passAllFilters;
        }
        function filterSystem() {
            $items.hide().filter(function () {
                return filterSlider(this) && filterCheckboxes(this);
            }).show();
        }
    });
    $( ".column-admin .button-delete" ).each(function(index) {
        $(this).on("click", function(e){
            var iid = $(this).attr('iid');
            var YOUR_MESSAGE_STRING_CONST = "Are you sure to Delete this product?";
            confirmDialog(YOUR_MESSAGE_STRING_CONST, function(){
                $.ajax({
                    type: "POST",
                    url: "/admin/DeleteProduct",
                    data: "iid=" + iid ,
                    success: function (response) {
                        if(response == 1) {
                            $("#flash-msg-deleting-product").show();
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        }
                    },
                    error: function () {
                        alert("Error");
                    }
                });
                console.log("deleted!");
            });
            function confirmDialog(message, onConfirm){
                var fClose = function(){
                    modal.modal("hide");
                };
                var modal = $("#confirmModal");
                modal.modal("show");
                $("#confirmMessage").empty().append(message);
                $("#confirmOk").unbind().one('click', onConfirm).one('click', fClose);
                $("#confirmCancel").unbind().one("click", fClose);
            }
        });
    });
    $(".column-admin .button-edit").each(function(index) {
        $(this).on("click", function() {
            $('#edit_product').modal("show");
            $.urlParam = function(name){
                var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
                return results[1] || 0;
            }
            var department_id_from_url = $.urlParam('department_id');
            var product_iid = $(this).attr('iid');
            $('#datetimepicker6').datetimepicker({
            }).on("dp.change", function (index, element) {
                var end_date = $('#datetimepicker6 input#bday').val();
                $.ajax({
                    type: "POST",
                    url: "/admin/UpdateDiscountEndDateValue",
                    data: "end_date=" + end_date + "&product_id=" + product_iid,
                    success: function (res) {
                    },
                    error: function () {
                        alert("Error");
                    }
                });
            });
            $('#datetimepicker8').datetimepicker({
            }).on("dp.change", function (index, element) {
                var end_date = $('#datetimepicker8 input#bday_special_offer').val();
                $.ajax({
                    type: "POST",
                    url: "/admin/UpdateSpecialOfferEndDateValue",
                    data: "end_date=" + end_date + "&product_id=" + product_iid,
                    success: function (res) {
                    },
                    error: function () {
                        alert("Error");
                    }
                });
            });
            var product_iid = $(this).attr('iid');
            $('.id-modal').val(product_iid);
            var name = $(this).attr('name');
            $('.name_modal_edit').val(name);

            $.ajax({
                type: "POST",
                url: "/admin/GetProductById",
                data: "id=" + product_iid,
                dataType: "json",
                success: function (res) {
                    var workers = JSON.stringify(res);
                    var obj = JSON.parse(workers);
                    $(".adding_div_small_img").remove();
                    var main_img_src =$('.image_modal_edit').find('img').attr('src');
                    if(main_img_src !=''){
                        $('.small_images').css('display','block');
                    }
                    $.each(obj, function(iy, ely) {
                        var id = ely['id'];
                        var name = ely['name'];
                        var brand = ely['brand'];
                        var colour = ely['colour'];
                        var price = ely['price'];
                        var img = ely['photo'];
                        var description = ely['big_description'];
                        var adding_info = ely['adding_info'];
                        var quantity = ely['quantity'];
                        var discount = ely['discount'];
                        var new_product = ely['new_product'];
                        var popular = ely['popular'];
                        var department_id = ely['department_id'];
                        var promotion = ely['promotion'];
                        var special_offer = ely['special_offer'];
                        var res_img = '/application/photo/'+department_id+'/'+img;
                        var value_discount = ely['value_discount'];
                        var end_date = ely['end_date'];
                        var end_date_special_offer = ely['end_date_special_offer'];
                        for(var i in ely['small_images']) {////маленькі фото Галерея вже загружені
                            var small_images = ely['small_images'][i];
                            var res_small_img = $.makeArray(small_images);
                            var small_id = ely['small_id'][i];
                            var res_small_id = $.makeArray(small_id);
                            $(".preview_small").each(function() {
                                $(this).remove();
                            });
                            if ($('.modal_small_images_div' + res_small_id)[0]) {
                            }else{
                                var id_of_this_page_product = $('.id-modal').val();
                                $('.small_images_modal_edit').each(function() {
                                    $(this).attr('id_of_this_product', id_of_this_page_product);
                                    var attr_id_of_this_product = $(this).attr('id_of_this_product');
                                    if (id_of_this_page_product != attr_id_of_this_product) {
                                    } else {
                                        $('.small_images').css('display','block');

                                        $('.small_images_modal_edit')
                                            .append($('<div>')
                                                .addClass('adding_div_small_img')
                                                .css('width','160px')
                                                .append($('<div>')
                                                    .addClass('modal_small_images_div' + res_small_id)
                                                    .css('width', '160px')
                                                    .attr('id_of_this_product', id_of_this_page_product)
                                                    .css('padding', '10px')
                                                    .css('margin-left', '50px')
                                                    .css('margin-bottom', '10px')
                                                    .append($('<img>')
                                                        .attr('src', '/application/photo/small_images/' + department_id_from_url + '/' + res_small_img)
                                                        .addClass('modal_small_images_main')
                                                        .css('width', '120px')
                                                        .attr('iid', res_small_id))
                                                    .append($('<button>')
                                                        .attr('type', 'button')
                                                        .css('margin-left', '-10px')
                                                        .css('margin-top', '-5px')
                                                        .css('opacity', '1')
                                                        .css('color', 'red')
                                                        .css('margin-left', '-15px')
                                                        .addClass('close')
                                                        .attr('sm_img_iid', res_small_id)
                                                        .attr('aria-label', 'Close')
                                                        .append($('<span>')
                                                            .attr('aria-hidden', true)
                                                            .html('&times;')
                                                        )
                                                )
                                            )
                                        )
                                    }
                                });
                                $('.close').click(function (index) {
                                    var iid_sm_img = $(this).attr('sm_img_iid');
                                    $.ajax({
                                        url: "/admin/DeleteSmImgPreview",
                                        type: "POST",
                                        data: "id=" + iid_sm_img,
                                        success: function (res) {
                                        },
                                        error: function () {
                                            alert("Error");
                                        }
                                    });
                                    $('.modal_small_images_div' + iid_sm_img).remove();
                                });
                            }
                        }
                        $('.name_modal_edit').val(name);
                        $('.brand_modal_edit').val(brand);
                        $('.colour_modal_edit').val(colour);
                        $('.price_edit').val(price);
                        $('.big_description').summernote('code',description);
                        $('.adding_info').summernote('code',adding_info);
                        $('.quantity').val(quantity);
                        $('.quantity_discount').val(value_discount);
                        $('#SelectPromotion').val(promotion);
                        $('#bday').val(end_date);
                        $('#bday_special_offer').val(end_date_special_offer);
                        if(discount ==1){
                            $('#discount').prop('checked', true);
                            $('.quantity_discount').attr('disabled', false);
                            $('#bday').prop('disabled',false);
                        }
                        $('.discount_edit').change(function() {
                            if (this.checked) {
                                $('.quantity_discount').attr('disabled', false);
                                $('#bday').attr('disabled', false);
                            } else {
                                $('.quantity_discount').attr('disabled', true);
                                $('#bday').attr('disabled', true);
                            }
                        });
                        if(promotion !=0){
                            $('#promotion').prop('checked', true);
                            $('#SelectPromotion').attr('disabled', false);
                        }
                        $('#promotion').change(function() {
                            if (this.checked) {
                                $('#SelectPromotion').attr('disabled', false);
                            } else {
                                $('#SelectPromotion').attr('disabled', true);
                            }
                        });
                        $('#special_offer').change(function() {
                            if (this.checked) {
                                $('#bday_special_offer').prop('disabled',false);
                            } else {
                                $('#bday_special_offer').prop('disabled',true);
                            }
                        });
                        if(new_product ==1){
                            $('#new_product').prop('checked', true);
                        }
                        if(special_offer ==1){
                            $('#special_offer').prop('checked', true);
                            $('#bday_special_offer').prop('disabled',false);
                        }
                        if(popular ==1){
                            $('#popular').prop('checked', true);
                        }
                        $('.image_modal_edit').find('img').attr('src',res_img);
                        $('.modal_main_image_block input[type="file"]').change(function(e){//маленька картинка до головної
                            var info = e.target.files;
                            var fileName = e.target.files[0].name;
                            var fd = new FormData();
                            var files = e.target.files[0];
                            fd.append('file',files);
                            $.ajax({
                                url: "/admin/Upload/?department_id_from_url="+department_id_from_url,
                                type: 'post',
                                data: fd,
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    if (response != 0) {
                                        $('.image_modal_edit').find('img').attr('src','/application/photo/'+department_id_from_url+'/' + response);
                                        $('.small_images').css('display','block');
                                        $('.preview').remove();
                                        $('.modal_main_image_block')
                                        .append($('<div>')
                                            .addClass('preview')
                                            .css('width','160px')
                                            .css('margin-left','50px')
                                            .css('padding','10px')
                                            .append($('<img>')
                                                .attr('src', '/application/photo/'+department_id_from_url+'/' + response)
                                                .css('width', '120px')
                                                .css('height', '100px')
                                            )
                                            .append($('<button>')
                                                .attr('type', 'button')
                                                .css('margin-left', '-10px')
                                                .css('margin-top', '-5px')
                                                .addClass('close')
                                                .attr('aria-label', 'Close')
                                                .append($('<span>')
                                                    .attr('aria-hidden', true)
                                                    .html('&times;')
                                                )
                                            )
                                        )
                                        $('.preview').show();
                                        $('.preview').click(function () {
                                            $(this).find('img').remove();
                                            $(this).find('button').remove();
                                            $('.modal_main_image_block input[type="file"]').val('');
                                            $('.image_modal_edit').find('img').attr('src','');
                                            $('.small_images').css('display','none');
                                        });
                                        $.ajax({
                                            type: "POST",
                                            url: "/admin/UpdatePhoto",
                                            data: "id=" + product_iid +"&photo=" + response ,
                                            success: function (res) {
                                            },
                                            error: function () {
                                                alert("Error");
                                            }
                                        });
                                    } else {
                                        alert('file not uploaded');
                                    }
                                },
                            });
                        });
                        $('.small_images').each(function() {////маленькы фото щойно добавлены
                            $(this).on('change', 'input',function(e) {
                                var id_of_this_page_product = $('.id-modal').val();
                                var info = e.target.files;
                                var filesLength = info.length;
                                var fd = new FormData();
                                for (var i = 0; i < filesLength; i++) {
                                    var files = info[i];
                                    console.log(files);
                                }
                                fd.append('file', files);
                                $('.addimage').find('input:file').val('');
                                $.ajax({
                                    url: "/admin/UpSmImg/?department_id_from_url="+department_id_from_url,
                                    type: 'post',
                                    data: fd,
                                    contentType: false,
                                    processData: false,
                                    success: function (response_Sm_Img) {
                                        var img_small =  $.trim(response_Sm_Img);
                                        if (img_small !=0) {
                                            $.ajax({
                                                type: "POST",
                                                url: "/admin/InsertSmallPhoto",
                                                data: "product_id=" + id_of_this_page_product +"&photo=" + img_small ,
                                                success: function (res_Inserted_Small_Img) {
                                                    var insertedId_small_img = $.trim(res_Inserted_Small_Img);
                                                    if (insertedId_small_img != 0) {
                                                        $('.modal_small_img_uploads')
                                                        .css('width', '160px')
                                                        .css('padding', '10px')
                                                        .css('margin-left', '50px')
                                                        .append($('<div>')
                                                            .addClass('preview_small')
                                                            .append($('<div>')
                                                                .addClass('preview_small'+insertedId_small_img)
                                                                .append($('<img>')
                                                                    .attr('src', '/application/photo/small_images/' + department_id_from_url + '/' + img_small)
                                                                    .css('width', '120px')
                                                                    .css('height', '100px')
                                                                    .css('margin-bottom', '30px')
                                                                )
                                                                .append($('<button>')
                                                                    .attr('type', 'button')
                                                                    .css('margin-left', '-10px')
                                                                    .css('margin-top', '-5px')
                                                                    .css('color', 'red')
                                                                    .css('opacity', '1')
                                                                    .addClass('close')
                                                                    .attr('sm_img_iid', insertedId_small_img)
                                                                    .attr('aria-label', 'Close')
                                                                    .append($('<span>')
                                                                        .attr('aria-hidden', true)
                                                                        .html('&times;')
                                                                    )
                                                                )
                                                            )
                                                        )
                                                        $('.preview_small').css('display', 'block');
                                                        $('.small_images').css('display', 'block');
                                                        $('.close').click(function () {
                                                            $('#addimage0  input[type="file"]').val('');
                                                            var iid_small_images = $(this).attr('sm_img_iid');
                                                            // alert(iid_small_images);
                                                            $.ajax({
                                                                url: "/admin/DeleteSmImgAdded",
                                                                type: "POST",
                                                                data: "id=" + iid_small_images,
                                                                success: function (res) {
                                                                },
                                                                error: function () {
                                                                    alert("Error");
                                                                }
                                                            });
                                                            // $(this).remove();
                                                            // $(this).find('img').remove();
                                                            // $('.preview_small'+iid_small_images).find('img').remove();
                                                            $('.preview_small'+iid_small_images).remove();
                                                            $('.preview_small').css('margin-top','-25px');
                                                        });
                                                    }
                                                },
                                                error: function () {
                                                    alert("Error");
                                                }
                                            });

                                        } else {
                                            alert('file not uploaded');
                                        }
                                    },
                                });
                            });///close
                        });
                    });
                    $('#submit_form_edit').click(function(){
                        if ($('#new_product').is(':checked')) {
                            var new_product = '1';
                        } else {
                            var new_product = '0';
                        }
                        if($('#discount').is(':checked')) {
                            var discount = '1';
                            var value_discount = $('.quantity_discount').val();
                            var end_date_discount = $('#datetimepicker3 input#discount_end_date').val();
                        }else{
                            var discount = '0';
                            var value_discount = '0';
                            var end_date_discount = '0';
                        }
                        if ($('#popular').is(':checked')) {
                            var popular = '1';
                        } else {
                            var popular = '0';
                        }
                        if ($('#special_offer').is(':checked')) {
                            var special_offer = '1';
                            var value_special_offer = $('.description_special_offer').val();
                            var end_date_special_offer = $('#datetimepicker5 input#special_offer_end_date').val();
                        } else {
                            var special_offer = '0';
                            var value_special_offer = '0';
                            var end_date_special_offer = '0';
                        }
                        if ($('#promotion').is(':checked')) {
                            var promotion = $("#SelectPromotion option:selected").attr('promotion_id');
                        } else {
                            var promotion = '0';
                        }
                        var id = $('.id-modal').val();
                        var name = $('.name_modal_edit').val();
                        var brand = $('.brand_modal_edit').val();
                        var colour = $('.colour_modal_edit').val();
                        var price = $('.price_edit').val();
                        var big_description = $('.big_description').val();
                        var adding_info = $('.adding_info').val();
                        var quantity = $('.quantity').val();
                        var promotion_id = $('#SelectPromotion').find(":selected").text();
                        $.ajax({
                            type: "POST",
                            url: "/admin/UpdateProduct",
                            data: "name="+name+"&value_discount="+value_discount+"&end_date_discount="+end_date_discount+"&value_special_offer="+value_special_offer+"&end_date_special_offer="+end_date_special_offer+"&brand="+brand+"&colour="+colour+"&price="+price+"&big_description="+big_description+"&adding_info="+adding_info+"&quantity="+quantity + "&iid=" + product_iid + "&discount=" + discount + "&new_product=" + new_product + "&special_offer="+ special_offer + "&popular=" + popular+"&promotion="+promotion,
                            success: function (res) {
                                if($.trim(res==1)){
                                    $("#flash-msg-edition-product").show();
                                    setTimeout(function () {
                                        location.reload();
                                    }, 2000);
                                }
                            },
                            error: function () {
                                // alert("Error");
                            }
                        });
                    });
                },
                error: function () {
                    // alert("Error");
                }
            });
            $('.small_images').on('click','a', function () {
                var rel = $(this).attr("rel");
                $("#addimage" + rel).fadeOut(300, function () {
                    $("#addimage" + rel).remove();
                    $('#addimage' + (rel )).find('input:file').val('');
                    $('.preview_small' + (rel)).find('img').remove();
                    $('.preview_small' + (rel)).find('button').remove();
                    $('.preview_small' + (rel)).find('hr').remove();
                });
            });
            $('.quantity_discount').change(function(){
                var value_discount = $('.quantity_discount').val();
                $.ajax({
                    type: "POST",
                    url: "/admin/UpdateDiscountValue",
                    data: "value_discount=" + value_discount + "&product_id=" + product_iid,
                    success: function (res) {
                    },
                    error: function () {
                        alert("Error");
                    }
                });
            });
        });
    });
</script>

