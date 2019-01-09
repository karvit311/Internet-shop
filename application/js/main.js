// PRODUCTS
$.getJSON("https://api.ipify.org/?format=json", function(e) {
    var ip_address =  e.ip;
    $(".column").attr('ip_address',ip_address);
});
$(".column").hover(
    function() {
        var iid = $(this).attr('iid');
        var real_price = $(this).attr('real_price');
        var new_price = $(this).attr('price');
        var email = $(this).attr('email');
        $(this).append($('<button>')
            .text('Добавить в корзину')
            .addClass('btn btn-danger buy')
            .attr('iid',iid)
            .attr('price',new_price)
            .attr('real_price',real_price)
            .attr('email',email)
        )
        $.getJSON("https://api.ipify.org/?format=json", function(e) {
            var ip_address =  e.ip;
            $(".buy").each(function() {
                $(this).attr('ip_address',ip_address);
            });
        });
        $(".buy").each(function() {
            $(this).on("click", function () {
                var iid = $(this).attr('iid');
                var ip_address = $(this).attr('ip_address');
                var new_price = $(this).attr('price');
                var real_price = $(this).attr('real_price');
                var email = $(this).attr('email');
                var quantity = 1;
                $.ajax({
                    type: "POST",
                    url: "/main/AddToCart",
                    data: "iid=" + iid + "&res_ip_address=" + ip_address+"&quantity="+quantity+"&price="+new_price+"&real_price="+real_price+"&email="+email,
                    success: function (res) {
                        if($.trim(res) == 1) {
                            $("#flash-msg-adding-tocart").show();
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        }
                    },
                    error: function () {
                    }
                });
            });
        });
    },
    function() {
        $(this).find('button').remove();
    }
);
$("#newsticker").jCarouselLite({
    vertical: true,
    hoverPause:true,
    btnPrev: "#news-prev",
    btnNext: "#news-next",
    visible: 3,
    auto:3000,
    speed:500
});
$(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
});
// PRODUCTS _ENED_
// INDEX
$('#right-block-container-menu-ul')
    .find("li").remove();
$('.left-block-menu-index').hover(function(){
    $('#right-block-container-menu').css('background-image', 'url("")');
    $('#right-block-container-menu').css('background', '#ffcaca');
    var department_id = $(this).attr('department_id');
    $.ajax({
        type: "POST",
        url: "/main/GetChildOfDepartment",
        data:  "main_department_id=" + department_id,
        dataType: "json",
        success: function (response) {
            $('#right-block-container-menu-ul')
                .find("li").remove();
            for(var i in response) {
                console.log(response[i]);
                $.each($(response[i]), function (iy, ely) {
                    var id = ely['id'];
                    var department = ely['department'];
                    var photo = ely['photo'];
                    $('#right-block-container-menu-ul')
                        .append($('<li>')
                            .addClass('right-block-menu-index')
                            .append($("<a>")
                                .attr('href','/main/products/?department_id='+ id+'&page=1')
                                .prepend($('<img>',{id:'theImg',src:'/application/photo/department/' + photo})
                                    .addClass('right-block-menu-index-img')
                                )
                                .append($('<div>')
                                    .addClass('right-block-img-text-block')
                                    .text(department)
                                )
                            )
                        )
                });
            }
        },
        error: function () {
            alert("Error");
        }
    });
    $('#right-block-container-menu-ul')
        .find("li").remove();
});
// INDEX _END_
// LOGIN
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
// LOGIN _END_