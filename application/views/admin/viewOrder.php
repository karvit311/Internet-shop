<?php
if ($_SESSION['name'] = "admin")
{
    if (isset($_GET["logout"]))
    {
        unset($_SESSION['auth_admin']);
        return $this->redirect('/user/login');
    }
    $_SESSION['urlpage'] = "<a href='/admin/admin/index' >Главная</a> \ <a href='/admin/admin/orders' >Просмотр заказов</a>";?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
        <head>
            <meta http-equiv="content-type" content="text/html; charset=utf-8" />
            <title>Панель управления - Просмотр заказов</title>
        </head>
        <style>
            .green:hover,:active{
                cursor:pointer;
                color:green;
            }
            .delete:hover,:active{
                cursor:pointer;
                color:red;
            }
        </style>
        <body>
            <div id="block-body-admin">
                <?php
                    include("block-header.php");
                ?>
                <div id="block-content-admin">
                    <div id="block-parameters">
                        <p id="title-page" >Просмотр заказа</p>
                    </div>
                    <!-- Acception SUCCESS-->
                    <div class="alert alert-success accept-review alert-dismissable" style="display: none;" id="flash-msg-accept-order">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <h4><i class="icon fa fa-check"></i>Success!</h4><p>Order've  successfully accepted!</p>
                    </div>
                    <!-- DELETING SUCCESS-->
                    <div class="alert alert-success deleting_review alert-dismissable" style="display: none;" id="flash-msg-deleting-order">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <h4><i class="icon fa fa-check"></i>Success!</h4><p>Order've  successfully deleted!</p>
                    </div>
                    <?php
                    $id = $_GET['id'];
                    $get_one_order = new \Application\models\Orders();
                    $res_get_one_orders = $get_one_order->get_order_by_order_id($id);
                    $res_get_one_orders->execute(array($id));
                    foreach($res_get_one_orders as $res_get_one_order){
                        $result_count = $res_get_one_order['total'];
                    }
                    if ($result_count > 0)
                    {
                        $get_one_order = new \Application\models\Orders();
                        $res_get_one_orders = $get_one_order->get_order_by_order_id($id);
                        $res_get_one_orders->execute(array($id));
                        foreach ($res_get_one_orders as $key => $row) {
                            if ($row['order_confirmed'] == 'yes')
                            {
                                $status = '<span class="green">Обработан</span>';
                            } else{
                                $status = '<span class="red">Не обработан</span>';
                            }
                            ?>
                            <p class="view-order-link" ><a class="green" href="#" order_id="<?= $row["id"]?>">Подтвердить заказ</a> | <a class="delete" order_id="<?= $row["id"]?>" href="#" >Удалить заказ</a></p>
                            <p class="order-datetime" ><?=$row["datetime"]?></p>
                            <p class="order-number" >Заказ ¹ <?= $row["id"]?> - <?= $status?></p>
                            <table align="center" CELLPADDING="10" WIDTH="100%">
                            <tr>
                            <th>¹</th>
                            <th>Наименование товара</th>
                            <th>Цена</th>
                            <th>Количество</th>
                            </tr>
                             <?php
                            $get_one_order_and_product = new \Application\models\Orders();
                            $res_get_one_orders_and_products = $get_one_order_and_product->get_order_and_product_by_order_id($id);
                            $res_get_one_orders_and_products->execute(array($id));
                            foreach ($res_get_one_orders_and_products as $key => $result_query) {
                                $price = 0;
                                $index_count = 0;
                                $price = $price + ($result_query["priceOrder"] * $result_query["quantity"]);
                                $index_count =  $index_count + 1;
                                echo '
                                    <tr>
                                    <td  align="CENTER" >'.$index_count.'</td>
                                    <td  align="CENTER" >'.$result_query["name"].'</td>
                                    <td  align="CENTER" >'.$result_query["priceOrder"].' руб</td>
                                    <td  align="CENTER" >'.$result_query["quantity"].'</td>
                                    </tr>
                                ';
                            }
                            if ($row["order_pay"] == "accepted")
                            {
                                $statpay = '<span class="green">Оплачено</span>';
                            }else{
                                $statpay = '<span class="red">Не оплачено</span>';
                            }
                            echo '
                                </table>
                                <ul id="info-order-admin">
                                <li>Общая цена - <span>'.$price.'</span>  руб</li>
                                <li>Способ доставки - <span>'.$row["order_delivery"].'</span></li>
                                <li>Статус оплаты - '.$statpay.'</li>
                                <li>Тип оплаты - <span>'.$row["order_type_pay"].'</span></li>
                                <li>Дата оплаты - <span>'.$row["datetime"].'</span></li>
                                </ul>
                                <table align="center" CELLPADDING="10" WIDTH="100%">
                                <tr>
                                <th>ФИО</th>
                                <th>Адрес</th>
                                <th>Контакты</th>
                                <th>Примечание</th>
                                </tr>

                                <tr class="res_view_order">
                                <td  align="center"  >'.$row["order_fio"].'</td>
                                <td  align="CENTER" >'.$row["order_address"].'</td>
                                <td  align="CENTER" >'.$row["order_phone"].'</br>'.$row["order_email"].'</td>
                                <td  align="CENTER" >'.$row["order_note"].'</td>
                                </tr>
                                </table>
                            ';
                        }
                    } ?>
                </div>
            </div>
        </body>
    </html>
    <?php
}else{
    return $this->redirect('/user/login');
}
?>
<script>
    $('.view-order-link .green').click(function(){
        alert('jkj');
        var order_id = $(this).attr('order_id');
        $.ajax({
            type:"post",
            url:"/admin/acceptOrderAdmin",
            data:"order_id="+order_id,
            success:function(response){
                alert(response);
                if($.trim(response) == 1) {
                    $("#flash-msg-accept-order").show();
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
            },
            error:function(){

            }
        })
    });
    $('.view-order-link .delete').click(function(){
        var order_id = $(this).attr('order_id');
        $.ajax({
            type:"post",
            url:"/admin/deleteOrderAdmin",
            data:"order_id="+order_id,
            success:function(response){
                if($.trim(response) == 1) {
                    $("#flash-msg-deleting-order").show();
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
            },
            error:function(){

            }
        })
    });

</script>
