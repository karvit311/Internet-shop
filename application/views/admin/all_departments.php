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
                            if($_SESSION['admin'] = "admin")
                            {
                                if (isset($_SESSION['admin_role'])) {
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
<script src="/application/js/admin.js"></script>

