<?php
$_SESSION['urlpage'] = "<a href='/admin/index' >Главная</a> \ <a href='/admin/administrators' >Администраторы</a>";?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Панель управления- Администраторы</title>
    </head>
    <body>
        <div id="block-body-admin">
            <?php
                include("block-header.php");
            ?>
            <div id="block-content-admin">
                <?php if ($_SESSION['admin'] = "admin") {
                    if (isset($_SESSION['admin_role'])) {
                        if ($_SESSION['admin_role'] == 'admin') {?>
                            <div id="block-parameters">
                                <p id="title-page" >Администраторы</p>
                                <p align="right" id="add-style"><a href="/admin/AddAdministrators" >Добавить админа</a></p>
                            </div>
                            <?php
                            if ($result_count > 0)
                            {
                                foreach ($result as $key => $row) {
                                    echo '
                                        <ul id="list-admin" >
                                        <li>
                                        <h3>'.$row["fio"].'</h3>
                                        <p><strong>Должность</strong> - '.$row["role"].'</p>
                                        <p><strong>E-mail</strong> - '.$row["email"].'</p>
                                        <p><strong>Телефон</strong> - '.$row["phone"].'</p>
                                        <p class="links-actions" align="right" ><a class="green" href="/admin/admin/edit-administrators?id='.$row["id"].'" >Изменить</a> | <a class="delete" rel="/admin/admin/administrators?id='.$row["id"].'&action=delete" >Удалить</a></p>
                                        </li>
                                        </ul>   
                                    ';
                                }
                            }
                        } else {
                            ?>
                            <!-- ERROR PRIVILEGE-->
                            <div class="alert alert-danger  alert-dismissable error-privilege"
                                 id="flash-msg-privilege-orders">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">
                                    ×
                                </button>
                                <h4><i class="icon fa fa-check"></i>ERROR!</h4>
                                <p>У Вас нет прав на редактирование администраторов!</p>
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
                }
                ?>
            </div>
        </div>
    </body>
</html>