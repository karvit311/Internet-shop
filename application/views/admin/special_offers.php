<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Special Offers</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php
        $products_pagination = new \Application\models\Product();
        $res_products_pagination = $products_pagination->get_total_by_special_offers();
        foreach($res_products_pagination as $res_product_pagination) {
            $total = $res_product_pagination['total'];
            $adjacents = 3;
            $page = $_GET['page'];
            $targetpage = "/admin/SpecialOffers/?"; //your file name
            $limit = 8; //how many items to show per page
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
            $res_products = $products->get_prices_by_special_offers($limit,$start);
            $res_products->execute();
            include("pagination.php"); ?>
            <div class="container">
                <div class="row">
                    <div id="breadcrumbs-products">
                        <ul>
                            <li><a class="btn btn-default come_back" href="/admin/index"  role="button"><span class="glyphicon glyphicon-arrow-left"></span>  Вернуться</a></li>
                            <li><a class="btn btn-light" href="/admin/about" role="button">AllPAN</a></li>
                            <li class="greater-sign"> ></li>
                            <li> <a class="btn btn-light" href="#" role="button">Special Offers </a></li>
                        </ul>
                    </div>
                    <!-- DELETING SUCCESS-->
                    <div class="alert alert-success deleting_product alert-dismissable" style="display: none;" id="flash-msg-deleting-product">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <h4><i class="icon fa fa-check"></i>Success!</h4><p>Product've  successfully deleted!</p>
                    </div>
                    <div id="computers">
                        <?php foreach ($res_products as $res_product){?>
                            <div class="column-admin <?= $res_product['brand'];?> <?= $res_product['colour'];?>" data-price="<?= $res_product['price']; ?>"  price="<?= $res_product['price']?>" >
                                <div class="column-div">
                                    <?php if($res_product['special_offer'] == '1'){?>
                                        <div data-description="2 в 1" class="button button-2in1">2 в 1</div>
                                    <?php }?>
                                    <?php if($res_product['discount'] == '1' && $res_product['special_offer']== '1'){
                                        $about_discount = new \Application\models\Product();
                                        $res_about_discount = $about_discount->get_discount_by_special_offer_and_discount();
                                        foreach($res_about_discount as $res_ab_discount){
                                        }
                                        ?>
                                        <div data-description="Скидка - <?= $res_ab_discount['value_discount'] . '%'; ?>" class="button button-discount"><?= $res_ab_discount['value_discount'] . '%'; ?></div>
                                    <?php }?>
                                    <?php if($res_product['new_product'] == '1' && $res_product['special_offer']== '1'){?>
                                        <div data-description="Новинка" class="button button-new">Новинка</div>
                                    <?php }?><br>
                                    <?php if($res_product['popular'] == '1' && $res_product['special_offer']== '1'){?>
                                        <div data-description="Топ продаж" class="button button-top">Топ продаж</div>
                                    <?php }?>
                                    <?php if($res_product['quantity']<10){?>
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
                                <button type="submit" iid="<?= $res_product['id']?>" department_id="<?= $res_product['department_id'];?>" price="<?= $res_product['price']?>" name="<?= $res_product['name']?>" class="btn-default button-edit">Edit</button>
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
                                    <h3 class="modal-title">Edition Special Offers</h3>
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
                                                        <input id="discount" class="discount_edit" type="checkbox" name="discount" value="1"/>
                                                        <div class="discount_input">
                                                            <input type="number" placeholder="Введите скидку" class="form-control quantity_discount" disabled min="1"><br><br>
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
                                                        <input id="popular" type="checkbox" name="promotion" value="1" />
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Popular</span>
                                                        </div>
                                                        <input id="popular" type="checkbox" name="popular" value="1" />
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">New</span>
                                                        </div>
                                                        <input id="new_product" type="checkbox" name="new_product" value="1" />
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Special Offer</span>
                                                        </div>
                                                        <input id="special_offer" type="checkbox" name="special_offer" value="1" />
                                                        <div class="special_offer_input">
                                                            <textarea  placeholder="Опишите акцию" class="form-control description_special_offer" disabled ></textarea><br><br>
                                                            <div class='input-group date' id='datetimepicker8'>
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
                </div>
                <?php
                    echo $pagination;
                ?>
            </div>
        <?php }?>
    </body>
</html>
<script>

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
    $('#edit_product').on("hidden.bs.modal", function() {
        location.reload();
    });
    $(".column-admin .button-edit").each(function(index) {
        $(this).on("click", function() {
            $('#edit_product').modal("show");
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
                                                        .attr('src', '/application/photo/small_images/' + department_id + '/' + res_small_img)
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
                                url: "/admin/Upload/?department_id_from_url="+department_id,
                                type: 'post',
                                data: fd,
                                contentType: false,
                                processData: false,
                                success: function (response) {
                                    if (response != 0) {
                                        $('.image_modal_edit').find('img').attr('src','/application/photo/'+department_id+'/' + response);
                                        $('.small_images').css('display','block');
                                        $('.preview').remove();
                                        $('.modal_main_image_block')
                                            .append($('<div>')
                                                .addClass('preview')
                                                .css('width','160px')
                                                .css('margin-left','50px')
                                                .css('padding','10px')
                                                .append($('<img>')
                                                    .attr('src', '/application/photo/'+department_id+'/' + response)
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
                                    url: "/admin/UpSmImg/?department_id_from_url="+department_id,
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
                                                                        .attr('src', '/application/photo/small_images/' + department_id + '/' + img_small)
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
                                                    }
                                                },
                                                error: function () {
                                                    alert("Error");
                                                }
                                            });
                                            $('.close').click(function () {
                                                $('#addimage0  input[type="file"]').val('');
                                                var iid_small_images = $(this).attr('sm_img_iid');
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
                                                $(this).remove();
                                                $(this).find('img').remove();
                                                $('.preview_small'+iid_small_images).find('div').remove();
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
