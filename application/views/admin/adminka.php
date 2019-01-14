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
                    <input type="text" class="form-control is-valid" name="login" id="login-adminka" placeholder="Login" >
                    <label for="password" >Password</label>
                    <input type="password" class="form-control is-valid " name="password" id="password-adminka" placeholder="Password">
                </div>
                <button class="btn btn-primary login_in_adminka" id="login_in_adminka" type="submit">Log in</button>
            </form>
        </div>
    </body>
</html>
<script src="/application/js/admin.js"></script>