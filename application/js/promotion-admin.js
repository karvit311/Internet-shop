// PROMOTION
$('form[id="save_form"]').validate({
    rules: {
        description_promotion: {
            required: true
        },
        myselect: { valueNotEquals: "-1"
        },
        short_description_promotion: {
            required: true
        },
        title_promotion: {
            required: true
        },
        type_promotion:{
            required: true
        },
        datepicker_promotion:{
            required: true
        },
    },
    highlight: function (element) {
        $(element).closest('.form-group').addClass('has-error');
        $(element).closest('.form-group input[type=text]').addClass('has-error');
        $(element).closest('.form-group input[type=textarea]').addClass('has-error');
        $(element).closest('.form-group select[name=myselect]').addClass('has-error');
        $(element).closest('.input-group ').addClass('has-error');
    },
    unhighlight: function (element) {
        $(element).closest('.form-group').removeClass('has-error');
        $(element).closest('.form-group input[type=text]').addClass('has-error');
        $(element).closest('.form-group input[type=textarea]').addClass('has-error');
        $(element).closest('.form-group select[name=myselect]').removeClass('has-error');
        $(element).closest('.input-group ').removeClass('has-error');
    }
});
$.validator.addMethod("valueNotEquals", function(value, element, arg){
    return arg != value;
}, "Value must not equal arg.");
$('#SelectDepartment').change(function(){
    var department_id = $('#SelectDepartment option:selected').attr('department_id');
    var promotion_id = $('.id').val();
    $.ajax({
        type:"post",
        url:"/admin/GetProductsByDepartmentId",
        data:"department_id="+department_id,
        dataType:"json",
        success:function(res){
            console.log(res);
            $.each(res, function(iy, ely) {
                var id = ely['id'];
                var name = ely['name'];
                var img = ely['photo'];
                var promotion = ely['promotion'];
                $('.place_to_append_small_products').show();
                if(promotion != 0) {
                    var res_promotion = 'checked';
                }
                $('.place_to_append_small_products').append($('<div>')
                    .addClass('small_products_div')
                    .append($('<img>')
                        .attr('src', '/application/photo/'+department_id+'/' + img)
                        .addClass('small_products_img')
                        .attr('iid', id)
                        .css('width', '40px')
                        .css('height', '40px')
                    )
                    .append($('<input type="checkbox"  class="check"/> ' + name + '<br />')
                        .attr('iid', id)
                        .attr('checked',res_promotion)
                    )
                )
                $('.check').change(function(){
                    var selected = [];
                    $('.place_to_append_small_products input:checked').each(function() {
                        selected.push($(this).attr('iid'));
                    });
                    console.log(selected);
                    $.ajax({
                        type:"post",
                        url:"/admin/UpdateSelectedPromotionsCheckboxes",
                        data:"selected_checkboxes="+selected+"&promotion_id="+promotion_id,
                        success:function(){
                        },
                        error:function(){
                        }
                    })
                });
            });
        },
        error:function(){
        }
    })
});
$('#submit_form_admin_promotion_edit').click(function() {
    $('form[id="save_form"]').validate();
    if ($('form[id="save_form"]').valid()) {
        var id = $('.id').val();
        var description_promotion = $('.description_promotion').val();
        var short_description_promotion = $('.short_description_promotion').val();
        var title_promotion = $('.title_promotion').val();
        var type_promotion = $('.type_promotion').val();
        var end_date = $('#datepicker_promotion').val();
        $.ajax({
            type: "POST",
            url: "/admin/UpdatePromotionValue",
            data: "id=" + id + "&description=" + description_promotion + "&left_block=" + short_description_promotion + "&title=" + title_promotion + "&type=" + type_promotion + "&end_date=" + end_date,
            success: function (res) {
            },
            error: function () {
            }
        });
    }
});
$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
});
$(".pre_promotion_delete").each(function() {
    $(this).on("click", function(){
        var iid = $(this).attr('iid');
        var YOUR_MESSAGE_STRING_CONST = "Are you sure to Delete this promotion?";
        confirmDialog(YOUR_MESSAGE_STRING_CONST, function(){
            $.ajax({
                type: "POST",
                url: "/admin/DeletePromotion",
                data: "iid=" + iid ,
                success: function (response) {
                    if($.trim(response == 1)) {
                        $("#flash-msg-deleting-promotion").show();
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
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
$(".pre_promotion_edit").each(function() {
    $(this).on("click", function() {
        var iid = $(this).attr('iid');
        $('.id').val(iid);
        $('#datetimepicker7').datetimepicker({
        });
        $('#edit_promotion').modal("show");
        $.ajax({
            type: "POST",
            url: "/admin/GetPromotionByIid",
            data: "iid=" + iid,
            dataType: "json",
            success: function (res) {
                $.each(res, function(iy, ely) {
                    var value_promotion = ely['value_promotion'];
                    var short_value_promotion = ely['left_block'];
                    var title_promotion = ely['title'];
                    var type_promotion = ely['type'];
                    var end_date = ely['end_date'];
                    $('.description_promotion').val(value_promotion);
                    $('.short_description_promotion').val(short_value_promotion);
                    $('.title_promotion').val(title_promotion);
                    $('.type_promotion').val(type_promotion);
                    $('#datepicker_promotion').val(end_date);
                });
            },
            error: function () {
            }
        });
    });
});
// PROMOTION _END_