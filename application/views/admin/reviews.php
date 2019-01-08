<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$_SESSION['urlpage'] = "<a href='/site/index'>Отзывы</a>";?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Панель управления</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <style>
        #block-parameters{
            height: 40px;
            border-bottom: 1px solid #E0E0E0;
            background-color: #F2F2F2;
        }
        #options-list-admin > li{
            float: left;
            margin-left: 10px;
            font: 14px sans-serif;
            margin-top: 13px;
            list-style:none;
        }
        #options-list-admin > li > a{
            color: #748996;
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
            list-style:none;
        }
        #list-links-sort  a{
            font: 15px sans-serif;
            text-decoration: none;
            color: black;
        }
        #list-links-sort a:hover{
            text-decoration: underline;
        }
        #review-info-count li{
            float: left;
            margin-left: 10px;
            font: 14px sans-serif;
            margin-top: 12px;
            list-style:none;
        }
        #block-info{
            height: 40px;
            border-bottom: 1px solid #E0E0E0;
        }
    </style>
    <style>
        .essence_of_review{
            font-size:18px;
        }
        .author_of_review{
            font-size:14px;
        }
        .reviews{
            border:1px solid #ddd;
            padding:30px;
            margin-left:-41px;
        }
        .reviews-details-ul h4{
            text-decoration:underline;
        }
        .reviews-details-ul li{
            list-style:none;
        }
        .reviews-edition.accept{
            color:green;
        }
        .reviews-edition.delete a{
            color:red;
        }
        .edition_of_reviews{
            float:right;
        }
        .reviews-edition{
            display:flex;
            margin-left:15px;
        }
        .body-review{
            display:flex;
        }
        #reviews-ul li{
            list-style:none;
            margin-bottom:15px;
        }
    </style>
    <body style="background-color: #F2F4F9;" >
        <div class="container">
            <div class="row">
                <div class="body-admin">
                    <div id="block-body-admin">
                        <?php
                        include("block-header.php");
                        ?>
                        <div id="block-content-admin">
                            <?php
                            if($_SESSION['admin'] = "admin") {
                                if (isset($_SESSION['admin_role'])) {
                                    if($_SESSION['admin_role'] == 'admin-reviews' || $_SESSION['admin_role'] == 'admin'){
                                    ?>
                                        <!-- Acception SUCCESS-->
                                        <div class="alert alert-success accept-review alert-dismissable" style="display: none;" id="flash-msg-accept-review">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                            <h4><i class="icon fa fa-check"></i>Success!</h4><p>Review've  successfully accepted!</p>
                                        </div>
                                        <!-- DELETING SUCCESS-->
                                        <div class="alert alert-success deleting_review alert-dismissable" style="display: none;" id="flash-msg-deleting-review">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                            <h4><i class="icon fa fa-check"></i>Success!</h4><p>Review've  successfully deleted!</p>
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
                                        <?php
                                        $count_all_orders = new \Application\models\Orders();
                                        $res_count_all_orders = $count_all_orders->count_all_orders();
                                        foreach($res_count_all_orders as $res_count_all_order){
                                            $count_all_orders = $res_count_all_order['total'];
                                        }
                                        $count_no_accepted_orders = new \Application\models\Orders();
                                        $res_count_no_accepted_orders = $count_no_accepted_orders->count_no_accepted_orders();
                                        foreach($res_count_no_accepted_orders as $res_count_no_accepted_order){
                                            $count_no_accepted_orders = $res_count_no_accepted_order['total'];
                                        }
                                        $sort_name = 'Без сотировки';
                                        if(isset($_GET['sort'])){
                                            $sort = $_GET['sort'];
                                            switch ($sort) {
                                                case "accept":
                                                    $sort_accept = new \Application\models\Review();
                                                    $result_reviews = $sort_accept->get_sort_accepted();
                                                    $sort_name = 'Проверенные';
                                                break;
                                                case "no-accept":
                                                    $sort_no_accept = new \Application\models\Review();
                                                    $result_reviews = $sort_no_accept->get_sort_no_accepted();
                                                    $sort_name = 'Не проверенные';
                                                break;
                                                default:
                                                $reviews = new \Application\models\Review();
                                                $result_reviews = $reviews->get_reviews_and_products();
                                                $sort_name = 'Без сотировки';
                                                break;
                                            }
                                        }else{
                                            $reviews = new \Application\models\Review();
                                            $result_reviews = $reviews->get_reviews_and_products();
                                        }
                                        ?>
                                        <div id="block-parameters">
                                            <ul id="options-list-admin">
                                                <li><span id="tov">Сортировать</span></li>
                                                <li><a id="select-links" href="#"><?= $sort_name; ?></a>
                                                    <ul id="list-links-sort">
                                                        <li><a href="/admin/reviews/?sort=accept">Проверенные</a></li>
                                                        <li><a href="/admin/reviews/?sort=no-accept">Не проверенные</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php
                                        $count_all_reviews = new \Application\models\Review();
                                        $res_count_all_reviews = $count_all_reviews->count_all_reviews();
                                        foreach($res_count_all_reviews as $res_count_all_review){
                                            $count_all_reviews = $res_count_all_review['total'];
                                        }
                                        $count_no_accepted_reviews = new \Application\models\Review();
                                        $res_count_no_accepted_reviews = $count_no_accepted_reviews->count_no_accepted_reviews();
                                        foreach($res_count_no_accepted_reviews as $res_count_no_accepted_review){
                                            $count_no_accepted_reviews = $res_count_no_accepted_review['total'];
                                        }
                                        ?>
                                        <div id="block-info">
                                            <ul id="review-info-count">
                                                <li>Всего отзывов - <strong><?= $count_all_reviews; ?></strong></li>
                                                <li>Не проверенные - <strong><?= $count_no_accepted_reviews; ?></strong></li>
                                            </ul>
                                        </div>
                                        <ul id="reviews-ul">
                                            <?php foreach($result_reviews as $res_review){?>
                                                <li>
                                                    <div class="reviews">
                                                        <div class="body-review value-of_reviews">
                                                            <img src="/application/photo/<?= $res_review['department_id'];?>/<?= $res_review['photo'];?>" width="100px" height="100px"/>
                                                            <ul class="reviews-details-ul">
                                                                <li> <h4><?= $res_review['productName']?></h4></li>
                                                                <li><p class="essence_of_review"><?= $res_review['review']?></p></li>
                                                                <li><p class="author_of_review">( <?= $res_review['name'];?> )</p></li>
                                                            </ul>
                                                        </div>
                                                        <div class="body-review edition_of_reviews">
                                                            <?php if($res_review['accepted']==0){?>
                                                            <p class="reviews-edition accept" review_id="<?= $res_review['reviewId'];?>"><a href="#">Принять</a></p>
                                                            <?php }?>
                                                            <p class="reviews-edition delete" review_id="<?= $res_review['reviewId'];?>"><a href="#">Удалить</a></p>
                                                        </div>
                                                    </div>
                                                </li>
                                        <?php
                                            }?>
                                        </ul>
                                    <?php
                                    }else{?>
                                        <!-- ERROR PRIVILEGE-->
                                        <div class="alert alert-danger  alert-dismissable error-privilege"  id="flash-msg-privilege-orders">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                            <h4><i class="icon fa fa-check"></i>ERROR!</h4><p>У Вас нет прав на редактирование отзывов!</p>
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
                            }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    $( ".reviews-edition.delete" ).click(function() {
        var review_id = $(this).attr('review_id');
        var YOUR_MESSAGE_STRING_CONST = "Are you sure to Delete this review?";
        confirmDialog(YOUR_MESSAGE_STRING_CONST, function(){
            $.ajax({
                type: "POST",
                url: "/admin/DeleteReview",
                data: "review_id=" + review_id ,
                success: function (response) {
                    if(response == 1) {
                        $("#flash-msg-deleting-review").show();
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
        console.log("deleted!");
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
    $('.reviews-edition.accept').click(function(){
        var review_id = $(this).attr('review_id');
        $(this).remove();
        $.ajax({
            type: "post",
            url: "/admin/acceptReview",
            data:"review_id="+review_id,
            success:function(){
                $("#flash-msg-accept-review").show();
            },
            error:function(){
            }
        })
    });
</script>
<script>
    $(document).ready(function() {
        $('#select-links').click(function () {
            $("#list-links-sort").slideToggle(200);
        });
    });
</script>
