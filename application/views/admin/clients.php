<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <title>Панель управления - Клиенты</title>
    </head>
    <body>
        <?php
        $_SESSION['urlpage'] = "<a href='/site/index'>Клиенты</a>";?>
        <div id="block-body-admin">
            <!-- DELETING SUCCESS-->
            <div class="alert alert-success deleting_review alert-dismissable" style="display: none;" id="flash-msg-deleting-client">
                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                <h4><i class="icon fa fa-check"></i>Success!</h4><p>Client've  successfully deleted!</p>
            </div>
            <?php include("block-header.php");?>
            <div id="block-content-admin">
                <?php  $get_clients = new \Application\models\Users();
                $res_count_users = $get_clients->count_all_users();
                foreach($res_count_users as $res_count_user){
                    $result_count = $res_count_user['total'];
                }?>
                <div id="block-parameters">
                    <p id="count-client" >Клиенты - <strong><?= $result_count; ?></strong></p>
                </div>
                <?php
                if($_SESSION['admin'] = "admin") {
                    if (isset($_SESSION['admin_role'])) {
                        if($_SESSION['admin_role'] == 'admin-client' || $_SESSION['admin_role'] == 'admin'){?>
                            <?php
                            if ($result_count > 0)
                            {
                                $get_users = new \Application\models\Users();
                                $result = $get_users->get_users();
                                foreach ($result as $key => $row) {
                                    $today = date("Y-m-d H:i:s");
                                    $years_old = $today -$row['birth_day'];
                                    ?>
                                    <div class="block-clients">
                                        <p class="client-email" ><strong><?php
                                                if($row["email"]){
                                                    echo $row["email"];
                                                }else{
                                                    echo 'guest';
                                                }?></strong></p>
                                        <p class="client-links" ><a client_id="<?= $row['id'];?>" class="delete" href="#" >Удалить</a></p>
                                        <ul>
                                            <li><strong>E-Mail</strong> - <?=$row["email"]?></li>
                                            <li><strong>ФИО</strong> - <?= $row["lastname"]. $row["name"]. $row["patronymic"]?></li>
                                            <li><strong>Адресс</strong> - <?=$row["address"]?></li>
                                            <li><strong>Телефон</strong> - <?=$row["phone"]?></li>
                                            <li><strong>IP</strong> - <?=$row["ip_address"]?></li>
                                            <li><strong>Лет</strong> - <?= $years_old?></li>
                                        </ul>
                                    </div>
                                    <?php
                                }
                            }
                        }else{?>
                            <!-- ERROR PRIVILEGE-->
                            <div class="alert alert-danger  alert-dismissable error-privilege"  id="flash-msg-privilege-orders">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <h4><i class="icon fa fa-check"></i>ERROR!</h4><p>У Вас нет прав на редактирование клиентов!</p>
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
<script src="/application/js/admin.js"></script>