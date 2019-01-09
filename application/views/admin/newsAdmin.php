<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Панель управления - Новости</title>
    </head>
    <body>
        <?php  $_SESSION['urlpage'] = "<a href='/admin/newsAdmin'>Новости</a>"; ?>
        <div id="block-body-admin">
            <?php include("block-header.php");?>
            <div id="block-content-admin">
                <?php
                if($_SESSION['admin'] = "admin") {
                    if (isset($_SESSION['admin_role'])) {
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
                                                        <label for="FormControlInputPhotoNewsAdmin">Photo:</label>
                                                        <img width="250px" height="300px" id="FormControlInputPhotoNewsAdmin"/>
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
                                                        <label for="FormControlInputPhotoNewsAdmin">Photo:</label>
                                                        <img width="250px" height="300px" id="FormControlInputPhotoNewsAdmin"/>
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
    </body>
</html>
<script src="/application/js/newsAdmin.js"></script>