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
                if ($.trim(response) == 1) {
                    window.location.replace("/main/Login");
                }
            },
            error: function () {
            }
        });
    }
});
$('#datetimepicker1').datetimepicker({
    defaultDate: new Date()
});