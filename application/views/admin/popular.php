<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Popular products</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php
        $products_pagination = new \Application\models\Product();
        $res_products_pagination = $products_pagination->get_total_by_popular();
        foreach($res_products_pagination as $res_product_pagination) {
            $total = $res_product_pagination['total'];
            $adjacents = 3;
            $page = $_GET['page'];
            $targetpage = "/admin/Popular/?"; //your file name
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
            //$today = date("Y-m-d");
            $products = new \Application\models\Product();
            $res_products = $products->get_products_by_popular($limit,$start);
            $res_products->execute();
            include("pagination.php"); ?>
            <div class="container">
                <div class="row">
                    <div id="breadcrumbs-products">
                        <ul>
                            <li><a class="btn btn-default come_back" href="/admin/index"  role="button"><span class="glyphicon glyphicon-arrow-left"></span>  Вернуться</a></li>
                            <li><a class="btn btn-light"  href="/admin/about" role="button">AllPAN</a></li>
                            <li class="greater-sign"> ></li>
                            <li> <a class="btn btn-light "  href="#" role="button">Popular Products </a></li>
                        </ul>
                    </div>
                    <?php
                    if ($_SESSION['admin'] = "admin") {
                        if (isset($_SESSION['admin_role'])) {
                            if ($_SESSION['admin_role'] == 'admin-product' || $_SESSION['admin_role'] == 'admin') {?>
                                <!-- DELETING SUCCESS-->
                                <div class="alert alert-success deleting_product alert-dismissable" style="display: none;" id="flash-msg-deleting-product">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    <h4><i class="icon fa fa-check"></i>Success!</h4><p>Product've  successfully deleted!</p>
                                </div>
                                <div id="computers">
                                    <?php foreach ($res_products as $res_product){?>
                                        <div class="column-admin <?= $res_product['brand'];?> <?= $res_product['colour'];?>" data-price="<?= $res_product['price']; ?>"  price="<?= $res_product['price']?>" >
                                            <div class="column-div">
                                                <div data-description="Топ продаж" class="button button-top">Топ продаж</div>
                                                <?php if($res_product['special_offer'] == '1' && $res_product['popular'] == '1'){?>
                                                    <div data-description="2 в 1" class="button button-2in1">2 в 1</div>
                                                <?php }?>
                                                <?php if($res_product['discount'] == '1'){
                                                    $about_discount = new \Application\models\Product();
                                                    $res_about_discount = $about_discount->get_discount_by_special_offer_and_discount();
                                                    foreach($res_about_discount as $res_ab_discount){
                                                        if ($res_ab_discount['id'] == $res_product['id']) { ?>
                                                            <div data-description="Скидка - <?= $res_ab_discount['value_discount'] . '%'; ?>"
                                                                 class="button button-discount"><?= $res_ab_discount['value_discount'] . '%'; ?></div>
                                                            <?php
                                                        }
                                                    }
                                                }?>
                                                <?php if($res_product['new_product'] == '1' && $res_product['popular'] == '1'){?>
                                                    <div data-description="Новинка" class="button button-new">Новинка</div>
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
                                                        <p class="name_main_product"><?= $res_product['name'];?></p>
                                                    </li>
                                                    <li>
                                                        <p class="price_products" price="<?= $res_product['price']?>"><?= $res_product['price'].' грн';?></p>
                                                    </li>
                                                </ul>
                                            </div>
                                            <button type="submit" iid="<?= $res_product['id']?>" price="<?= $res_product['price']?>" name="<?= $res_product['name']?>" class="btn-default button-edit">Edit</button>
                                            <button type="submit" iid="<?= $res_product['id']?>" price="<?= $res_product['price']?>" name="<?= $res_product['name']?>"  class="btn-danger button-delete">Delete</button>
                                        </div>
                                    <?php }?>
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
                                <div id="edit_product"  class="modal">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h3 class="modal-title">Edition popular product!</h3>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                                                            <div >
                                                                <input type="file" id="file" name="file"/>
                                                            </div>
                                                        </div>
                                                        <div class="small_images">
                                                            <h4>SMALL IMAGES</h4>
                                                            <div class="small_images_modal_edit">
                                                            </div>
                                                            <div class="modal_small_img_uploads">
                                                            </div>
                                                            <label class="stylelabel">Галлерея картинок</label>
                                                            <div id="objects">
                                                                <div id="addimage0" class="addimage">
                                                                    <input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
                                                                    <input type="file" class="file" name="file[]" multiple/>
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
                                                                    <input type="text" class="form-control id-modal" name="id" disabled>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Name</span>
                                                                    </div>
                                                                    <input type="text" class="form-control name_modal_edit" name="name">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Brand</span>
                                                                    </div>
                                                                    <input type="text" class="form-control brand_modal_edit" name="brand">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Colour</span>
                                                                    </div>
                                                                    <input type="text" class="form-control colour_modal_edit" name="colour">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Price</span>
                                                                    </div>
                                                                    <input type="text" class="form-control price_edit" name="price">
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Description</span>
                                                                    </div>
                                                                    <textarea class="form-control big_description" cols="54" name="big_description" ></textarea>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Adding info</span>
                                                                    </div>
                                                                    <textarea  class="form-control adding_info" cols="54" name="adding_info"></textarea>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Quantity</span>
                                                                    </div>
                                                                    <input type="number" class="form-control quantity" name="quantity" min="1"/>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="input-group" id="checkboxes">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Discount</span>
                                                                    </div>
                                                                    <input id="discount" class="discount_edit" type="checkbox" name="discount" value="1"  />
                                                                    <div class="discount_input">
                                                                        <input type="number" placeholder="Введите скидку" class="form-control quantity_discount" disabled  min="1"><br><br>
                                                                        <div class='input-group date' id='datetimepicker6'>
                                                                            <input type='text' class="form-control" id="bday"  disabled name="bday"/>
                                                                            <span class="input-group-addon">
                                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Promotion</span>
                                                                    </div>
                                                                    <input id="popular" type="checkbox" name="promotion"  value="1" />
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Popular</span>
                                                                    </div>
                                                                    <input id="popular" type="checkbox" name="popular"  value="1" />
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">New</span>
                                                                    </div>
                                                                    <input id="new_product" type="checkbox" name="new_product"  value="1" />
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Special Offer</span>
                                                                    </div>
                                                                    <input id="special_offer" type="checkbox" name="special_offer"  value="1" />
                                                                    <div class="special_offer_input">
                                                                        <textarea  placeholder="Опишите акцию" class="form-control description_special_offer" disabled ></textarea><br><br>
                                                                        <div class='input-group date' id='datetimepicker8' >
                                                                            <input type='text' class="form-control" id="bday_special_offer" disabled name="bday"/>
                                                                            <span class="input-group-addon">
                                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <p><input type="submit" id="submit_form_edit" name="submit_add" value="Сохранить товар"/></p>
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
<script src="/application/js/admin.js"></script>
