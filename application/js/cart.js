$(document).ready(function () {

    $.getJSON("https://api.ipify.org/?format=json", function (e) {
        var ip_address = e.ip;
        $(".cart_remove_all").attr('ip_address', ip_address);
    });
    $('.cart_delete_all').click(function () {
        var ip_address = $('.cart_remove_all').attr('ip_address');
        $.ajax({
            url: "/main/DeleteAllFromCart",
            type: "POST",
            data: "ip_address=" + ip_address,
            success: function (res) {
                if (res == 1) {
                    $("#flash-msg-deleting-order").show();
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                    $('.cart_delete_all').css('display', 'none');
                }
            },
            error: function () {
                alert("Error");
            }
        });
    });
    $('.modal_quantity_info_purchase_div').change(function () {
        // modal_quantity_info_purchase
        var price = $(this).find('span').attr('real_price');
        var valueCurrent = parseInt($('.modal_quantity_info_purchase', this).val());
        var res_price = price * valueCurrent;
        $(this).find('span').html(res_price + ' $');
        $(this).find('span').attr('value', res_price);

        function final_price() {
            var final_price = 0;
            $(".price").each(function () {
                final_price += Number($(this).attr('value'));
                $('.final_price-step1-cart').val(final_price + ' $');
                return final_price;
            });
        }
        $('.final_price-step1-cart').val(final_price());
        $('.final_price-step1-cart').attr('value', final_price());

        function arr_prices() {
            var arr_prices = [];
            $(".price").each(function () {
                arr_prices.push($(this).attr('value').split(',')[0]);
                console.log(arr_prices);
                $('#step1_button').attr('array_prices', arr_prices);
                $('.array_prices').attr('array_prices', arr_prices);
                $('.array_prices').val(arr_prices);
                $('.array_prices').attr('value', arr_prices);
            });
        }

        $('#step1_button').attr('array_prices', arr_prices());
        $('.array_prices').attr('array_prices', arr_prices());
        $('.array_prices').val(arr_prices());
        $('.array_prices').attr('value', arr_prices());

        function arr_quantity() {
            var arr_quantity = [];
            $(".modal_quantity_info_purchase").each(function () {
                arr_quantity.push($(this).val().split(',')[0]);
                console.log(arr_quantity);
                $('#step1_button').attr('arr_quantity', arr_quantity);
                $('.arr_quantity').attr('arr_quantity', arr_quantity);
                $('.arr_quantity').val(arr_quantity);
                $('.arr_quantity').attr('value', arr_quantity);
            });
        }

        $('#step1_button').attr('arr_quantity', arr_quantity());
        $('.arr_quantity').attr('arr_quantity', arr_quantity());
        $('.arr_quantity').val(arr_quantity());
        $('.arr_quantity').attr('value', arr_quantity());
    });

    function final_price() {
        var final_price = 0;
        $(".price").each(function () {
            final_price += Number($(this).attr('value'));
            $('.final_price-step1-cart').val(final_price + ' $');
            return final_price;
        });
    }

    $('.final_price-step1-cart').val(final_price());
    $('.final_price-step1-cart').attr('value', final_price());
    $('.glyphicon.glyphicon-trash.cart_delete').click(function () {
        var iid = $(this).attr('iid');
        $.ajax({
            url: "/main/DeleteOneFromCart",
            type: "POST",
            data: "id=" + iid,
            success: function (res) {
                if (res == 1) {
                    $("#flash-msg-deleting-order").show();
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                }
            },
            error: function () {
                alert("Error");
            }
        });
    });

    function arr_prices() {
        var arr_prices = [];
        $(".price").each(function () {
            arr_prices.push($(this).attr('value').split(',')[0]);
            console.log(arr_prices);
            $('#step1_button').attr('array_prices', arr_prices);
            $('.array_prices').attr('array_prices', arr_prices);
            $('.array_prices').val(arr_prices);
            $('.array_prices').attr('value', arr_prices);
        });
    }

    $('#step1_button').attr('array_prices', arr_prices());
    $('.array_prices').attr('array_prices', arr_prices());
    $('.array_prices').val(arr_prices());
    $('.array_prices').attr('value', arr_prices());

    function arr_quantity() {
        var arr_quantity = [];
        $(".modal_quantity_info_purchase").each(function () {
            arr_quantity.push($(this).val().split(',')[0]);
            console.log(arr_quantity);
            $('#step1_button').attr('arr_quantity', arr_quantity);
            $('.arr_quantity').attr('arr_quantity', arr_quantity);
            $('.arr_quantity').val(arr_quantity);
            $('.arr_quantity').attr('value', arr_quantity);
        });
    }

    $('#step1_button').attr('arr_quantity', arr_quantity());
    $('.arr_quantity').attr('arr_quantity', arr_quantity());
    $('.arr_quantity').val(arr_quantity());
    $('.arr_quantity').attr('value', arr_quantity());
    $.getJSON("https://api.ipify.org/?format=json", function (e) {
        var ip_address = e.ip;
        $("#step3_button").each(function () {
            $(this).attr('ip_address', ip_address);
        });
    });
    $('#step3_button').click(function () {
        var array_prices = $(this).attr('array_prices');
        var arr_quantity = $(this).attr('arr_quantity');
        var product_ids = $(this).attr('product_ids');
        var ip_address = $(this).attr('ip_address');
        var length = $(this).attr('length');
        var price = $('#to_buy_order_price').html();
        var order_delivery = $("#to_buy_order_delivery").html();
        var order_fio = $("#to_buy_order_fio").html();
        var order_email = $("#to_buy_order_email").html();
        var order_phone = $("#to_buy_order_phone").html();
        var order_address = $("#to_buy_order_address").html();
        var email = $(this).attr('email');
        alert(ip_address);
        alert(email);
        $.ajax({
            type: "POST",
            url: "/main/InsertOrder",
            data: "order_fio=" + order_fio + "&order_delivery=" + order_delivery + "&order_email=" + order_email + "&order_phone=" + order_phone + "&order_address=" + order_address + "&price=" + price + "&product_ids=" + product_ids + "&ip_address=" + ip_address + "&array_prices=" + array_prices + "&arr_quantity=" + arr_quantity + "&length=" + length,
            success: function (res) {
                if ($.trim(res) != 0) {
                    $.ajax({
                        type: "POST",
                        url: "/main/DeleteFromCart",
                        data: "ip_address="+ip_address+"&email="+email,
                        success: function (res) {
                            if ($.trim(res) != 0) {
                                window.location.href = "/main/index";
                            }
                        },
                        error: function () {
                        }
                    })
                }
            },
            error: function () {
            }
        })
    });
});