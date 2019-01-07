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
            <form id="login_form1-adminka" method="post" class="feedbacko-admin-login">
                <div class="form-group">
                    <label for="login">Login</label>
                    <input type="text" class="form-control is-valid" name="login" id="login" placeholder="Login" >
                    <label for="password" >Password</label>
                    <input type="password" class="form-control is-valid " name="password" id="password" placeholder="Password">
                </div>
                <button class="btn btn-primary login" id="login" type="submit">Log in</button>
            </form>
        </div>
        <?php //print_r($_SESSION);?>
    </body>
</html>

<script>
    $("button#login").click(function() {
        var login = $('#login').val();
        var password = $('#password').val();
        $.ajax({
            type: "POST",
            url: "/admin/CheckData",
            data: "login=" +login + "&password="+password,
            success: function (response) {
                if($.trim(response) == 1) {
                    window.location.replace("/admin/index");
                }else{
                    alert('Проверьте корректность введенных данных!')
                }
            },
            error: function () {
                 alert("Error");
            }
        });
    });
</script>