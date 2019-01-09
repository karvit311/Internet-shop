$("#newsticker").jCarouselLite({
    vertical: true,
    hoverPause:true,
    btnPrev: "#news-prev",
    btnNext: "#news-next",
    visible: 3,
    auto:3000,
    speed:500
});
load_business_data();
function load_business_data() {
    $(".ratings").each(function () {
        var product_id_for_rating = $(this).attr('iid');
        $(this).attr('id',product_id_for_rating);
        $.ajax({
            url: "/main/Fetch",
            method: "POST",
            data: "product_id=" + product_id_for_rating,
            success: function (data) {
                $(".ratings").each(function () {
                    var product_id_for_rating_2 = $(this).attr('iid');
                    if(product_id_for_rating_2 == product_id_for_rating) {
                        var percent = data*100/5;
                        $(this,'.empty-stars').css('width','100');
                        $(this,'.empty-stars').css('color','black');
                        $(this,'.stars').css('width','30');
                        $(this).attr('rating',data);
                    }
                });
            }
        });
    });
}
$('.rating-all').hover(function(){
        $('.ratings',this).css('display','none');
        $('.rating',this).css('display','inline-block');
    },
    function(){
        $('.ratings',this).css('display','inline-block');
        $('.rating',this).css('display','none');
    });
$("#menu ul").hide();
$("#menu li span").click(function() {
    $("#menu ul:visible").slideUp("normal");
    if (($(this).next().is("ul")) && (!$(this).next().is(":visible"))) {
        $(this).next().slideDown("normal");
    }
});
$.getJSON("https://api.ipify.org/?format=json", function(e) {
    var ip_address =  e.ip;
    $(".column").attr('ip_address',ip_address);
    $(".main_img").attr('ip_address',ip_address);
    $(".name_main_product").attr('ip_address',ip_address);
});
$('.main_img').click(function(){
    var id = $(this).attr('iid');
    var ip_address = $(this).attr('ip_address');
    $(location).attr("href", '/main/view/?id='+id+"&ip_address="+ip_address);
});
$('.name_main_product').click(function(){
    var id = $(this).attr('iid');
    var ip_address = $(this).attr('ip_address');
    $(location).attr("href", '/main/view/?id='+id+"&ip_address="+ip_address);
});
$(".column").hover(
    function() {
        var iid = $(this).attr('iid');
        var new_price = $(this).attr('price');
        var real_price = $(this).attr('real_price');
        var email = $(this).attr('email');
        $(this)
            .append($('<button>')
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
                    success: function () {
                        location.reload();
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
$(function () {
    var minPrice = 10,
        maxPrice = 30000,
        $filter_lists = $("#filters ul"),
        $filter_checkboxes = $("#filters :checkbox"),
        $items = $("#computers div.column");
    $filter_checkboxes.click(filterSystem);
    $('#slider-container').slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        values: [minPrice, maxPrice],
        slide: function (event, ui) {
            $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
            minPrice = ui.values[0];
            maxPrice = ui.values[1];
            filterSystem();
        }
    });
    $("#amount").val("$" + minPrice + " - $" + maxPrice);
    function filterSlider(elem) {
        var price = parseInt($(elem).data("price"), 10);
        return price >= minPrice && price <= maxPrice;
    }
    function filterCheckboxes(elem) {
        var $elem = $(elem),
            passAllFilters = true;
        $filter_lists.each(function () {
            var classes = $(this).find(':checkbox:checked').map(function () {
                return $(this).val();
            }).get();
            var passThisFilter = false;
            $.each(classes, function (index, item) {
                if ($elem.hasClass(item)) {
                    passThisFilter = true;
                    return false; //stop inner loop
                }
            });
            if (!passThisFilter) {
                passAllFilters = false;
                return false; //stop outer loop
            }
        });
        return passAllFilters;
    }
    function filterSystem() {
        $items.hide().filter(function () {
            return filterSlider(this) && filterCheckboxes(this);
        }).show();
    }
});