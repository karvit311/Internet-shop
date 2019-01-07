<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Панель управления - Новости</title>
    </head>
    <style>
        #FormControlInputTitle{
            margin-bottom:15px;
        }
        #FormControlInputPhoto{
            margin-bottom:15px;
        }
        #allNews ul li{
            list-style:none;
        }
        .admin_text_description_of_new{
            margin-bottom:15px;
        }
        .new_admin_div_edition{
            border:1px solid #ddd;
            padding:10px 10px 30px 10px;
            margin-left:-41px;
            margin-bottom:20px;
        }
        .new_admin_div_edition div{
            display:flex;
        }
        .new_admin_div_button{
            float:right;
        }
        .reviews-edition.edit a{
            color:#a06d0f;
        }
        .reviews-edition.delete a{
            color:red;
        }
        .new_admin_div_info{
            width:65%;
            display:block;
        }
        .new_admin_div_info li{
            list-style:none;
            float:left;
            margin-bottom:15px;
        }
        .new_admin_div_info h4{
            font-weight:bold;
            font-size:18px;
        }
        .new_admin_div_button p{
            margin-left:15px;
        }
        .add_new_admin{
            margin-left:585px;
            margin-top:15px;
            margin-bottom:15px;
        }
    </style>
    <body>
        <?php  $_SESSION['urlpage'] = "<a href='/admin/newsAdmin'>Новости</a>"; ?>
        <div id="block-body-admin">
            <?php include("block-header.php");?>
            <div id="block-content-admin">
                <?php
                if($_SESSION['admin'] = "admin")
                {
                    if(isset($_GET['logout']))
                    {
                        unset($_SESSION['auth_admin']);
                        return $this->redirect('/user/login');
                    }
                    if($_SESSION['admin_role'] == 'admin-new' || $_SESSION['admin_role'] == 'admin'){?>
                        <!-- ADDING SUCCESS-->
                        <div class="alert alert-success selecting-new alert-dismissable" style="display: none;" id="flash-msg-adding-new">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <h4><i class="icon fa fa-check"></i>Success!</h4><p>New've  successfully added!</p>
                        </div>
                        <!-- UPDATING SUCCESS-->
                        <div class="alert alert-success selecting-new alert-dismissable" style="display: none;" id="flash-msg-updating-new">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <h4><i class="icon fa fa-check"></i>Success!</h4><p>New've  successfully updated!</p>
                        </div>
                        <!-- DELETING SUCCESS-->
                        <div class="alert alert-success deleting_new alert-dismissable" style="display: none;" id="flash-msg-deleting-new">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <h4><i class="icon fa fa-check"></i>Success!</h4><p>New've  successfully deleted!</p>
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
                        <!-- The Modal -->
                        <div class="modal" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h3 class="modal-title">Add new!</h3>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form method="post" class="feedback" >
                                            <div class="form-group admin_add_new">
                                                <label for="FormControlInputTitle">Title:</label>
                                                <input type="text" name="title" id="FormControlInputTitle" class="form-control" placeholder="Title">
                                                <div id="FormControlInputPhotoDiv">
                                                    <label for="FormControlInputPhoto">Photo:</label>
                                                    <img width="250px" height="300px" id="FormControlInputPhoto"/>
                                                </div>
                                                <div class="modal_small_img_uploads">
                                                    <input type="file" id="file" name="file" />
                                                </div>
                                                <div class="admin_text_description_of_new">
                                                    <label for="comment">Description:</label>
                                                    <textarea class="form-control" rows="5" id="description"></textarea>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" name="add_new_new" id="add_new_new" class="btn btn-info" data-dismiss="modal" >Добавить</button>
                                    </div>
                                </div>
                            </div>
                        </div><!--END MODAl -->
                        <!-- The UPDATE Modal -->
                        <div class="modal" id="updateModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h3 class="modal-title">Update new</h3>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <form method="post" class="feedback" >
                                            <div class="form-group admin_update_new">
                                                <label for="FormControlInputTitle">Title:</label>
                                                <input type="text" name="title" id="FormControlInputTitle" class="form-control" placeholder="Title">
                                                <div id="FormControlInputPhotoDiv">
                                                    <label for="FormControlInputPhoto">Photo:</label>
                                                    <img width="250px" height="300px" id="FormControlInputPhoto"/>
                                                </div>
                                                <div class="modal_small_img_uploads">
                                                    <input type="file" id="file" name="file" />
                                                </div>
                                                <div class="admin_text_description_of_new">
                                                    <label for="comment">Description:</label>
                                                    <textarea class="form-control" rows="5" id="description"></textarea>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" name="update_new" id="update_new" class="btn btn-info" data-dismiss="modal" >Обновить</button>
                                    </div>
                                </div>
                            </div>
                        </div><!--END UPDATE MODAl -->
                        <button class="btn btn-default add_new_admin">Добавить новость!</button>
                        <div id="allNews">
                            <ul>
                                <?php
                                $news = new \Application\models\News();
                                $res_news = $news->get_news();
                                foreach($res_news as $res_new){?>
                                    <li>
                                        <div class="new_admin_div_edition">
                                            <div class="new_admin_div_info">
                                                <ul>
                                                    <li><h4><?= $res_new['title']?></h4></li>
                                                    <li><img src="/application/photo/news/<?= $res_new['img']?>" width="250px" height="300px" /></li>
                                                    <li><p><?= $res_new['content'];?></p></li>
                                                </ul>
                                            </div>
                                            <div class="new_admin_div_button">
                                                <p class="reviews-edition edit" new_title="<?= $res_new['title']?>" new_img="/application/photo/news/<?= $res_new['img']?>" new_content="<?= $res_new['content'];?>" new_id="<?= $res_new['id'];?>"><a href="#">Редактировать</a></p>
                                                <p class="reviews-edition delete" new_id="<?= $res_new['id'];?>"><a href="#">Удалить</a></p>
                                            </div>
                                        </div>
                                    </li>
                                <?php }?>
                            </ul>
                        </div>
                    <?php
                    }else{?>
                        <!-- ERROR PRIVILEGE-->
                        <div class="alert alert-danger  alert-dismissable error-privilege"  id="flash-msg-privilege-orders">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <h4><i class="icon fa fa-check"></i>ERROR!</h4><p>У Вас нет прав на редактирование новостей!</p>
                        </div>
                        <?php
                    }
                } else {
                header('Location: /main/Login');
                }?>
            </div>
        </div>
    </body>
</html>
<script>
    $('.add_new_admin').click(function(){
        $('#myModal').modal("show");
        $('.modal_small_img_uploads input[type=file]').change(function(e) {
           // var new_id = $('#FormControlInputPhoto').attr('new_id');
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
                                        data: "title=" + title+"&new_id="+new_id_inserted+"&content="+content ,
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
        $('#FormControlInputPhoto').attr('src',new_img);
        $('#description').html(new_content);
        $('#FormControlInputPhoto').attr('new_id',new_id);
        $('#update_new').attr('new_id',new_id);
        $('.modal_small_img_uploads input[type=file]').change(function(e) {
            var new_id = $('#FormControlInputPhoto').attr('new_id');
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
                    // alert("Error");
                }
            });
        });
    });
</script>