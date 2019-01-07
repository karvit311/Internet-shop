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
<!--        <script src="https://code.jquery.com/jquery-1.12.2.min.js" integrity="sha256-lZFHibXzMHo3GGeehn1hudTAP3Sc0uKXBXAzHX1sjtk=" crossorigin="anonymous"></script>-->
<!--<!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->-->
<!--<!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->-->
<!--        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>-->
<!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>-->
<!--        <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>-->
<!--        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>-->
<!--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
<!--        <link rel="stylesheet" href="/application/css/css.css">-->
<!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
<!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">-->
<!--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />-->
<!--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" />-->
    </head>
    <body>

        <?php
        $products = new \Application\models\Product();
        $res_products = $products->get_products();
        ?>
        <div class="container">
            <div class="row">
                <?php foreach ($res_products as $res_product){?>
                <div class="column" >
                    <div>
                        <img  src="/application/photo/phone/<?= $res_product['photo'];?>" alt="<?= $res_product['name'];?>" align=left  width=215px height=215px>
                    </div>
                    <div style="height:55px;margin-bottom:30px;">
                        <ul style="font-size:12px;font-family:'Comic Sans MS', cursive, sans-serif ;" >
                            <li>
                                <p ><?= $res_product['name'];?></p>
                            </li>
                            <li>
                                <p class="price_products"><?= $res_product['price'].' грн';?></p>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    </body>
</html>
<script>
    $('.column').hover(function(){
        $(this).css('width', '23%');
        $(this).append($('<button>')
            .addClass('btn-danger button-price')
            .text('Купить')
        )
    }, function() {

        $(this).css('width', '22.5%');
        $('.button-price').hide();

    });
</script>
<style>
    .button-price{
        margin-top:70px;
    }
    * {
        box-sizing: border-box;
    }
    .button-price{
        /*display:none;*/
        width:95%;
        height:40px;
    }
    .column :hover{
        cursor:pointer;
    }
    .column {
        float: left;
        width: 22.5%;
        height:350px;
        padding: 10px;
        border:1px solid #f3d6d6;
        margin:5px;

    }
    .column ul {
        list-style:none;
    }
    .column img{
        margin-left:-5px;
        /*margin-top:-10px;*/
        /*max-width:50%;*/
    }
    /* Clearfix (clear floats) */
    .row::after {
        content: "";
        clear: both;
        display: table;
    }
</style>