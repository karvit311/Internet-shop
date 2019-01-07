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
    <div class="container">
        <div class="row">
            <!-- DELETING SUCCESS-->
            <div class="alert alert-success deleting_order alert-dismissable" style="display: none;" id="flash-msg-deleting-order">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h4><i class="icon fa fa-check"></i>Success!</h4><p>Order've  successfully deleted!</p>
            </div>
            <?php  $ip_address = $_GET['ip_address']; ?>
            <?php  $action = $_GET['action'];


            switch($action) {
                case 'oneclick':?>
                    <div class="product-view-tabs">
                        <ul class="nav nav-pills">
                            <li class="active"><a  href="/main/cart/?ip_address=<?= $ip_address;?>&action=oneclick">Шаг 1</a></li>
                            <li class="no-active"><a  href="/main/cart/?ip_address=<?= $ip_address;?>&action=confirm">Шаг 2</a></li>
                            <li class="no-active"><a  href="/main/cart/?ip_address=<?= $ip_address;?>&action=completion">Шаг 3</a></li>
                        </ul>
                        <div class="tab-content-cart">
                            <div id="step1">
                                <h4>1.Корзина товаров</h4>
                                <?php
                                $ip_address = file_get_contents('https://api.ipify.org');
                                if (session_status() != PHP_SESSION_NONE)
                                    if(isset($_SESSION['loggedin'])) {
                                        if ($_SESSION['loggedin'] == 1) {
                                            $email_session = $_SESSION['email'];
                                        } else {
                                            $email_session = 0;
                                        }
                                    }
                                else
                                    $email_session = 0;
                                    $get_cart = new \Application\models\Cart();
                                    $res_get_products = $get_cart->get_product_from_cart_by_ip_address($ip_address, $email_session);
                                    $res_get_products->execute(array($ip_address, $email_session));

                                foreach ($res_get_products as $res_product){
                                    if($res_product['id'] != NULL){?>
                                        <a href="#" class="btn btn-danger btn-lg cart_delete_all">
                                            <span class="cart_remove_all">Remove all</span>
                                        </a>
                                    <?php
                                    }
                                }?>
                                <?php
                                $ip_address = file_get_contents('https://api.ipify.org');
//                                if($_SESSION['email'] != ''){
                                    $get_cart = new \Application\models\Cart();
                                    $res_get_products = $get_cart->get_product_from_cart_by_ip_address($ip_address,$email_session);
                                    $res_get_products->execute(array($ip_address,$email_session));
//                                }else{
//                                    $get_cart = new \Application\models\Cart();
//                                    $email = 0;
//                                    $res_get_products = $get_cart->get_cart_by_ip_address_Session_email($ip_address,$email);
//                                    $res_get_products->execute(array($ip_address,$email));
//                                }
                                $arr_ids = [];
                                foreach ($res_get_products as $res_product){
                                    $data = $res_product['ProductId'];
                                    $arr_ids[] = $data;
                                    ?>
                                    <form method="post" action="/main/cart/?ip_address=<?= $ip_address;?>&action=confirm">
                                        <table class="table table-dark">
                                            <tbody>
                                                <tr>
                                                    <td class="modal_img_info_purchase"><br><img width="60px" height="60px" src="/application/photo/<?= $res_product['department_id'] ?>/<?= $res_product['photo'] ?>"/></td>
                                                    <td class="modal_name_info_purchase"><br><p></p><?= $res_product['name'] ?></td>
                                                    <td><div class="modal_quantity_info_purchase_div"><input type="number"  min="1" max="1000" class="modal_quantity_info_purchase" name="quantity" value="<?= $res_product['quantity']?>">
                                                            <span class="price" width="50" id="price" value="<?= $res_product['cartPrice']?>" real_price="<?= $res_product['real_price'];?>" price="<?= $res_product['cartPrice'] ?>"><?= $res_product['cartPrice'] ?> $</span>
                                                        </div>
                                                    </td>
                                                    <td class="modal_delete_info_purchase">
                                                       <a href="#"><span class="glyphicon glyphicon-trash cart_delete" iid="<?= $res_product['ProductId'] ?>"></span></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    <?php }
                                    $_SESSION['product_ids'] = $arr_ids;
                               // var_dump($_SESSION['product_ids']);?>
                                    <br>
                                    <?php
                                    foreach ($res_get_products as $res_product) { } ?>
                                    <input  type="text" class="final_price-step1-cart" name="final_price" readonly/>
                                    <input type="text" name="array_prices" class="array_prices" style="display:none;"/>
                                    <input type="text" name="arr_quantity" class="arr_quantity" style="display:none;"/>
                                    <input id="step1_button" type="submit" name="submit" id="submit" iid="<?= $res_product['ProductId'] ?>" class="btn btn-info" value="Следующий шаг"/>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php
                    break;
                    case 'confirm':
                        ?>
                        <div class="product-view-tabs-second">
                            <ul class="nav nav-pills">
                                <li class="no-active"><a  href="/main/cart/?ip_address=<?=  $ip_address; ?>&action=oneclick">Шаг 1</a></li>
                                <li class="active"><a  href="/main/cart/?ip_address=<?= $ip_address;?>&action=confirm">Шаг 2</a></li>
                                <li class="no-active"><a  href="/main/cart/?ip_address=<?= $ip_address;?>&action=completion">Шаг 3</a></li>
                            </ul>
                            <div class="tab-content-cart">
                                <div id="step2" >
                                    <?php
                                    if(isset($_POST['array_prices'])){
                                        $_SESSION['array_prices'] = $_POST['array_prices'];
                                    }
                                    if (isset($_POST['final_price'])) {
                                        $_SESSION['res_price'] = $_POST['final_price'];
                                    }
                                    if ($_SESSION['order_delivery'] = "По почте") {
                                        $chck1 = "checked";
                                    } else {
                                        $chck1 = '';
                                    }
                                    if ($_SESSION['order_delivery'] = "Курьером") {
                                        $chck2 = "checked";
                                    } else {
                                        $chck2 = '';
                                    }
                                    if ($_SESSION['order_delivery'] = "Самовывоз") {
                                        $chck3 = "checked";
                                    } else {
                                        $chck3 = '';
                                    }
                                    if(isset($_POST['arr_quantity'])){
                                        $_SESSION['quantity'] = $_POST['arr_quantity'];
                                    }
                                    ?>
                                    <h4 id="cart-contact-info" >2.Контактная информация</h4>
                                    <p  class="cart-mode-delivery">Способы доставки:</p>
                                    <form method="post" action="/main/cart/?ip_address=<?= $ip_address;?>&action=completion">
                                        <div class="form-group row">
                                            <div class="col-xs-4">
                                                <input type="radio" name="order_delivery" class="order_delivery" id="order_delivery1" value="По почте" <?= $chck1;?> />
                                                <label class="label_delivery" for="order_delivery1">По почте</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="radio" name="order_delivery" class="order_delivery" id="order_delivery2" value="Курьером" <?= $chck2?> />
                                                <label class="label_delivery" for="order_delivery2">Курьером</label>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="radio" name="order_delivery" class="order_delivery" id="order_delivery3" value="Самовывоз" <?= $chck3; ?> />
                                                <label class="label_delivery " for="order_delivery3">Самовывоз</label>
                                            </div>
                                            <p class="cart-info-delivery">Информация для доставки:</p>
                                            <div class="col-xs-6">
                                                <label for="order_fio">ФИО</label>
                                                <input type="text" class="form-control col-sm-4" name="order_fio" id="order_fio" placeholder="Пример: Иван ван Иванович"/>
                                            </div>
                                            <div class="col-xs-6">
                                                <label for="order_email">E-mail</label>
                                                <input type="text" class="form-control col-sm-4" name="order_email" id="order_email" placeholder="Пример: ivanov@mail.ru"/>
                                            </div>
                                            <div class="col-xs-6">
                                                <label for="order_phone">Телефон</label>
                                                <input type="text" class="form-control col-sm-4" name="order_phone" id="order_phone" placeholder="Пример: 8 950 100 12 34"/>
                                            </div>
                                            <div class="col-xs-6">
                                                <label class="order_label_style" for="order_address">Адрес доставки</label>
                                                <input class="form-control col-sm-4" type="text" name="order_address" id="order_address"  placeholder="Пример: г. Москва, ул Интузиастов д 18, кв 58"/>
                                            </div>
                                        </div>
                                        <br>
                                        <input id="step2_button" type="submit" class="btn btn-info" value="Следующий шаг"/>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    break;
                    case 'completion':?>
                        <div class="product-view-tabs step3">
                            <ul class="nav nav-pills">
                                <li class="no-active"><a  href="/main/cart/?ip_address=<?= $ip_address;?>&action=oneclick">Шаг 1</a></li>
                                <li class="no-active"><a  href="/main/cart/?ip_address=<?= $ip_address;?>&action=confirm">Шаг 2</a></li>
                                <li class="active"><a href="/main/cart/?ip_address=<?= $ip_address;?>&action=completion">Шаг 3</a></li>
                            </ul>
                            <div class="tab-content-cart-step3">
                                <div id="step3">
                                    <h4 id="cart-last-step">3.Завершение</h4>
                                    <?php
                                    ///var_dump($_SESSION['product_ids']);
                                    $_SESSION['length'] = sizeof($_SESSION['product_ids']);
                                    if (isset($_POST['order_delivery'])) {
                                        $_SESSION['order_delivery'] = $_POST['order_delivery'];
                                    }
                                    if (isset($_POST['order_fio'])) {
                                        $_SESSION['order_fio'] = $_POST['order_fio'];
                                    }
                                    if (isset($_POST['final_price'])) {
                                        $_SESSION['res_price'] = $_POST['final_price'];
                                    }
                                    if (isset($_POST['order_phone'])) {
                                        $_SESSION['order_phone'] = $_POST['order_phone'];
                                    }
                                    if (isset($_POST['order_email'])) {
                                        $_SESSION['order_email'] = $_POST['order_email'];
                                    }
                                    if (isset($_POST['order_address'])) {
                                        $_SESSION['order_address'] = $_POST['order_address'];
                                    }
                                    ?>
                                    <ul class="list-group">
                                        <li class="list-group-item"><strong>Email:</strong><p id="to_buy_order_email"><?php if(isset($_SESSION['order_email'])){ ?><?= $_SESSION['order_email'] ?><?php }?></p></li>
                                        <li class="list-group-item"><strong>ФИО:</strong><p id="to_buy_order_fio"><?php if(isset($_SESSION['order_fio'])){?><?= $_SESSION['order_fio'] ?><?php }?></p></li>
                                        <li class="list-group-item"><strong>Адрес доставки:</strong><p id="to_buy_order_address"><?php if(isset($_SESSION['order_address'])){ ?><?= $_SESSION['order_address'] ?><?php }?></li>
                                        <li class="list-group-item"><strong>Телефон:</strong><p id="to_buy_order_phone"><?php if(isset($_SESSION['order_phone'])){ ?><?= $_SESSION['order_phone'] ?><?php }?></p></li>
                                        <li class="list-group-item"><strong>Тип доставки:</strong><p id="to_buy_order_delivery"><?php if(isset($_SESSION['order_delivery'])){ ?><?= $_SESSION['order_delivery'] ?><?php }?></p></li>
                                        <li class="list-group-item"><strong>Цена:</strong><p id="to_buy_order_price"><?php if(isset($_SESSION['res_price'])){ ?><?= $_SESSION['res_price'] ?><?php }?></p></li>
                                    </ul>
                                    <br>
                                    <?php
                                    $get_products = new \Application\models\Cart();
                                    $res_get_products = $get_products->get_product_from_cart_by_ip_address($ip_address);
                                    $res_get_products->execute(array($ip_address));
                                    foreach ($res_get_products as $res_product){} ?>
                                    <button type="submit" id="step3_button" class="btn btn-info" arr_quantity="<?php if(isset($_SESSION['quantity'])){ ?><?= $_SESSION['quantity'] ?><?php }?>"  array_prices="<?php if(isset($_SESSION['array_prices'])){ ?><?= $_SESSION['array_prices'] ?><?php }?>" length="<?= $_SESSION['length'];?>" product_ids='<?= implode(",", $_SESSION['product_ids']);?>' data-dismiss="modal">Купить</button>
                                </div>
                            </div>
                        </div>
                        <?php
                    break;
                    default:
                    break;
                } ?>
            </div>
        </div>
    </body>
</html>
<script>
    $.getJSON("https://api.ipify.org/?format=json", function(e) {
        var ip_address =  e.ip;
        $("#step3_button").each(function() {
            $(this).attr('ip_address',ip_address);
        });
    });

</script>
<script>

    $('#step3_button').click(function () {
        var array_prices = $(this).attr('array_prices');
        var arr_quantity = $(this).attr('arr_quantity');
        var product_ids = $(this).attr('product_ids');
        var ip_address = $(this).attr('ip_address');
        var length = $(this).attr('length');
        var price = $('#to_buy_order_price').html();
        var order_delivery = $("#to_buy_order_delivery").html();
        var order_fio = $("#to_buy_order_fio").html();
        var order_email = $("#to_buy_order_email").html();
        var order_phone = $("#to_buy_order_phone").html();
        var order_address = $("#to_buy_order_address").html();
        $.ajax({
            type:"POST",
            url: "/main/InsertOrder",
            data: "order_fio="+order_fio+"&order_delivery="+order_delivery+"&order_email="+order_email+"&order_phone="+order_phone+"&order_address="+order_address+"&price="+price+"&product_ids="+product_ids+"&ip_address="+ip_address+"&array_prices="+array_prices+"&arr_quantity="+arr_quantity+"&length="+length,
            success:function(res){
                alert(res);
            },
            error:function(){
            }
        })
    });
</script>
<script>
    $.getJSON("https://api.ipify.org/?format=json", function(e) {
        var ip_address =  e.ip;
        $(".cart_remove_all").attr('ip_address',ip_address);
    });
    $('.cart_delete_all').click(function(){
        var ip_address = $('.cart_remove_all').attr('ip_address');
        $.ajax({
            url: "/main/DeleteAllFromCart",
            type: "POST",
            data: "ip_address=" + ip_address,
            success: function (res) {
                if(res == 1) {

                    $("#flash-msg-deleting-order").show();
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                    $('.cart_delete_all').css('display','none');
                }
            },
            error: function () {
                alert("Error");
            }
        });
    });
</script>
<script>
    $('.modal_quantity_info_purchase_div').change(function(index) {
        // modal_quantity_info_purchase
        var price = $(this).find('span').attr('real_price');
        var valueCurrent = parseInt($('.modal_quantity_info_purchase',this).val());
        var res_price = price * valueCurrent;
        $(this).find('span').html(res_price + ' $');
        $(this).find('span').attr('value', res_price);

        function final_price() {
            var final_price = 0;
            $(".price").each(function () {
                final_price += Number($(this).attr('value'));
                $('.final_price-step1-cart').val(final_price+' $');
                return final_price;
            });
        }
        $('.final_price-step1-cart').val(final_price());
        $('.final_price-step1-cart').attr('value',final_price());
        function arr_prices() {
            var arr_prices = [];
            $(".price").each(function () {
                arr_prices.push($(this).attr('value').split(',')[0]);
                console.log(arr_prices);
                $('#step1_button').attr('array_prices',arr_prices);
                $('.array_prices').attr('array_prices',arr_prices);
                $('.array_prices').val(arr_prices);
                $('.array_prices').attr('value',arr_prices);
            });
        }
        $('#step1_button').attr('array_prices',arr_prices());
        $('.array_prices').attr('array_prices',arr_prices());
        $('.array_prices').val(arr_prices());
        $('.array_prices').attr('value',arr_prices());

        function arr_quantity() {
            var arr_quantity = [];
            $(".modal_quantity_info_purchase").each(function () {
                // alert($(this).val());
                // arr_quantity.push($(this).attr('value').split(',')[0]);
                arr_quantity.push($(this).val().split(',')[0]);
                console.log(arr_quantity);
                $('#step1_button').attr('arr_quantity',arr_quantity);
                $('.arr_quantity').attr('arr_quantity',arr_quantity);
                $('.arr_quantity').val(arr_quantity);
                $('.arr_quantity').attr('value',arr_quantity);
            });
        }
        $('#step1_button').attr('arr_quantity',arr_quantity());
        $('.arr_quantity').attr('arr_quantity',arr_quantity());
        $('.arr_quantity').val(arr_quantity());
        $('.arr_quantity').attr('value',arr_quantity());
    });
</script>
<script>
    function final_price() {
        var final_price = 0;
        $(".price").each(function () {
            final_price += Number($(this).attr('value'));
            $('.final_price-step1-cart').val(final_price+' $');
            return final_price;
        });
    }
    $('.final_price-step1-cart').val(final_price());
    $('.final_price-step1-cart').attr('value',final_price());
</script>
<script>
    $('.glyphicon.glyphicon-trash.cart_delete').click(function(){
        var iid = $(this).attr('iid');
        $.ajax({
            url: "/main/DeleteOneFromCart",
            type: "POST",
            data: "id=" + iid,
            success: function (res) {
                if(res == 1) {
                    $("#flash-msg-deleting-order").show();
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
            },
            error: function () {
                alert("Error");
            }
        });
    });
    function arr_prices() {
        var arr_prices = [];
        $(".price").each(function () {
            arr_prices.push($(this).attr('value').split(',')[0]);
            console.log(arr_prices);
            $('#step1_button').attr('array_prices',arr_prices);
            $('.array_prices').attr('array_prices',arr_prices);
            $('.array_prices').val(arr_prices);
            $('.array_prices').attr('value',arr_prices);
        });
    }
    $('#step1_button').attr('array_prices',arr_prices());
    $('.array_prices').attr('array_prices',arr_prices());
    $('.array_prices').val(arr_prices());
    $('.array_prices').attr('value',arr_prices());

    function arr_quantity() {
        var arr_quantity = [];
        $(".modal_quantity_info_purchase").each(function () {
            arr_quantity.push($(this).val().split(',')[0]);
            console.log(arr_quantity);
            $('#step1_button').attr('arr_quantity',arr_quantity);
            $('.arr_quantity').attr('arr_quantity',arr_quantity);
            $('.arr_quantity').val(arr_quantity);
            $('.arr_quantity').attr('value',arr_quantity);
        });
    }
    $('#step1_button').attr('arr_quantity',arr_quantity());
    $('.arr_quantity').attr('arr_quantity',arr_quantity());
    $('.arr_quantity').val(arr_quantity());
    $('.arr_quantity').attr('value',arr_quantity());
</script>
