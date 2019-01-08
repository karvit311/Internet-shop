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
                                                    <?php
                                                } ?><br>
                                                <?php
                                                if ($res_product['popular'] == '1') {
                                                    ?>
                                                    <div data-description="Топ продаж"
                                                         class="button button-top">Топ продаж
                                                    </div>
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
                    ?>
                    </div>
                <?php
                    echo $pagination;
                ?>
            </div>
        <?php }?>
    </body>
</html>
<script src="/application/js/admin-products.js"></script>

