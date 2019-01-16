// LOGIN
$("button.login-main").click(function() {
    var email = $('#email').val();
    var password = $('#password').val();
    $.ajax({
        type: "POST",
        url: "/main/CheckData",
        data: "email=" +email + "&password="+password,
        success: function (response) {
            if($.trim(response) == 1) {
                window.location.replace("/main/index");
            }else{
                alert('Проверьте корректность введенных данных!')
            }
        },
        error: function () {
            // alert("Error");
        }
    });
});
// LOGIN _END_