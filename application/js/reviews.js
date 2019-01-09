// REVIEWS
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
$(document).ready(function() {
    $('#select-links').click(function () {
        $("#list-links-sort").slideToggle(200);
    });
});
// REVIEWS _END_