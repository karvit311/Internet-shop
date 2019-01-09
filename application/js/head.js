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
