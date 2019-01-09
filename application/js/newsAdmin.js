// NEWS ADMIN
$('.add_new_admin').click(function(){
    $('#myModal').modal("show");
    $('.modal_small_img_uploads input[type=file]').change(function(e) {
        var info = e.target.files;
        var fileName = e.target.files[0].name;
        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('file',files);
        $.ajax({
            url: "/admin/UploadImageNews",
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response != 0) {
                    $.ajax({
                        type: "POST",
                        url: "/admin/InsertPhotoNewsAdmin",
                        data: "photo=" + response,
                        success: function (res) {
                            var new_id_inserted = $.trim(res);
                            $('#FormControlInputPhotoDiv').find('img').remove();
                            $('#FormControlInputPhotoDiv').append($('<img>')
                                .attr('src','/application/photo/news/'+response)
                                .css('width','250px')
                                .css('height','300px')
                                .css('margin-top','20px')
                            )
                            $('#add_new_new').click(function() {
                                var title = $('#FormControlInputTitle').val();
                                var content = $('#description').val();
                                $.ajax({
                                    type: "POST",
                                    url: "/admin/UpdateNewsAdmin",
                                    data: "title=" + title + "&new_id="+new_id_inserted+"&content="+content ,
                                    success: function (res) {
                                        if(res == 1) {
                                            $("#flash-msg-adding-new").show();
                                            setTimeout(function () {
                                                location.reload();
                                            }, 1000);
                                        }
                                    },
                                    error: function () {
                                        // alert("Error");
                                    }
                                });
                            });
                        },
                        error: function(){
                        }
                    });
                } else {
                    alert('file not uploaded');
                }
            },
        });
    });
    $('#add_new_new').click(function(){
        var title = $('#FormControlInputTitle').val();
        var content = $('#description').val();
    });

});
$('.reviews-edition.delete').on("click", function(e){
    var iid = $(this).attr('new_id');
    alert(iid);
    var YOUR_MESSAGE_STRING_CONST = "Are you sure to Delete this worker?";
    confirmDialog(YOUR_MESSAGE_STRING_CONST, function(){
        $.ajax({
            type: "POST",
            url: "/admin/DeleteNewAdmin",
            data: "iid=" + iid ,
            success: function (response) {
                if(response == 1) {
                    $("#flash-msg-deleting-new").show();
                    setTimeout(function () {
                        location.reload();
                    }, 4000);
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
$('.reviews-edition.edit').click(function(){
    var new_id = $(this).attr('new_id');
    var new_title = $(this).attr('new_title');
    var new_img = $(this).attr('new_img');
    var new_content = $(this).attr('new_content');
    $('#updateModal').modal("show");
    $('#FormControlInputTitle').val(new_title);
    $('#FormControlInputPhotoNewsAdmin').attr('src',new_img);
    $('#description').html(new_content);
    $('#FormControlInputPhotoNewsAdmin').attr('new_id',new_id);
    $('#update_new').attr('new_id',new_id);
    $('.modal_small_img_uploads input[type=file]').change(function(e) {
        var new_id = $('#FormControlInputPhotoNewsAdmin').attr('new_id');
        var info = e.target.files;
        var fileName = e.target.files[0].name;
        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('file',files);
        $.ajax({
            url: "/admin/UploadImageNews",
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response != 0) {
                    $.ajax({
                        type: "POST",
                        url: "/admin/UpdatePhotoNewsAdmin",
                        data: "photo=" + response+"&new_id="+new_id,
                        success: function (res) {
                            alert(res);
                            $('#FormControlInputPhotoDiv').find('img').remove();
                            $('#FormControlInputPhotoDiv').append($('<img>')
                                .attr('src','/application/photo/news/'+response)
                                .css('width','250px')
                                .css('height','300px')
                                .css('margin-top','20px')
                            )
                            $('#update_new').click(function() {
                                var title = $('#FormControlInputTitle').val();
                                var content = $('#description').val();
                                $.ajax({
                                    type: "POST",
                                    url: "/admin/UpdateNewsAdmin",
                                    data: "title=" + title+"&new_id="+new_id+"&content="+content ,
                                    success: function (res) {
                                        if(res == 1) {
                                            $("#flash-msg-updating-new").show();
                                            setTimeout(function () {
                                                location.reload();
                                            }, 1000);
                                        }
                                    },
                                    error: function () {
                                    }
                                });
                            });
                        },
                        error: function(){
                        }
                    });
                } else {
                    alert('file not uploaded');
                }
            },
        });
    });
    $('#update_new').click(function() {
        var title = $('#FormControlInputTitle').val();
        var content = $('#description').val();
        var new_id = $(this).attr('new_id');
        $.ajax({
            type: "POST",
            url: "/admin/UpdateNewsAdminWithoutPhoto",
            data: "title=" + title+"&content="+content +"&new_id="+new_id,
            success: function (res) {
                alert($.trim(res));
                if($.trim(res) == 1) {
                    $("#flash-msg-adding-new").show();
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
            },
            error: function () {
            }
        });
    });
});
// NEWS ADMIN _END_