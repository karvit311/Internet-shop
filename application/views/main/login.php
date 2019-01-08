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
            <div class="row">
                <form id="login_form1" method="post" class="feedbacko">
                    <div class="form-group" >
                        <label for="email">Email</label>
                        <input type="email" class="form-control is-valid" name="email" id="email" placeholder="Email">
                        <label for="password" >Password</label>

                        <input type="password" class="form-control is-valid " name="password" id="password" placeholder="Password">
                    </div>
                    <button class="btn btn-primary login" id="login" type="submit">Log in</button>
                </form>
            </div>
        </div>
        <?php print_r($_SESSION);?>
    </body>
</html>

<script>
    $("button#login").click(function() {
        var email = $('#email').val();
        var password = $('#password').val();
        $.ajax({
            type: "POST",
            url: "/main/CheckData",
            data: "email=" +email + "&password="+password,
            success: function (response) {
                alert(response);
                if($.trim(response) == 1) {
                    window.location.replace("/main/index");
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