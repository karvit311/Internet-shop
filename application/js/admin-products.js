$(".column-admin .button-delete").each(function() {
    $(this).on("click", function(){
        var iid = $(this).attr('iid');
        alert(iid);
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
$("#menu ul").hide();
$("#menu li span").click(function() {
    $("#menu ul:visible").slideUp("normal");
    if (($(this).next().is("ul")) && (!$(this).next().is(":visible"))) {
        $(this).next().slideDown("normal");
    }
});
$(function($) {
    $(".adding_info_add").summernote();
});
$(function($) {
    $(".big_description_add").summernote();
});
$(function($) {
    $(".adding_info").summernote();
});
jQuery(function($) {
    $(".big_description").summernote();
});
$('#edit_product').on("hidden.bs.modal", function() {
    location.reload();
});
$('#add_new_product_Modal').on('hide.bs.modal', function () {
    location.reload();
});
$('#add_new_product_Modal').on('hidden.bs.modal', function () {
    location.reload();
});
$('#add_new_product').click(function(){
    $('#add_new_product_Modal').modal("show");
    $('#submit_form-products-admin-add-product').on('click', function () {
        location.reload();
    });
    $('#submit_form-products-admin-add-product').click(function () {
        location.reload();
    });
    $.urlParam = function(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        return results[1] || 0;
    }
    var department_id_from_url = $.urlParam('department_id');
    $('form[id="add_form"]').validate({
        rules: {
            file: {
                required: true
            },
            myselect: { valueNotEquals: "-1"
            },
            name: {
                required: true
            },
            quantity: {
                required: true
            },
            quantity_discount:{
                required: true
            },
            description_popular:{
                required: true
            },
            description_special_offer:{
                required: true
            },
        },
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
            $(element).closest('.form-group input[type=file]').addClass('has-error');
            $(element).closest('.form-group select[name=myselect]').addClass('has-error');
            $(element).closest('.input-group ').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
            $(element).closest('.form-group input[type=file]').removeClass('has-error');
            $(element).closest('.form-group select[name=myselect]').removeClass('has-error');
            $(element).closest('.input-group ').removeClass('has-error');
        }
    });
    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg != value;
    }, "Value must not equal arg.");
    $('#discount_add').change(function() {
        if ($('#discount_add').prop('checked') == true) {
            $('.discount-div').addClass('form-group')
                .append($('<div>')
                    .addClass('discount_input')
                    .append($('<input>')
                        .attr('placeholder', 'Введите скидку')
                        .attr('type', 'number')
                        .addClass('form-control quantity_discount')
                        .attr('name', 'quantity_discount')
                        .attr('min', 1)
                    )
                    .append($('<div>')
                        .append($('<div>')
                            .addClass('input-group date')
                            .attr('id', 'datetimepicker3')
                            .append($('<input>')
                                .attr('type', 'text')
                                .addClass('form-control')
                                .attr('id', 'discount_end_date')
                                .attr('name', 'discount_end_date')
                            )
                            .append($('<span>')
                                .addClass('input-group-addon')
                                .append($('<span>')
                                    .addClass('glyphicon glyphicon-calendar')
                                )
                            )
                        )
                    )
                )
            $('#datetimepicker3').datetimepicker({
                defaultDate: new Date()
            });
        }else{
            $('.discount_input').remove();
            $('.discount-div').css('margin-bottom','-5px');
        }
    });
    $('#promotion_add').change(function() {
        if ($('#promotion_add').prop('checked') == true) {
            $('.promo-div').addClass('form-group').append($('<div>')
                .addClass('promotion_input')
                .append($('<select>')
                    .addClass('form-control  description_promotion')
                    .attr('name', 'description_promotion')
                )
            )
            $.ajax({
                type:"post",
                url:"/admin/GetAllPromotions",
                dataType:"json",
                success:function(res){
                    $.each(res, function(iy, ely) {
                        var title = ely['title'];
                        var promotion_id = ely['id'];
                        $('.description_promotion').append($('<option>')
                            .text(title)
                            .attr('promotion_id',promotion_id)
                        );

                    });
                },
                error:function(){
                }
            });
            $('#datetimepicker4').datetimepicker({
                defaultDate: new Date()
            });
        }else{
            $('.promotion_input').remove();
            $('.promo-div').css('margin-bottom','-5px');
        }
    });
    $('#special_offer_add').click(function(){
        if ($('#special_offer_add').prop('checked') == true) {
            $('.special_offer-div')
                .addClass('form-group')
                .append($('<div>')
                    .addClass('form-group')
                    .append($('<div>')
                        .addClass('input-group date')
                        .attr('id', 'datetimepicker5')
                        .append($('<input>')
                            .attr('type', 'text')
                            .addClass('form-control')
                            .attr('id', 'special_offer_end_date')
                            .attr('name', 'special_offer_end_date')
                        )
                        .append($('<span>')
                            .addClass('input-group-addon')
                            .append($('<span>')
                                .addClass('glyphicon glyphicon-calendar')
                            )
                        )
                    )
                )
            $('#datetimepicker5').datetimepicker({
                defaultDate: new Date()
            });
        }else{
            $('.special_offer_input').remove();
            $('.special_offer-div').css('margin-bottom','-5px');
        }
    });
    $('.modal_main_image_block input[type=file]').change(function(e) {
        $.urlParam = function(name){
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
            return results[1] || 0;
        }
        var department_id_from_url = $.urlParam('department_id');
        var fileName = e.target.files[0].name;
        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('file',files);
        $.ajax({
            url: "/admin/Upload/?department_id_from_url="+department_id_from_url,
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response != 0) {
                    var photo = response;
                    var t =0;
                    $('#submit_form-products-admin-add-product').click(function () {
                        $('form[id="add_form"]').validate();
                        if ($('form[id="add_form"]').valid()) {
                            if ($('#new_product_add').is(':checked')) {
                                var new_product = '1';
                            } else {
                                var new_product = '0';
                            }
                            if ($('#discount_add').is(':checked')) {
                                var discount = '1';
                                var value_discount = $('.quantity_discount').val();
                                var end_date_discount = $('#datetimepicker3 input#discount_end_date').val();
                            } else {
                                var discount = '0';
                                var value_discount = '0';
                                var end_date_discount = '0';
                            }
                            if ($('#popular_add').is(':checked')) {
                                var popular = '1';
                            } else {
                                var popular = '0';
                            }
                            if ($('#promotion_add').is(':checked')) {
                                var promotion = '1';
                                var value_promotion = $(".description_promotion option:selected").attr('promotion_id');
                            } else {
                                var promotion = '0';
                                var value_promotion = '0';
                                var end_date_promotion = '0';
                            }
                            if ($('#special_offer_add').is(':checked')) {
                                var special_offer = '1';
                                var end_date_special_offer = $('#datetimepicker5 input#special_offer_end_date').val();
                            } else {
                                var special_offer = '0';
                                var end_date_special_offer = '0';
                            }
                            var name = $('.name_add').val();
                            var brand = $('.brand_add').val();
                            var colour = $('.colour_add').val();
                            var price = $('.price_products_add').val();
                            var adding_info = $('.adding_info_add').val();
                            var big_description = $('.big_description_add').val();
                            var quantity = $('.quantity_add').val();
                            var department_id = $('.department_add').attr('department_id');
                            $.ajax({
                                type: "POST",
                                url: "/admin/InsertNewProduct",
                                data: "name=" + name + "&value_discount=" + value_discount + "&end_date_discount=" + end_date_discount + "&value_promotion=" + value_promotion + "&end_date_promotion=" + end_date_promotion + "&end_date_special_offer=" + end_date_special_offer + "&brand=" + brand + "&colour=" + colour + "&big_description=" + big_description + "&adding_info=" + adding_info + "&price=" + price + "&quantity=" + quantity + "&discount=" + discount + "&promotion=" + promotion + "&new_product=" + new_product + "&special_offer=" + special_offer + "&popular=" + popular + "&department_id=" + department_id + "&photo=" + photo,
                                success: function (res) {
                                    if($.trim(res)==1){
                                        location.reload();
                                    }
                                },
                                error: function (res) {
                                }
                            });
                        } else {
                            alert('no valid!');
                        }
                    });
                    $('.preview_small').click(function () {
                        $('#addimage0  input[type="file"]').val('');
                        var iid = $(this).find('img').attr('iid');
                        $(this).remove();
                        $(this).find('img').remove();
                    });
                    t = t + 1;
                    $('.image_modal_add').find('img').attr('src','/application/photo/'+department_id_from_url+'/'+fileName);
                    $('.modal_main_image_block').append($('<div>')
                        .addClass('preview')
                        .css('width', '160px')
                        .css('margin-left', '50px')
                        .css('padding', '10px')
                        .append($('<img>')
                            .attr('src', '/application/photo/'+department_id_from_url+'/' + response)
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
                        $('.small_images').css('display','none');
                        $(this).find('img').remove();
                        $(this).find('button').remove();
                        $('.modal_main_image_block').find('img').attr('src','');
                    });
                } else {
                    alert('file not uploaded');
                }
            },
        });
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
}).on("hidden.bs.modal", function() {
    location.reload();
});
$(function () {
    var minPrice = 100,
        maxPrice = 60000,
        $filter_lists = $("#filters ul"),
        $filter_checkboxes = $("#filters :checkbox"),
        $items = $("#computers div.column-admin");
    $filter_checkboxes.click(filterSystem);
    $('#slider-container').slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        values: [minPrice, maxPrice],
        slide: function (event, ui) {
            $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
            minPrice = ui.values[0];
            maxPrice = ui.values[1];
            filterSystem();
        }
    });
    $("#amount").val("$" + minPrice + " - $" + maxPrice);
    function filterSlider(elem) {
        var price = parseInt($(elem).data("price"), 10);
        console.log(price);
        return price >= minPrice && price <= maxPrice;
    }
    function filterCheckboxes(elem) {
        var $elem = $(elem),
            passAllFilters = true;
        $filter_lists.each(function () {
            var classes = $(this).find(':checkbox:checked').map(function () {
                return $(this).val();
            }).get();
            console.log('classes', classes);
            var passThisFilter = false;
            $.each(classes, function (index, item) {
                if ($elem.hasClass(item)) {
                    console.log('hasClass', item);
                    passThisFilter = true;
                    return false; //stop inner loop
                }
            });
            if (!passThisFilter) {
                passAllFilters = false;
                return false; //stop outer loop
            }
        });
        return passAllFilters;
    }
    function filterSystem() {
        $items.hide().filter(function () {
            return filterSlider(this) && filterCheckboxes(this);
        }).show();
    }
});
$(".column-admin .button-edit").each(function(index) {
    $(this).on("click", function() {
        $('#edit_product').modal("show");
        $.urlParam = function(name){
            var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
            return results[1] || 0;
        }
        var department_id_from_url = $.urlParam('department_id');
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
                var main_img_src =$('.image_modal_edit').find('img').attr('src');
                if(main_img_src !=''){
                    $('.small_images').css('display','block');
                }
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
                                    $('.small_images_modal_edit').append($('<div>')
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
                                                .attr('src', '/application/photo/small_images/' + department_id_from_url + '/' + res_small_img)
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
                            url: "/admin/Upload/?department_id_from_url="+department_id_from_url,
                            type: 'post',
                            data: fd,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                if (response != 0) {
                                    $('.image_modal_edit').find('img').attr('src','/application/photo/'+department_id_from_url+'/' + response);
                                    $('.small_images').css('display','block');
                                    $('.preview').remove();
                                    $('.modal_main_image_block')
                                        .append($('<div>')
                                            .addClass('preview')
                                            .css('width','160px')
                                            .css('margin-left','50px')
                                            .css('padding','10px')
                                            .append($('<img>')
                                                .attr('src', '/application/photo/'+department_id_from_url+'/' + response)
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
                                url: "/admin/UpSmImg/?department_id_from_url="+department_id_from_url,
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
                                                                    .attr('src', '/application/photo/small_images/' + department_id_from_url + '/' + img_small)
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
                                                        $('.preview_small'+iid_small_images).remove();
                                                        $('.preview_small').css('margin-top','-25px');
                                                    });
                                                }
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
                        var end_date_discount = $('#datetimepicker6 input#bday').val();
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
                        var end_date_special_offer = $('#datetimepicker8 input#bday_special_offer').val();
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
                        }
                    });
                });
            },
            error: function () {
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