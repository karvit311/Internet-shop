<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$_SESSION['urlpage'] = "<a href='/admin/index'>Заказы</a>";?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>New products</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <style>
        .order-number{
            font: 14px sans-serif;
            margin-left: 10px;
            color: black;
            margin-top: 5px;
            margin-bottom: 10px;
        }
        .order-datetime{
            font: 14px sans-serif;
            margin-left: 10px;
            color: #767676;
            margin-top: 10px;
            margin-bottom: 0px;
        }
        .block-order{
            border-bottom: 1px solid #E0E0E0;
            min-height: 40px;
            height: auto;
        }
        .order-link{
            font: 14px sans-serif;
            position: absolute;
            margin-left: 580px;
            margin-top: -36px;
        }
        .order-link > a.green{
            font:bold 13px sans-serif;
            color: green;
        }
        .order-link > a:hover{
            text-decoration: none;
        }
        .green{
            font:bold 13px sans-serif;
            color: green;
        }
        .red{
            font:bold 13px sans-serif;
            color: #D6533C;
        }
        #review-info-count li{
            float: left;
            margin-left: 10px;
            font: 14px sans-serif;
            margin-top: 12px;
        }
        #block-info{
            height: 40px;
            border-bottom: 1px solid #E0E0E0;
        }
        #list-links-sort{
            background-color: white;
            border: 1px solid #A3C0D2;
            position: absolute;
            display: none;
            width: 200px;
            padding-top: 5px;
            padding-bottom: 7px;
            height: auto;
            z-index: 1;
        }
        #list-links-sort  li{
            margin-top: 3px;
            margin-left: 10px;
        }
        #list-links-sort  a{
            font: 15px sans-serif;
            text-decoration: none;
            color: black;
        }
        #list-links-sort a:hover{
            text-decoration: underline;
        }
        #options-list > li{
            float: left;
            margin-left: 20px;
            margin-top:3px;
            font: 14px sans-serif;
        }
        #options-list img{
            margin-top: -4px;
            cursor: pointer;
        }
        #options-list {
            margin-left: -10px;
        }
        #options-list-admin > li{
            float: left;
            margin-left: 10px;
            font: 14px sans-serif;
            margin-top: 13px;
        }
        #options-list-admin > li > a{
            color: #748996;
        }
        #block-parameters{
            height: 40px;
            border-bottom: 1px solid #E0E0E0;
            background-color: #F2F2F2;
        }
        #block-content-admin{
            width: 747px;
            min-height: 650px;
            height: auto;
            margin-left: 201px;
            border-left: 1px solid #E0E0E0;
        }
        #block-body-admin{
            width: 950px;
            margin: 5px auto;
            background-color: white;
            border: 1px solid #E0E0E0;
        }
    </style>
    <body>
        <div class="container">
            <div class="row">
                <?php
                if(isset($_GET["sort"])){
                    $sort = $_GET["sort"];
                    switch ($sort) {
                        case 'all-orders':
                            $sort_orders = new \Application\models\Orders();
                            $result = $sort_orders->get_orders_sort_desc();
                            $count_all_orders = new \Application\models\Orders();
                            $res_count_result = $count_all_orders->count_all_orders();
                            foreach($res_count_result as $res_count_all_order){
                                $res_count = $res_count_all_order['total'];
                            }
                            $sort_name = 'От А до Я';
                        break;
                        case 'confirmed':
                            $get_confirmed_orders = new \Application\models\Orders();
                            $result = $get_confirmed_orders->get_confirmed_orders();
                            $count_confirmed_orders = new \Application\models\Orders();
                            $res_count_result = $count_confirmed_orders->count_confirmed_orders();
                            foreach($res_count_result as $res_count_confirmed_order){
                                $res_count = $res_count_confirmed_order['total'];
                            }
                            $sort_name = 'Обработаные';
                        break;
                        case 'no-confirmed':
                            $get_no_confirmed_orders = new \Application\models\Orders();
                            $result = $get_no_confirmed_orders->get_no_confirmed_orders();
                            $count_no_confirmed_orders = new \Application\models\Orders();
                            $res_count_result = $count_no_confirmed_orders->count_no_confirmed_orders();
                            foreach($res_count_result as $res_count_no_confirmed_order){
                                $res_count = $res_count_no_confirmed_order['total'];
                            }
                            $sort_name = 'Не обработанные';
                        break;
                        default:
                            $sort_orders = new \Application\models\Orders();
                            $result = $sort_orders->get_orders_sort_desc();
                            $count_all_orders = new \Application\models\Orders();
                            $res_count_result = $count_all_orders->count_all_orders();
                            foreach($res_count_result as $res_count_all_order){
                                $res_count = $res_count_all_order['total'];
                            }
                            $sort_name = 'От А до Я';
                        break;
                    }
                }else {
                    $sort_orders = new \Application\models\Orders();
                    $result = $sort_orders->get_orders_sort_desc();
                    $count_all_orders = new \Application\models\Orders();
                    $res_count_result = $count_all_orders->count_all_orders();
                    foreach($res_count_result as $res_count_all_order){
                        $res_count = $res_count_all_order['total'];
                    }
                    $sort_name = 'От А до Я';
                }
                $count_all_orders = new \Application\models\Orders();
                $res_count_all_orders = $count_all_orders->count_all_orders();
                foreach($res_count_all_orders as $res_count_all_order){
                    $res_count = $res_count_all_order['total'];
                }
                $count_confirmed_orders = new \Application\models\Orders();
                $res_count_confirmed_orders = $count_confirmed_orders->count_confirmed_orders();
                foreach($res_count_confirmed_orders as $res_count_confirmed_order){
                    $res_count = $res_count_confirmed_order['total'];
                }
                $count_no_confirmed_orders = new \Application\models\Orders();
                $res_count_no_confirmed_orders = $count_no_confirmed_orders->count_no_confirmed_orders();
                foreach($res_count_no_confirmed_orders as $res_count_no_confirmed_order){
                    $res_count = $res_count_no_confirmed_order['total'];
                }
                ?>
                <div class="body-admin">
                    <div id="block-body-admin">
                        <?php
                            include("block-header.php");
                        ?>
                        <div id="block-content-admin">
                            <?php
                            if($_SESSION['admin'] = "admin")
                            {
                                if(isset($_GET['logout']))
                                {
                                    unset($_SESSION['auth_admin']);
                                    return $this->redirect('/user/login');
                                }
                                if($_SESSION['admin_role'] == 'admin-order' || $_SESSION['admin_role'] == 'admin'){?>
                                    <div id="block-parameters">
                                        <ul id="options-list">
                                            <li>Сортировать</li>
                                            <li><a id="select-links" href="#"><?= $sort_name; ?></a>
                                                <ul id="list-links-sort">
                                                    <li><a href="/admin/Orders/?sort=all-orders">От А до Я</a></li>
                                                    <li><a href="/admin/Orders/?sort=confirmed">Обработанные</a></li>
                                                    <li><a href="/admin/Orders/?sort=no-confirmed">Не обработанные</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                    <div id="block-info">
                                        <ul id="review-info-count">
                                            <li>Всего заказов - <strong><?= $res_count_all_order['total']; ?></strong></li>
                                            <li>Обработаных - <strong><?= $res_count_confirmed_order['total']; ?></strong></li>
                                            <li>Не обработанных - <strong><?= $res_count_no_confirmed_order['total']; ?></strong></li>
                                        </ul>
                                    </div>
                                    <?php
                                    if ($res_count > 0)
                                    {
                                        foreach ($result as $key => $row) {
                                            if ($row["order_confirmed"] == 'yes')
                                            {
                                                $status = '<span class="green">Обработан</span>';
                                            } else{
                                                $status = '<span class="red">Не обработан</span>';
                                            }
                                            echo '
                                                <div class="block-order">
                                                 
                                                <p class="order-datetime" >'.$row["datetime"].'</p>
                                                <p class="order-number" >Заказ ¹ '.$row["id"].' - '.$status.'</p>
                                                <p class="order-link" ><a class="green" href="/admin/viewOrder/?id='.$row["id"].'" >Подробнее</a></p>
                                                </div>
                                                ';
                                        }
                                    }?>
                                <?php
                                }else{?>
                                    <!-- ERROR PRIVILEGE-->
                                    <div class="alert alert-danger  alert-dismissable error-privilege"  id="flash-msg-privilege-orders">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        <h4><i class="icon fa fa-check"></i>ERROR!</h4><p>У Вас нет прав на редактирование заказов!</p>
                                    </div>
                                <?php
                                }
                            } else {
                                header('Location: /main/Login');
                            }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    $(document).ready(function() {
        $('#select-links').click(function () {
            $("#list-links-sort").slideToggle(200);
        });
    });
</script>

