// PROMOTION INDEX
$('.addition_type_promotion button').click(function(){
    var promotion_id = $(this).attr('promotion_id');
    $.ajax({
        type:"post",
        url:"/main/GetArrayOfProductsPromotion",
        data:"promotion_id="+promotion_id,
        dataType:"json",
        success:function(res){
            console.log(res);
        },
        error:function(){
        }
    })
});
$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
});
// PROMOTION INDEX _END_