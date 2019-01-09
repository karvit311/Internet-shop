<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sign up</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
                    <button class="btn btn-primary sign_up" id="sign_up_new_user" type="submit">Sign up</button>
                </form>
            </div>
        </div>
    </body>
</html>
<script src="/application/js/signup-index.js"></script>
