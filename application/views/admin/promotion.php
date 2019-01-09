<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Promotion</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php
        $products_pagination = new \Application\models\Promotion();
        $res_products_pagination = $products_pagination->get_total_by_promotion();
        foreach($res_products_pagination as $res_product_pagination) {
            $total = $res_product_pagination['total'];
            $adjacents = 3;
            $page = $_GET['page'];
            $targetpage = "/admin/Promotion/?"; //your file name
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
            $today = date("Y-m-d");
            $products = new \Application\models\Promotion();
            $res_promotions = $products->get_promotions_actual($today,$limit,$start);
            $res_promotions->execute();
            include("pagination.php"); ?>
            <div class="container">
                <div class="row">
                    <div id="breadcrumbs-products">
                        <ul>
                            <li><a class="btn btn-default come_back"  href="/main/menu" role="button"><span class="glyphicon glyphicon-arrow-left"></span>  Вернуться</a></li>
                            <li><a class="btn btn-light" href="/main/about" role="button">AllPAN</a></li>
                            <li class="greater-sign"> ></li>
                            <li> <a class="btn btn-light " href="#" role="button">Promotion </a></li>
                        </ul>
                    </div>
                    <?php
                    if ($_SESSION['admin'] = "admin") {
                        if (isset($_SESSION['admin_role'])) {
                            if ($_SESSION['admin_role'] == 'admin-product' || $_SESSION['admin_role'] == 'admin') {?>
                                <!-- DELETING SUCCESS-->
                                <div class="alert alert-success deleting_product alert-dismissable" style="display: none;" id="flash-msg-deleting-promotion">
                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                    <h4><i class="icon fa fa-check"></i>Success!</h4><p>Promotion've  successfully deleted!</p>
                                </div>
                                <div id="all_promotion" >
                                    <?php foreach ($res_promotions as $res_promotion){
                                        $date = date_create($res_promotion['end_date']);
                                        $end_date =  date_format($date,'d F');
                                       ?>
                                        <div class="pre_promotion">
                                            <button class="btn-warning pre_promotion_edit" iid="<?= $res_promotion['id']; ?>" >Редактировать</button >
                                            <button  iid="<?= $res_promotion['id']; ?>"  class="btn-danger pre_promotion_delete">Удалить</button>
                                        </div>
                                        <div class="promotion">
                                            <?php if($res_promotion['type'] == 'Максимальная скидка' || $res_promotion['type'] == 'Только у нас'){?>
                                            <div class="left_block"><?= $res_promotion['left_block'];?></div>
                                            <?php }else{?>
                                            <div class="left_block_img"><img src="/application/photo/icons/<?= $res_promotion['left_block'];?>" width="100px" height="100px"></div>
                                            <?php }?>
                                            <div class="main_body">
                                                <button class="btn btn-success main_body_button"><?= $res_promotion['type'];?></button>
                                                <p class="main_body_title"><?= $res_promotion['title'];?></p>
                                                <p class="main_body_essence"><?= $res_promotion['value_promotion']; ?></p>
                                            </div>
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
                                <div id="edit_promotion"  class="modal" >
                                    <div class="modal-dialog ">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h3 class="modal-title">Edition of promotion</h3>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <!-- Modal body -->
                                            <form method="post" id="save_form" enctype="multipart/form-data" class="feedback">
                                                <div class="modal-body edit_modal">
                                                    <div class="info_for_phone_modal">
                                                        <ul>
                                                            <li>
                                                                <div class="input-group admin-edit-modal-promotion-id">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">ID</span>
                                                                    </div>
                                                                    <input type="text" class="form-control id" name="id" disabled>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="input-group admin-edit-modal-promotion-essence-of-promotion">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Essence of promotion</span>
                                                                    </div>
                                                                    <textarea placeholder="Опишите промо-акцию" name="description_promotion" class="form-control description_promotion"></textarea><br><br>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="input-group admin-edit-modal-promotion-short-description-promotion">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Short description of promotion</span>
                                                                    </div>
                                                                    <input  placeholder="Кратко опишите промо-акцию" name="short_description_promotion" class="form-control short_description_promotion"/>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="input-group admin-edit-modal-promotion-title-promotion">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Title</span>
                                                                    </div>
                                                                    <input  placeholder="Напишите заглавие" name="title_promotion" class="form-control title_promotion"/>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="input-group admin-edit-modal-promotion-type-promotion">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text">Type</span>
                                                                    </div>
                                                                    <input  placeholder="Напишите тип" name="type_promotion" class="form-control type_promotion"/>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div class="input-group admin-edit-modal-promotion-datetimepicker7">
                                                                <div class='input-group date' id='datetimepicker7'>
                                                                    <input type='text' class="form-control" id="datepicker_promotion" name="datepicker_promotion"/>
                                                                    <span class="input-group-addon">
                                                                        <span class="glyphicon glyphicon-calendar"></span>
                                                                    </span>
                                                                </div>
                                                                </div>
                                                            </li>
                                                            <li class="select_department_id_admin_modal">
                                                                <div class="input-group">
                                                                    <label for="SelectDepartment">Выбрать раздел товара:</label>
                                                                    <?php $departments = new \Application\models\Department();
                                                                    $res_departments = $departments->get_departments();?>
                                                                    <select class="form-group" id="SelectDepartment" name="myselect" >
                                                                        <option selected value="-1">Все отделы</option>
                                                                        <?php foreach ($res_departments as $res_department){?>
                                                                            <option id="department_select_modal" name="department_select_modal" value="<?= $res_department['id']; ?>" department_id="<?= $res_department['id']; ?>"><?= $res_department['department'];?></option>
                                                                        <?php }?>
                                                                    </select>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <div class="place_to_append_small_products"></div>
                                                    </div>
                                                    <p><input type="submit" id="submit_form_admin_promotion_edit" name="submit_add" value="Сохранить товар"/></p>
                                                </div>
                                            </form>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                            </div>
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
<script src="/application/js/promotion-admin.js"></script>

