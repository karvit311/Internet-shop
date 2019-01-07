<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$_SESSION['urlpage'] = "<a href='/site/index'>Категории</a>";?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Управление категориями</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php
        $departments = new \Application\models\Department();
        $res_departments = $departments->get_departments();
        ?>
        <div class="container">
            <div class="row">
                <div class="body-admin">
                    <div id="block-body-admin">
                        <?php
                            include("block-header.php");
                        ?>
                        <div id="block-content-admin">
                            <?php
                            if($_SESSION['name'] = "admin")
                            {
                                if(isset($_GET['logout']))
                                {
                                    unset($_SESSION['auth_admin']);
                                    return $this->redirect('/user/login');
                                }
                                if($_SESSION['admin_role'] == 'admin-client' || $_SESSION['admin_role'] == 'admin'){?>
                                    <!-- ADDING SUCCESS-->
                                    <div class="alert alert-success selecting-department alert-dismissable" style="display: none;" id="flash-msg-adding-department">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        <h4><i class="icon fa fa-check"></i>Success!</h4><p>Department've  successfully added!</p>
                                    </div>
                                    <!-- DELETING SUCCESS-->
                                    <div class="alert alert-success deleting_department alert-dismissable" style="display: none;" id="flash-msg-deleting-department">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        <h4><i class="icon fa fa-check"></i>Success!</h4><p>Department've  successfully deleted!</p>
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
                                                    <h3 class="modal-title">Add new department</h3>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <?php
                                                    $posts = new \Application\models\Workers();
                                                    $res_posts = $posts->get_posts();?>
                                                    <form method="post" class="feedback">
                                                        <div class="form-group">
                                                            <label for="FormControlInputDepartment">Department:</label>
                                                            <input type="text" name="department" id="FormControlInputDepartment" class="form-control" placeholder="Department">
                                                            <div id="FormControlInputPhotoDiv">
                                                                <label for="FormControlInputPhoto">Photo:</label>
                                                            </div>
                                                            <div class="modal_small_img_uploads">
                                                                <input type="file" id="file" name="file" />
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="submit" name="add_new_department" id="add_new_department" class="btn btn-info" data-dismiss="modal">Добавить</button>
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
                                                    <h3 class="modal-title">Add new worker</h3>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                    <?php
                                                    $posts = new \Application\models\Workers();
                                                    $res_posts = $posts->get_posts();
                                                    ?>
                                                    <form method="post" class="feedback" >
                                                        <div class="form-group admin_upload_photo">
                                                            <label for="FormControlInputDepartment">Department:</label>
                                                            <input type="text" name="department" id="FormControlInputDepartment" class="form-control" placeholder="Department">
                                                            <div class="FormControlInputPhotoDiv">
                                                                <label for="FormControlInputPhoto">Photo:</label>
                                                                <img width="250px" height="300px" id="FormControlInputPhoto"/>
                                                            </div>
                                                            <div class="modal_small_img_uploads">
                                                                <input type="file" id="file" name="file" />
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="submit" name="update_new_department" id="update_new_department" class="btn btn-info" data-dismiss="modal" >Обновить</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!--END UPDATE MODAl -->
                                    <div id="treeview"></div>
                                    <?php
                                }else{?>
                                    <!-- ERROR PRIVILEGE-->
                                    <div class="alert alert-danger  alert-dismissable error-privilege"  id="flash-msg-privilege-orders">
                                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                        <h4><i class="icon fa fa-check"></i>ERROR!</h4><p>У Вас нет прав на редактирование категорий!</p>
                                    </div>
                                    <?php
                                }
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
    $(document).ready(function(){
        $.ajax({
            url: "/admin/GetTreeviewDepartmentEdition",
            method:"POST",
            dataType: "json",
            success: function(data)
            {
                $('#treeview').treeview({
                    data: data,
                });
                $('#treeview').click(function() {
                    $('.glyphicon.glyphicon-trash').on("click", function(e){
                        var iid = $(this).attr('data-iid');
                        alert(iid);
                        var YOUR_MESSAGE_STRING_CONST = "Are you sure to Delete this worker?";
                        confirmDialog(YOUR_MESSAGE_STRING_CONST, function(){
                            $.ajax({
                                type: "POST",
                                url: "/admin/DeleteDepartmentAdmin",
                                data: "iid=" + iid ,
                                success: function (response) {
                                    if(response == 1) {
                                        $("#flash-msg-deleting-department").show();
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
                });
                $('#treeview').click(function() {
                    $("#updateModal").on("show.bs.modal", function(e) {
                        var iid = $(e.relatedTarget).data('iid');
                        $('#datetimepicker2').datetimepicker({
                            // format: 'DD/MM/YYYY',
                            defaultDate: new Date()
                        });
                        $(".modal-body #res").html(iid);
                        $.ajax({
                            type: "POST",
                            url: "/admin/GetByIdDepartment",
                            data: "iid="+iid,
                            dataType: "json",
                            success: function (response) {
                                var departments = JSON.stringify(response);
                                var obj = JSON.parse(departments);
                                $.each(obj, function(i, el) {
                                    var id = el['id'];
                                    var department = el['department'];
                                    var parent_id = el['parent_id'];
                                    var photo = el['photo'];
                                    $('.modal-body #FormControlInputDepartment').attr('value', department);
                                    if(parent_id != 0) {
                                        $('.modal-body #FormControlInputPhoto').attr('src', '/application/photo/department/' + photo);
                                    }
                                    $('.modal_small_img_uploads input[type=file]').change(function(ei) {
                                        var info = ei.target.files;
                                        console.log(info);
                                        var fileName = ei.target.files[0].name;
                                        var fd = new FormData();
                                        var files = ei.target.files[0];
                                        fd.append('file',files);
                                        $.ajax({
                                            url: "/admin/UploadImageDepartment/?department_id="+id,
                                            type: 'post',
                                            data: fd,
                                            contentType: false,
                                            processData: false,
                                            success: function (response) {
                                                alert(response);
                                                if (response != 0) {
                                                    $('.FormControlInputPhotoDiv').find('img').remove();
                                                    $('.FormControlInputPhotoDiv').append($('<img>')
                                                        .attr('src','/application/photo/department/'+response)
                                                        .css('width','250px')
                                                        .css('height','300px')
                                                        .css('margin-top','20px')
                                                    )
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "/admin/UpdatePhotoDepartmentAdmin",
                                                        data: "photo=" + response+"&department_id="+id,
                                                        success: function (res) {
                                                            $('#update_new_department').click(function() {
                                                                var department = $('#FormControlInputDepartment').val();
                                                                $.ajax({
                                                                    type: "POST",
                                                                    url: "/admin/UpdateDepartmentAdmin",
                                                                    data: "department=" + department+"&department_id="+id+"&parent_id="+parent_id ,
                                                                    success: function (res) {
                                                                        location.reload();
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
                                });
                            },
                            error: function () {
                                alert("Error");
                            }
                        });
                    });
                });
                $("#myModal").on("show.bs.modal", function(e) {
                    var iid = $(e.relatedTarget).data('iid');
                    var department = $(e.relatedTarget).data('department');
                    $('.modal_small_img_uploads input[type=file]').change(function(e) {
                        var info = e.target.files;
                        var fileName = e.target.files[0].name;
                        var fd = new FormData();
                        var files = $('#file')[0].files[0];
                        fd.append('file',files);
                        $.ajax({
                            url: "/admin/UploadImageDepartment",
                            type: 'post',
                            data: fd,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                if (response != 0) {
                                    $.ajax({
                                        type: "POST",
                                        url: "/admin/InsertPhotoDepartmentAdmin",
                                        data: "photo=" + response,
                                        success: function (res) {
                                            var parent_id = $.trim(res);
                                            //alert(parent_id);
                                            $('#FormControlInputPhotoDiv').append($('<img>')
                                                .attr('src','/application/photo/department/'+response)
                                                .css('width','250px')
                                                .css('height','300px')
                                                .css('margin-top','20px')
                                            )
                                            $('#add_new_department').click(function() {
                                                var department = $('#FormControlInputDepartment').val();
                                                $.ajax({
                                                    type: "POST",
                                                    url: "/admin/UpdateDepartmentAdmin",
                                                    data: "department=" + department+"&department_id="+parent_id+"&parent_id="+iid ,
                                                    success: function (res) {
                                                        if(res == 1) {
                                                            $("#flash-msg-adding-department").show();
                                                            setTimeout(function () {
                                                                location.reload();
                                                            }, 1000);
                                                        }
                                                    },
                                                    error: function () {}
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
                    $('#add_new_department').click(function() {
                        var department = $('#FormControlInputDepartment').val();
                        $.ajax({
                            type: "POST",
                            url: "/admin/InsertDepartmentAdminWithoutPhoto",
                            data: "department=" + department+"&department_id="+iid ,
                            success: function (res) {
                                if(res == 1) {
                                    $("#flash-msg-adding-department").show();
                                    setTimeout(function () {
                                        location.reload();
                                    }, 1000);
                                }
                            },
                            error: function () {}
                        });
                    });
                });
            }
        });
    });
</script>

