<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Log in</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div class="container">
<!--            --><?php //if ($_SESSION['admin'] = "admin") {
//                if (isset($_SESSION['admin_role'])) {
//                    if ($_SESSION['admin_role'] == 'admin') {?>
                        <form id="login_form1-adminka" method="post" class="feedbacko-admin-login">
                            <div class="form-group">
                                <label for="login">Login</label>
                                <input type="text" class="form-control is-valid" name="login" id="login-adminka" placeholder="Login" >
                                <label for="password" >Password</label>
                                <input type="password" class="form-control is-valid " name="password" id="password-adminka" placeholder="Password">
                            </div>
                            <button class="btn btn-primary login" id="login_in_adminka" type="submit">Log in</button>
                        </form>
            <script>
                // $('#login_in_adminka').click(function(){
                //     location.reload();
                //     $(location).attr("href", '/admin/adminka');
                // });
            </script>
                        <?php
//                    } else {
//                        ?>
<!--                       ERROR PRIVILEGE-->
<!--                        <div class="alert alert-danger  alert-dismissable error-privilege"-->
<!--                             id="flash-msg-privilege-orders">-->
<!--                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">-->
<!--                                ×-->
<!--                            </button>-->
<!--                            <h4><i class="icon fa fa-check"></i>ERROR!</h4>-->
<!--                            <p>Вы не являетесь администратором!</p>-->
<!--                        </div>-->
<!--                    --><?php
//                    }
//                }else{ ?>
<!--                    <script type="text/javascript">-->
<!--                        window.location.href = '/main/Login';-->
<!--                    </script>-->
<!--                --><?php //}
//            } else {
//                header('Location: /main/Login');
//            }
            ?>
        </div>
    </body>
</html>
<script src="/application/js/admin.js"></script>