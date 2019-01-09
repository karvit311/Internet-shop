// VIEW ORDER
$('.view-order-link .green').click(function(){
    var order_id = $(this).attr('order_id');
    $.ajax({
        type:"post",
        url:"/admin/acceptOrderAdmin",
        data:"order_id="+order_id,
        success:function(response){
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
// VIEW ORDER _END_