<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign up</title>
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

    <div class="row">
        <form id="sign_up_form" method="post" class="feedback" action="/main/Signup">
            <div class="form-group email_input_signup " >
                <div class="col-md-6">
                    <label for="name">Name</label>
                    <input type="text" class="form-control is-valid" name="name" id="name"  placeholder="First name" required >
                </div>
            </div>
            <div class="form-group email_sign_up " >
                <div class="col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control is-valid" name="email"  id="email"  placeholder="Email" >
                    <span class="help-block email_signup_span" style="display:none;">This email is already taken!</span>
                </div>
            </div>
            <div class="form-group " >
                <div class="col-md-6">
                    <label for="password" >Password</label>
                    <input type="password" class="form-control is-valid" name="password" id="password"  placeholder="Password">
                </div>
            </div>
            <div class="form-group validationLastname" >
                <div class="col-md-6">
                    <label for="validationLastname">Last name</label>
                    <input type="text" class="form-control is-valid" name="lastname" id="validationLastname"  placeholder="Last name">
                </div>
            </div>
            <div class="form-group" >
                <div class="col-md-6">
                    <label for="validationPatronymic">Patronymic</label>
                    <input type="text" class="form-control is-valid" name="patronymic" id="validationPatronymic"  placeholder="Patronymic" >
                </div>
            </div>
            <div class="col-md-6">
                <label for="validationBirthDay">Birth Day</label>
                <div class="form-group" >
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' class="form-control" name="bday" id="validationBirthDay"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
<!--            <div class="col-md-3 check_sign_up">-->
<!--                <div class="form-check  ">-->
<!--                    <input class="form-check-input is-valid" type="checkbox" name="check_form" value="1" id="invalidCheck3" required >-->
<!--                    <label class="form-check-label" for="invalidCheck3">-->
<!--                        Agree to terms and conditions-->
<!--                    </label>-->
<!--                </div>-->
<!--            </div>-->
            <button class="btn btn-primary sign_up" id="sign_up_new_user" type="submit">Sign up</button>
        </form>
    </div>
</div>
</body>
</html>
<style>
    #sign_up_form{
        margin-top:100px;
        height: 325px;
    }
    .email_input_signup{
        margin-top:15px;
    }
    .has-error input[type="checkbox"] {
        outline: 0.1px solid red;
    }
    #sign_up_form{
        border:1px solid #ddd;
        padding:10px;
    }
    .sign_up{
        width: 150px;
        /*margin-right:85px;*/
        float:right;
        margin-top:30px;
         /*display: flex;justify-content: space-between;*/
    }
    .check_sign_up{
        float:right;
        /*margin-right: 10px;*/
        margin-top:33px;
    }
    .error-email{
        outline:1px solid red;
    }
</style>
<script>
    $('form[id="sign_up_form"]').validate({
        rules: {
            name: {
                minlength: 3,
                maxlength: 15,
                required: true
            },
            lastname: {
                minlength: 3,
                maxlength: 15
            },
            patronymic: {
                minlength: 3,
                maxlength: 15
            },
            password: {
                minlength: 3,
                maxlength: 15,
                required: true
            },
            email: {
                email: true,
                required: true,
                unique : true
            }
        },
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
            $(element).closest('.form-check ').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
            $(element).closest('.form-check ').removeClass('has-error');
        }
    });
    var response = false;
    $.validator.addMethod("unique", function(value, element,params) {
        $('#email').on('input', function () {
            var email = $('#email').val();
            $.ajax({
                type: "POST",
                url: "/main/CheckUnique",
                data: "email=" + email,
                success: function (res) {
                    if (($.trim(res)) == 1) {
                        response = false;
                    } else {
                        $('input[type=email]').removeClass('has-error');
                        $('.email_signup_span').hide();
                        response = true;
                    }
                },
                error: function () {
                    // alert("Error");
                }
            });
        });
        return response;
    },
        jQuery.validator.format("Email already in use")
    );
    $("button#sign_up_new_user").click(function() {
        var name= $('#name').val();
        var password= $('#password').val();
        var email= $('#email').val();
        var lastname = $('#lastname').val();
        var patronymic= $('#patronymic').val();
        $('form[id="sign_up_form"]').validate();
        if ($('form[id="sign_up_form"]').valid()) {
            $.ajax({
                type: "POST",
                url: "/main/InsertNewUser",
                data: "name="+name+"&password="+password+"&email="+email+"&lastname="+lastname+"&patronymic="+patronymic,
                success: function (response) {
                    // alert($.trim(response));
                    if ($.trim(response) == 1) {
                        window.location.replace("/main/Login");
                    }
                },
                error: function () {
                    // alert("Error");
                }
            });
        }
    });
    $('#datetimepicker1').datetimepicker({
        format: 'DD/MM/YYYY',
        defaultDate: new Date()
    });
</script>
