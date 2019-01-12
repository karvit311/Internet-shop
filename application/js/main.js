// HEAD
$(".mycart").each(function() {
    $(this).on("click", function () {
        $.getJSON("https://api.ipify.org/?format=json", function(e) {
            var ip_address = e.ip;
            $(this).attr('ip_address',ip_address);
            var ip_address = $(this).attr('ip_address');
            $(location).attr("href", '/main/cart/?ip_address='+ip_address+"&action=oneclick");
        });
    });
});
// HEAD _END_
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
// VIEW
$(document).ready(function () {
    $.getJSON("https://api.ipify.org/?format=json", function (e) {
        var ip_address = e.ip;
        $(".my-rating-view").attr('ip_address', ip_address);
    });
    $(".my-rating-view").starRating({
        starSize: 25,
        callback: function (currentRating, $el) {
            var iid = $(".my-rating-view").attr('iid');
            var ip_address = $('.my-rating-view').attr('ip_address');
            $.ajax({
                url: "/main/InsertRating",
                method: "POST",
                data: "product_id=" + iid + "&rate=" + currentRating + "&ip_address=" + ip_address,
                success: function (data) {
                    var total_rated = $('.view-total-rated').text();
                    var res_total_rated = 1;
                    res_total_rated += Number(total_rated);
                    $('.view-total-rated').text(res_total_rated);
                    var sum_all_rate = $('.view-avg-rate-span').attr('sum_all_rate');
                    sum_all_rate = Number(sum_all_rate);
                    sum_all_rate += Number(currentRating);
                    var res_avg = sum_all_rate / res_total_rated;
                    $('.view-avg-rate-span').text(res_avg);
                }
            });
        }
    });
    load_business_data();

    function load_business_data() {
        var product_id_for_rating = $(".my-rating-view").attr('iid');
        $(this).attr('id', product_id_for_rating);
        $.ajax({
            url: "/main/Fetch",
            method: "POST",
            data: "product_id=" + product_id_for_rating,
            success: function (data) {
                $(".my-rating-view").starRating('setRating', data);
            }
        });
    }

    $('#quantity').change(function () {
        var quantity = $(this).val();
        $('#right-block-product-view-button-to-buy').attr('quantity', quantity);
        var price = $('#right-block-product-view-button-to-buy').attr('price');
        var final_price = price * quantity;
        var final_price = parseFloat(final_price);
        var final_price = final_price.toFixed(2);
        $('#right-block-product-view-button-to-buy').attr('final_price', final_price);
        $('.price_products-view').html(final_price + " грн");
    });
    $('#right-block-product-view-button-to-buy').click(function () {
        var ip_address = $(this).attr('ip_address');
        var quantity = $('#quantity').val();
        var iid = $(this).attr('iid');
        var new_price = $(this).attr('final_price');
        var real_price = $(this).attr('real_price');
        var email = $(this).attr('email');
        $.ajax({
            type: "POST",
            url: "/main/AddToCart",
            data: "iid=" + iid + "&res_ip_address=" + ip_address + "&quantity=" + quantity + "&price=" + new_price + "&real_price=" + real_price + "&email=" + email,
            success: function (res) {
                $(location).attr("href", '/main/cart/?ip_address=' + ip_address + "&action=oneclick");
            },
            error: function () {
            }
        });
    });
    $('.leave_the_comment').click(function () {
        $('#add_new_review').modal("show");
        $.getJSON("https://api.ipify.org/?format=json", function (e) {
            var ip_address = e.ip;
            $("#add_new_review_submit").each(function () {
                $(this).attr('ip_address', ip_address);
            });
        });
        $('#add_new_review_submit').click(function () {
            var name = $('#name').val();
            var review = $('#review').val();
            var ip_address = $(this).attr('ip_address');
            var product_id = $(this).attr('product_id');
            $.ajax({
                type: "POST",
                url: "/main/AddNewReview",
                data: "name=" + name + "&review=" + review + "&ip_address=" + ip_address + "&product_id=" + product_id,
                success: function (res) {
                    if ($.trim(res) == 1) {
                        $('.review-view-main-information').css('display', 'block');
                        setTimeout(function () {
                            $('.review-view-main-information').fadeOut(2000);
                            location.reload();
                        }, 2000);
                    }
                },
                error: function () {
                    alert("Error");
                }
            });
        });
    });
    $(document).ready(function () {
        $('#left-block-prod-view-make-bigger span').click(function () {
            var main_photo = $("#pro-view-main-image").find('img').attr('src');
            var image_id = $("#pro-view-main-image").find('img').attr('image_id');
            var department_id = $(this).attr('department_id');
            $.ajax({
                type: "POST",
                url: "/main/GetImage",
                data: "image_id=" + image_id,
                dataType: "json",
                success: function (res) {
                    var images = JSON.stringify(res);
                    var obj = JSON.parse(images);
                    $.each(obj, function (iy, ely) {
                        var name = ely['name'];
                        $('#view_modal_images').modal("show");
                        $(".pro-view-modal-small-images").each(function () {
                            $('#product-view-modal-img').find('img').attr('src', main_photo);
                            $('.pro-view-modal-small-images').append($('<ul><li>')
                                .prepend($('<img>', {
                                        id: 'dd',
                                        src: '/application/photo/small_images/' + department_id + '/' + name,
                                        width: '70px',
                                        height: '70px'
                                    })
                                        .addClass('pro-view-modal-small_images_img')
                                )
                            );
                        });
                        $('.pro-view-modal-small_images_img').hover(function () {
                            $(this).css('width', '72px');
                            $(this).css('height', '72px');
                            var src = $(this).attr('src');
                            $("#product-view-modal-img").find('img').attr('src', src);
                        }, function () {
                            $("#product-view-modal-img").find('img').attr('src', src);
                            $(this).css('width', '70px');
                            $(this).css('height', '70px');
                        });
                    });
                },
                error: function () {
                    alert("Error");
                }
            });
        });
        $('.product-view-img-small').hover(function () {
            $(this).css('width', '112px');
            $(this).css('height', '112px');
            $(this).css('border', '1px solid rosybrown');
            var name = $.trim($(this).attr('name'));
            var department_id = $(this).attr('department_id');
            $("#pro-view-main-image").find('img').attr('src', '/application/photo/small_images/' + department_id + '/' + name);
        }, function () {
            var department_id = $(this).attr('department_id');
            var image_id = $("#pro-view-main-image").find('img').attr('image_id');
            $("#pro-view-main-image").find('img').attr('src', '/application/photo/' + department_id + '/' + image_id);
            $(this).css('width', '110px');
            $(this).css('height', '110px');
            $(this).css('border', '1px solid white');
        });
    });
    $(document).ready(function () {
        $('.customer-logos').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1500,
            arrows: false,
            dots: false,
            pauseOnHover: false,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 4
                }
            }, {
                breakpoint: 520,
                settings: {
                    slidesToShow: 3
                }
            }]
        });
    });
});
// VIEW _END_
