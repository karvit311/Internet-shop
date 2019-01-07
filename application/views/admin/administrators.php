<?php
if (isset($_GET["logout"]))
{
    unset($_SESSION['auth_admin']);
    return $this->redirect('/admin/admin/login');
}
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
                <div id="block-parameters">
                    <p id="title-page" >Администраторы</p>
                    <p align="right" id="add-style"><a href="/admin/AddAdministrators" >Добавить админа</a></p>
                </div>
                <?php
                if ($_SESSION['view_admin'] = 1)
                {
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
                }else{
                    echo '<p id="form-error" align="center">У вас нет прав на просмотр администраторов!</p>';
                }?>
            </div>
        </div>
    </body>
</html>