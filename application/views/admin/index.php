<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Панель управления</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <style type="text/css">
        #aza1 td {
            width: 30%;
        }
        #aza1{
            margin-left:20px;
        }
    </style>
    <body style="background-color: #F2F4F9;" >
        <div class="container">
            <div class="row">
                <?php
                if($_SESSION['name'] = "admin")
                {
                if (isset($_SESSION['admin_role'])) {
                    $_SESSION['urlpage'] = "<a href='/site/index'>Главная</a>";
                    ?>
                    <div class="body-admin">
                        <div id="block-body-admin">
                            <?php
                                include("block-header.php");
                            ?>
                            <div id="block-content-admin">
                                <div id="block-parameters">
                                    <p id="title-page">Общая статистика</p>
                                </div>
                                <?php
                                $count_all_orders = new \Application\models\Orders();
                                $res_count_all_orders = $count_all_orders->count_all_orders();
                                foreach($res_count_all_orders as $res_count_all_order){
                                    $count_all_orders = $res_count_all_order['total'];
                                }
                                $count_all_products = new \Application\models\Product();
                                $res_count_all_products = $count_all_products->count_all_products();
                                foreach($res_count_all_products as $res_count_all_product){
                                    $count_all_products = $res_count_all_product['total'];
                                }
                                $count_all_reviews = new \Application\models\Review();
                                $res_count_all_reviews = $count_all_reviews->count_all_reviews();
                                foreach($res_count_all_reviews as $res_count_all_review){
                                    $count_all_reviews = $res_count_all_review['total'];
                                }
                                $count_all_users = new \Application\models\Users();
                                $res_count_all_users = $count_all_users->count_all_users();
                                foreach($res_count_all_users as $res_count_all_user){
                                    $count_all_users = $res_count_all_user['total'];
                                }
                                ?>
                                <ul id="general-statistics">
                                    <li><p>Всего заказов - <span><?= $count_all_orders; ?></span></p></li>
                                    <li><p>Товаров - <span><?= $count_all_products; ?></span></p></li>
                                    <li><p>Отзывы - <span><?= $count_all_reviews; ?></span></p></li>
                                    <li><p>Клиенты - <span><?= $count_all_users; ?></span></p></li>
                                </ul>
                                <h3 id="title-statistics">Статистика продаж</h3>
                                <table id="aza1" width="95%">
                                    <tr>
                                        <th>Дата</th>
                                        <th>Товар</th>
                                        <th style="width: 50px;">Цена</th>
                                        <th>Статус</th>
                                    </tr>
                                    <?php
                                    if ($count_all_orders > 0) {
                                        $all_orders = new \Application\models\Orders();
                                        $res_all_orders = $all_orders->get_all_orders();
                                        foreach ($res_all_orders as $res_all_order) {
                                            if ($res_all_order["payed"] == '1') {
                                                $statuspay = "Оплачено";
                                            } else {
                                                $statuspay = "Не оплачено";
                                            }
                                            echo '
                                                <tr>
                                                <td  align="CENTER" >' . $res_all_order["datetime"] . '</td>
                                                <td   >' . $res_all_order["name"] . '</td>
                                                <td  align="CENTER" >' . $res_all_order["price"] . '</td>
                                                <td  align="CENTER" >' . $statuspay . '</td>
                                                </tr>
                                                ';
                                        }
                                    }?>
                                </table>
                                <?php }else{ ?>
                                <script type="text/javascript">
                                    window.location.href = '/main/Login';
                                </script>
                                <?php }
                            }else{
                                return $this->redirect('/user/login');
                            }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

