<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <title>Панель управления - Клиенты</title>
    </head>
    <body>
        <div id="block-body-admin">
            <?php
                include("block-header.php");
            ?>
            <div id="block-content-admin">
                <?php
                if ($_SESSION['admin'] = "admin") {
                    if (isset($_SESSION['admin_role'])) {
                        if ($_SESSION['admin_role'] == 'admin') {
                            $_SESSION['urlpage'] = "<a href='/admin/index' >Главная</a> \ <a href='/admin/addAdministrators' >Добавление администратора</a>";
                            ?>
                            <div id="block-parameters">
                                <p id="title-page">Добавление администратора</p>
                            </div>
                            <form method="post" id="form-info">
                                <ul id="info-admin">
                                    <li><label>Логин</label><input type="text" name="admin_login" class="admin_login"/></li>
                                    <li><label>Пароль</label><input type="password" name="admin_pass" class="admin_pass"/></li>
                                    <li><label>ФИО</label><input type="text" name="admin_fio" class="admin_fio"/></li>
                                    <li><label>Должность</label><input type="text" name="admin_role" class="admin_role"/></li>
                                    <li><label>E-mail</label><input type="text" name="admin_email" class="admin_email"/></li>
                                    <li><label>Телефон</label><input type="text" name="admin_phone" class="admin_phone"/></li>
                                </ul>
                                <h3 id="title-privilege">Привилегии</h3>
                                <p id="link-privilege"><a id="select-all">Выбрать все</a> | <a id="remove-all">Снять все</a></p>
                                <div class="block-privilege">
                                    <ul class="privilege">
                                        <li><h3>Заказы</h3></li>
                                        <li>
                                            <input type="checkbox" name="view_orders" id="view_orders" value="1"/>
                                            <label for="view_orders">Просмотр заказов.</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" name="accept_orders" id="accept_orders" value="1"/>
                                            <label for="accept_orders">Обработка заказов.</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" name="delete_orders" id="delete_orders" value="1"/>
                                            <label for="delete_orders">Удаление заказов.</label>
                                        </li>
                                    </ul>
                                    <ul class="privilege">
                                        <li><h3>Товары</h3></li>
                                        <li>
                                            <input type="checkbox" name="add_tovar" id="add_tovar" value="1"/>
                                            <label for="add_tovar">Добавление товаров.</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" name="edit_tovar" id="edit_tovar" value="1"/>
                                            <label for="edit_tovar">Изменение товаров.</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" name="delete_tovar" id="delete_tovar" value="1"/>
                                            <label for="delete_tovar">Удаление товаров.</label>
                                        </li>
                                    </ul>
                                    <ul class="privilege">
                                        <li><h3>Отзывы</h3></li>
                                        <li>
                                            <input type="checkbox" name="accept_reviews" id="accept_reviews" value="1"/>
                                            <label for="accept_reviews">Модерация отзывов.</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" name="delete_reviews" id="delete_reviews" value="1"/>
                                            <label for="delete_reviews">Удаление отзывов.</label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="block-privilege">
                                    <ul class="privilege">
                                        <li><h3>Клиенты</h3></li>
                                        <li>
                                            <input type="checkbox" name="view_clients" id="view_clients" value="1"/>
                                            <label for="view_clients">Просмотр клиентов.</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" name="delete_clients" id="delete_clients" value="1"/>
                                            <label for="delete_clients">Удаление клиентов.</label>
                                        </li>
                                    </ul>
                                    <ul class="privilege">
                                        <li><h3>Новости</h3></li>
                                        <li>
                                            <input type="checkbox" name="add_news" id="add_news" value="1"/>
                                            <label for="add_news">Добавление новостей.</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" name="delete_news" id="delete_news" value="1"/>
                                            <label for="delete_news">Удаление новостей.</label>
                                        </li>
                                    </ul>
                                    <ul class="privilege">
                                        <li><h3>Категории</h3></li>
                                        <li>
                                            <input type="checkbox" name="add_category" id="add_category" value="1"/>
                                            <label for="add_category">Добавление категорий.</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" name="delete_category" id="delete_category" value="1"/>
                                            <label for="delete_category">Удаление категорий.</label>
                                        </li>
                                    </ul>
                                    <ul class="privilege">
                                        <li><h3>Работники</h3></li>
                                        <li>
                                            <input type="checkbox" name="add_worker" id="add_worker" value="1"/>
                                            <label for="add_worker">Добавление работника.</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" name="edit_worker" id="edit_worker" value="1"/>
                                            <label for="edit_worker">Редактирование работника.</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" name="delete_worker" id="delete_worker" value="1"/>
                                            <label for="delete_worker">Удаление работника.</label>
                                        </li>
                                    </ul>
                                    <ul class="privilege">
                                        <li><h3>Поставки</h3></li>
                                        <li>
                                            <input type="checkbox" name="add_delivery" id="add_delivery" value="1"/>
                                            <label for="add_delivery">Добавление поставки.</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" name="edit_delivery" id="edit_delivery" value="1"/>
                                            <label for="edit_delivery">Редактирование поставки.</label>
                                        </li>
                                        <li>
                                            <input type="checkbox" name="delete_delivery" id="delete_delivery" value="1"/>
                                            <label for="delete_delivery">Удаление поставки.</label>
                                        </li>
                                    </ul>
                                </div>
                                <div class="block-privilege">
                                    <ul class="privilege">
                                        <li><h3>Администраторы</h3></li>
                                        <li>
                                            <input type="checkbox" name="view_admin" id="view_admin" value="1"/>
                                            <label for="view_admin">Просмотр администраторов.</label>
                                        </li>
                                    </ul>
                                </div>
                                <p align="right"><input type="submit" id="submit_form" name="submit_add" value="Добавить"/></p>
                            </form>
                            <?php
                        } else {
                            ?>
                            <!-- ERROR PRIVILEGE-->
                            <div class="alert alert-danger  alert-dismissable error-privilege"  id="flash-msg-privilege-administrators">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <h4><i class="icon fa fa-check"></i>ERROR!</h4><p>У Вас нет прав на редактирование администраторов!</p>
                            </div>
                            <?php
                        }
                    }else{ ?>
                <script type="text/javascript">
                    window.location.href = '/main/Login';
                </script>
            <?php }
                }else{?>
                    <?php
                    header('Location: /main/Login');
                }
                ?>
            </div>
        </div>
    </body>
</html>

