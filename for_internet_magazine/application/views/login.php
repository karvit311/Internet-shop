<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Log in</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-1.12.2.min.js" integrity="sha256-lZFHibXzMHo3GGeehn1hudTAP3Sc0uKXBXAzHX1sjtk=" crossorigin="anonymous"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/application/css/css.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
    </head>
    <body>
        <div class="container">
            <form id="login_form1" method="post" class="feedbacko">
                <div class="form-group" >
                    <label for="email">Email</label>
                    <input type="email" class="form-control is-valid" name="email" id="email" placeholder="Email" >
                    <label for="password" >Password</label>

                    <input type="password" class="form-control is-valid " name="password" id="password" placeholder="Password">
                </div>
                <button class="btn btn-primary login" id="login" type="submit">Log in</button>
            </form>
        </div>

    </body>
</html>
<style>
    #login_form1{
        border:1px solid #ddd;
        display:inline-block;
        /*width:auto;*/
        width:300px;
        margin-left:450px;
        margin-top: 100px;
        /*padding:10px;*/
    }
    .feedbacko{
        display:block;
    }
    /*.password label{*/
       /*margin-bootom:10px;*/
    /*}*/
    /*#password{*/
        /*margin-top:-10px;*/
    /*}*/
    #login{
        /*margin-left:200px;*/
        /*float:right;*/
        /*display: flex;justify-content: space-between;*/
    }
</style>
<script>
    $("button#login").click(function() {
        var email = $('#email').val();
        var password = $('#password').val();
        $.ajax({
            type: "POST",
            url: "/main/CheckData",
            data: "email=" +email + "&password="+password,
            success: function (response) {
                // alert(response);
                if(response == 1) {
                    window.location.replace("/main/Delivery");
                    // $("#flash-msg-adding-new-user").show();
                //     setTimeout(function () {
                //         location.reload();
                //     }, 4000);
                }else{
                    alert('Проверьте корректность введенных данных!')
                }
            },
            error: function () {
                // alert("Error");
            }
        });
    });
</script>