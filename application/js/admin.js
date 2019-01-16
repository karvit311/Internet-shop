//BLOCK-HEADER
$('.products_select_department').click(function(){
    $("#selectDepartmentModal").modal("show");
    $('#select_department').click(function(){
        var department_id = $('#SelectDepartment option:selected, this').attr('department_id');
        window.location.href = "/admin/products/?department_id=" + department_id+"&page="+1;
    });
});
//BLOCK-HEADER _END_
//DELIVERY
$(document).ready(function() {
    $('#add_new_supplier_left_block').click(function(){
        $("#department_for_new_supplier").modal("show");
        $('#SelectDepartment').change(function(){
            var main_department_id = $('#SelectDepartment option:selected').attr('department_id');
            $.ajax({
                type: "POST",
                url: "/admin/GetChildOfDepartment",
                data: "main_department_id=" + main_department_id,
                dataType: "json",
                success: function (res) {
                    var workers = JSON.stringify(res);
                    var obj = JSON.parse(workers);
                    $('#SelectSubDepartment')
                    .find("option").remove();
                    $.each(obj, function(iy, ely) {
                        var department = ely['department'];
                        var department_id = ely['id'];
                        console.log(department);
                        $('#SelectSubDepartment')
                        .append($('<option>')
                            .attr('department_id', department_id)
                            .text(department)
                        );
                    });
                },
                error: function () {
                }
            });
        });
        $('.remove_sub_department.glyphicon-remove-circle').click(function(){
            $('#SelectSubDepartment').val('');
            $('.remove_sub_department.glyphicon-remove-circle').hide();
        });
        $('#add_new_department_in_new_supplier').click(function(){
            var new_department = $('#AddNewDepartment').val();
            var selected_department_id = $('#SelectDepartment option:selected').attr('department_id');
            var selected_sub_parent_id = $('#SelectSubDepartment option:selected').attr('department_id');
            $.ajax({
                type: "POST",
                url: "/main/AddNewDepartment",
                data: "new_department=" + new_department + "&selected_department_id=" + selected_department_id+ "&selected_sub_parent_id=" + selected_sub_parent_id,
                success: function (res) {
                    var department_id = res;
                    $("#flash-msg-selecting-department-for-new-supplier").show();
                    setTimeout(function () {
                        $("#flash-msg-selecting-department-for-new-supplier").hide();
                    }, 2000);
                    setTimeout(function () {
                        $("#add_new_supplier_Modal").modal("show");
                    }, 2000);
                    $('#add_new_supplier').click(function() {
                        var department_id = res;
                        var new_supplier = $('#AddNewInputSupplier').val();
                        var new_info_supplier = $('#AddNewInfoSupplier').val();
                        $.ajax({
                            type: "POST",
                            url: "/admin/AddNewSupplier",
                            data: "new_supplier=" + new_supplier + "&new_info_supplier=" + new_info_supplier + "&new_department=" + department_id,
                            success: function () {
                            },
                            error: function () {
                                alert("Error");
                            }
                        });
                    });
                },
                error: function () {
                    alert("Error");
                }
            });
        });
    });
    $('#search_deliveries_by_suppliers').click(function(){
        var selected_supplier_id = $('select#FormControlSearchDeliveriesBySupplier option:selected').attr('supplier_id');
        $.ajax({
            type: "POST",
            url: "/admin/GetAllDeliveriesForThisSupplier",
            data: "supplier_id=" + selected_supplier_id,
            dataType: "json",
            success: function (response) {
                console.log(response);
                for(var i in response){
                    console.log(response[i]);
                    for(var y in response[i]) {
                        console.log(response[i][y]);
                        $.each($(response[i][y]), function (iy, ely) {
                            var supplier_id = ely['supplier_id'];
                            var city_id = ely['city_id'];
                            var supplier = ely['supplier'];
                            var address = ely['address'];
                            var date = ely['date'];
                            var time = ely['time'];
                            var info = ely['info'];
                            var department = ely['department'];
                            $("#change_delivery_Modal_by_supplier").modal("show");
                            $('#change_delivery_Modal_by_supplier').find('tbody')
                            .append($('<tr>')
                                .append($('<td>')
                                    .addClass('modal_change_delivery_date_supplier'+y)
                                    .attr('supplier_id', supplier_id)
                                    .attr('city_id', city_id)
                                    .text(supplier)
                                )
                                .append($('<td>')
                                    .addClass('modal_change_delivery_date_address'+y)
                                    .text(address)
                                )
                                .append($('<td>')
                                    .addClass('modal_change_delivery_date_date'+y)
                                    .text(date)
                                )
                                .append($('<td>')
                                    .addClass('modal_change_delivery_date_time'+y)
                                    .text(time)
                                )
                                .append($('<td>')
                                    .addClass('modal_change_delivery_date_info'+y)
                                    .text(info)
                                )
                                .append($('<td>')
                                    .addClass('modal_change_delivery_date_department'+y)
                                    .text(department)
                                )
                                .append($('<td>')
                                    .append($('<a href="#">')
                                        .append($('<span class="glyphicon glyphicon-pencil">')
                                        )
                                    )
                                    .append($('<a href="#">')
                                        .append($('<span class="glyphicon glyphicon-trash">')
                                        )
                                    )
                                )
                            );
                        });
                    }
                }
                $.each($('.glyphicon.glyphicon-pencil'), function (y, ey) {
                    $(this).click(function () {
                        var supplier_id = $('.modal_change_delivery_date_supplier' + y).attr('supplier_id');
                        var city_id = $('.modal_change_delivery_date_supplier' + y).attr('city_id');
                        var supplier = $('.modal_change_delivery_date_supplier' + y).text();
                        var address = $('.modal_change_delivery_date_address'+ y).text();
                        var date = $('.modal_change_delivery_date_date'+ y).text();
                        var time = $('.modal_change_delivery_date_time'+ y).text();
                        var info = $('.modal_change_delivery_date_info'+ y).text();
                        var department = $('.modal_change_delivery_date_department'+ y).text();
                        $('#change_delivery_Modal_by_supplier').modal('hide');
                        $('#change_delivery_Modal_by_supplier')
                            .find("table tbody tr").remove();
                        $("#edit_delivery_Modal_by_city").modal("show");
                        $('#FormEditInputSupplier' ).attr('supplier_id',supplier_id);
                        var city_id = $('#FormEditInputSupplier').attr('city_id',city_id);
                        $('#FormEditInputSupplier').val(supplier);
                        $('#FormEditInputAddress').val(address);
                        $('#FormEditInputDate').val(date);
                        $('#FormEditInputTime').val(time);
                        $('#FormEditInputInfo').val(info);
                        $('#FormEditInputDepartment').val(department);
                        $('#update_delivery').click(function(){
                            var supplier_id = $('#FormEditInputSupplier').attr('supplier_id');
                            var city_id = $('#FormEditInputSupplier').attr('city_id');
                            var supplier = $('#FormEditInputSupplier').val();
                            var address = $('#FormEditInputAddress').val();
                            var date = $('.bootstrap-datetimepicker-widget table td.day').attr('data-day');
                            var val = $('.bootstrap-datetimepicker-widget table td.day').text();
                            var full_time = $('#datetimepicker5').data('DateTimePicker').date();
                            var dateTime = new Date(full_time);
                            dateTime = moment(dateTime).format("YYYY-MM-DD HH:mm:ss");
                            get_time = moment(dateTime).format("HH:mm:ss");
                            var info = $('#FormEditInputInfo').val();
                            var department = $('#FormEditInputDepartment').val();
                            $.ajax({
                                type: "POST",
                                url: "/admin/UpdateDelivery",
                                data: "supplier_id=" + supplier_id +"&supplier=" + supplier +"&city_id=" + city_id +"&address=" + address +"&date=" + dateTime +"&time=" + get_time +"&info=" + info +"&department=" + department,
                                dataType: "json",
                                success: function (res) {
                                    var workers = JSON.stringify(res);
                                    var obj = JSON.parse(workers);
                                    $.each(obj, function(iy, ely) {
                                        var address = ely['address'];
                                        var date = ely['date'];
                                        var time = ely['time'];
                                        var supplier_id = ely['supplier_id'];
                                        var supplier = ely['supplier'];
                                        var info = ely['info'];
                                        var department = ely['department'];
                                        console.log(department);
                                        $(".modal_delivery_date_address").html(address);
                                        $(".modal_delivery_date_time").html(time);
                                        $(".modal_delivery_date_date").html(date);
                                        $(".modal_delivery_date_supplier").html(supplier);
                                        $(".modal_delivery_date_contacts_of_supplier").html(info);
                                        $(".modal_delivery_date_department").html(department);
                                    });
                                },
                                error: function () {
                                    alert("Error");
                                }
                            });

                        });
                    });
                });
                $('.close').click(function() {
                    $('#change_delivery_Modal_by_supplier')
                        .find("table tbody tr").remove();
                });
            },
            error: function () {
                alert("Error");
            }
        });
    });
    $('#left-block-search-by-city').click(function(){
        var selected_city_id = $('select#FormControlSearchDeliveriesByCity option:selected').attr('city_id');
        $.ajax({
            type: "POST",
            url: "/admin/GetAllDeliveriesForThisCity",
            data: "city_id=" + selected_city_id,
            dataType: "json",
            success: function (response) {
                console.log(response);
                for(var i in response){
                    console.log(response[i]);
                    for(var y in response[i]) {
                        console.log(response[i][y]);
                        $.each($(response[i][y]), function (iy, ely) {
                            var supplier_id = ely['supplier_id'];
                            var city_id = ely['city_id'];
                            var supplier = ely['supplier'];
                            var address = ely['address'];
                            var date = ely['date'];
                            var time = ely['time'];
                            var info = ely['info'];
                            var department = ely['department'];
                            $("#change_delivery_Modal_by_city").modal("show");
                            $('#change_delivery_Modal_by_city').find('tbody')
                            .append($('<tr>')
                                .append($('<td>')
                                    .addClass('modal_change_delivery_date_supplier'+y)
                                    .attr('supplier_id', supplier_id)
                                    .attr('city_id', city_id)
                                    .text(supplier)
                                )
                                .append($('<td>')
                                    .addClass('modal_change_delivery_date_address'+y)
                                    .text(address)
                                )
                                .append($('<td>')
                                    .addClass('modal_change_delivery_date_date'+y)
                                    .text(date)
                                )
                                .append($('<td>')
                                    .addClass('modal_change_delivery_date_time'+y)
                                    .text(time)
                                )
                                .append($('<td>')
                                    .addClass('modal_change_delivery_date_info'+y)
                                    .text(info)
                                )
                                .append($('<td>')
                                    .addClass('modal_change_delivery_date_department'+y)
                                    .text(department)
                                )
                                .append($('<td>')
                                    .append($('<a href="#">')
                                        .append($('<span class="glyphicon glyphicon-pencil">')
                                        )
                                    )
                                    .append($('<a href="#">')
                                        .append($('<span class="glyphicon glyphicon-trash">')
                                        )
                                    )
                                )
                            );
                        });
                    }
                }
                $.each($('.glyphicon.glyphicon-pencil'), function (y, ey) {
                    $(this).click(function () {
                        var supplier_id = $('.modal_change_delivery_date_supplier' + y).attr('supplier_id');
                        var city_id = $('.modal_change_delivery_date_supplier' + y).attr('city_id');
                        var supplier = $('.modal_change_delivery_date_supplier' + y).text();
                        var address = $('.modal_change_delivery_date_address'+ y).text();
                        var date = $('.modal_change_delivery_date_date'+ y).text();
                        var time = $('.modal_change_delivery_date_time'+ y).text();
                        var info = $('.modal_change_delivery_date_info'+ y).text();
                        var department = $('.modal_change_delivery_date_department'+ y).text();
                        $('#change_delivery_Modal_by_city').modal('hide');
                        $('#change_delivery_Modal_by_city')
                            .find("table tbody tr").remove();
                        $("#edit_delivery_Modal_by_city").modal("show");
                        $('#FormEditInputSupplier' ).attr('supplier_id',supplier_id);
                        var city_id = $('#FormEditInputSupplier').attr('city_id',city_id);
                        $('#FormEditInputSupplier').val(supplier);
                        $('#FormEditInputAddress').val(address);
                        $('#FormEditInputDate').val(date);
                        $('#FormEditInputTime').val(time);
                        $('#FormEditInputInfo').val(info);
                        $('#FormEditInputDepartment').val(department);
                        $('#update_delivery').click(function(){
                            var supplier_id = $('#FormEditInputSupplier').attr('supplier_id');
                            var city_id = $('#FormEditInputSupplier').attr('city_id');
                            var supplier = $('#FormEditInputSupplier').val();
                            var address = $('#FormEditInputAddress').val();
                            var date = $('.bootstrap-datetimepicker-widget table td.day').attr('data-day');
                            var val = $('.bootstrap-datetimepicker-widget table td.day').text();
                            var full_time = $('#datetimepicker5').data('DateTimePicker').date();
                            var dateTime = new Date(full_time);
                            dateTime = moment(dateTime).format("YYYY-MM-DD HH:mm:ss");
                            get_time = moment(dateTime).format("HH:mm:ss");
                            var info = $('#FormEditInputInfo').val();
                            var department = $('#FormEditInputDepartment').val();
                            $.ajax({
                                type: "POST",
                                url: "/admin/UpdateDelivery",
                                data: "supplier_id=" + supplier_id +"&supplier=" + supplier +"&city_id=" + city_id +"&address=" + address +"&date=" + dateTime +"&time=" + get_time +"&info=" + info +"&department=" + department,
                                dataType: "json",
                                success: function (res) {
                                    var workers = JSON.stringify(res);
                                    var obj = JSON.parse(workers);
                                    $.each(obj, function(iy, ely) {
                                        var address = ely['address'];
                                        var date = ely['date'];
                                        var time = ely['time'];
                                        var supplier_id = ely['supplier_id'];
                                        var supplier = ely['supplier'];
                                        var info = ely['info'];
                                        var department = ely['department'];
                                        console.log(department);
                                        $(".modal_delivery_date_address").html(address);
                                        $(".modal_delivery_date_time").html(time);
                                        $(".modal_delivery_date_date").html(date);
                                        $(".modal_delivery_date_supplier").html(supplier);
                                        $(".modal_delivery_date_contacts_of_supplier").html(info);
                                        $(".modal_delivery_date_department").html(department);
                                    });
                                },
                                error: function () {
                                    alert("Error");
                                }
                            });
                        });
                    });
                });
                $('.close').click(function() {
                    $('#change_delivery_Modal_by_city')
                        .find("table tbody tr").remove();
                });
            },
            error: function () {
                alert("Error");
            }
        });
    });
    var array = [];
    $.each($('.city_deliver'), function (i,el) {
        var attribute_city_id = $(this).attr('city_id');
        array.push(attribute_city_id);
    });
    $.each($(array), function (i,el) {
        $.ajax({
            type: "POST",
            url: "/admin/ByCityId",
            data: {city_id: array[i]},
            dataType: "json",
            success: function (response) {
                $.each($(response), function (i,el) {
                    var hours = [];
                    var dates = [];
                    $.each($('.hour_delivery'), function (ii, ell) {
                        var city_id = $(this).attr('city_id');
                        var date = $(this).attr('date');
                        for(var iii in el['date']) {
                            for (var yyy in el['time']) {
                                if((city_id == el['city_id'])&&(date== el['date'][iii]) ) {
                                    $(this).attr('time', el['time'][iii]);
                                    $(this).val(el['time'][iii]);
                                    var date = $(this).attr('date');
                                    if ((date == el['date'][iii]) && (city_id == el['city_id'])) {
                                        $(this).html(el['time'][iii]);
                                        $(this).css("background-color", "#8c2424");
                                        $(this).hover(
                                            function () {
                                                $(this).css("background-color", "rosybrown");
                                            },
                                            function () {
                                                $(this).css("background-color", "#8c2424");
                                            }
                                        );
                                        $(this).click(
                                            function () {
                                                $(this).css("background-color", "rosybrown");
                                                $(this).attr('data-toggle', 'modal');
                                                $(this).attr("data-target", "#detail_by_time_Modal");
                                                var city_id = $(this).attr('city_id');
                                                var time_atr = $(this).attr('time');
                                                var date_atr = $(this).attr('date');
                                                $.ajax({
                                                    type: "POST",
                                                    url: "/admin/GetInfoAboutDelivery",
                                                    data: "time=" + time_atr + "&date=" + date_atr + "&city_id=" + city_id,
                                                    dataType: "json",
                                                    success: function (res) {
                                                        var workers = JSON.stringify(res);
                                                        var obj = JSON.parse(workers);
                                                        $.each(obj, function (iy, ely) {
                                                            var address = ely['address'];
                                                            var date = ely['date'];
                                                            var time = ely['time'];
                                                            var supplier = ely['supplier'];
                                                            var info = ely['info'];
                                                            var department = ely['department'];
                                                            $(".modal_delivery_date_address").html(address);
                                                            $(".modal_delivery_date_time").html(time);
                                                            $(".modal_delivery_date_date").html(date);
                                                            $(".modal_delivery_date_supplier").html(supplier);
                                                            $(".modal_delivery_date_contacts_of_supplier").html(info);
                                                            $(".modal_delivery_date_department").html(department);
                                                        });
                                                    },
                                                    error: function () {
                                                        alert("Error");
                                                    }
                                                });
                                            }
                                        );
                                    }
                                }
                            }
                        }
                    });
                });
            },
            error: function () {
                alert("Error");
            }
        });
    });
    $('#datetimepicker4').datetimepicker({
        inline: true,
        sideBySide: true,
        calendarWeeks:true,
        format: 'dd-mm-yyyy hh:ii'
    });
    $('#form_datetimepicker4').click(function() {
        var date = $('.bootstrap-datetimepicker-widget table td.day').attr('data-day');
        var val = $('.bootstrap-datetimepicker-widget table td.day').text();
        var full_time = $('#datetimepicker4').data('DateTimePicker').date();
        var dateTime = new Date(full_time);
        dateTime = moment(dateTime).format("YYYY-MM-DD HH:mm:ss");
        get_time = moment(dateTime).format("HH:mm:ss");
        $("#add_new_delivery_Modal").modal("show");
        $("button#add_new_delivery").click(function() {
            var selected_address_modal = $('select#FormControlInputAddress option:selected').text();
            var selected_supplier_modal = $('select#FormControlInputSupplier option:selected').text();
            var selected_id_supplier_modal = $('select#FormControlInputSupplier option:selected').attr('supplier_id');
            var selected_id_city_modal = $('select#FormControlInputAddress option:selected').attr('city_id');
            $.ajax({
                type: "POST",
                url: "/admin/GetInfoAboutSupplier",
                data: "supplier_id=" + selected_id_supplier_modal,
                dataType: "json",
                success: function (response) {
                    var workers = JSON.stringify(response);
                    var obj = JSON.parse(workers);
                    $.each(obj, function(i, el) {
                        var info = el['info'];
                        var department = el['department'];
                        $("#address_alert_adding_delivery").html(selected_address_modal);
                        $("#date_alert_adding_delivery").html(dateTime);
                        $("#time_alert_adding_delivery").html(get_time);
                        $("#supplier_alert_adding_delivery").html(selected_supplier_modal);
                        $("#contacts_of_supplier_alert_adding_delivery").html(info);
                        $("#department_alert_adding_delivery").html(department);
                        $.ajax({
                            type: "POST",
                            url: "/admin/AddNewDelivery",
                            data: "address=" + selected_address_modal + "&date=" + dateTime+ "&time=" + get_time+ "&city_id=" + selected_id_city_modal + "&supplier_id=" + selected_id_supplier_modal,
                            success: function (response) {
                                if(response == 1){
                                    $("#flash-msg-adding-delivery").show();
                                }
                            },
                            error: function () {
                                alert("Error");
                            }
                        });
                    });
                },
                error: function () {
                    alert("Error");
                }
            });
        });
    });
    $('#datetimepicker3').datetimepicker({
        defaultDate: new Date()
    }).on("dp.show", function () {
        $.ajax({
            type: "POST",
            url: "/admin/GetDelivery",
            dataType: "json",
            success: function (response) {
                var workers = JSON.stringify(response);
                var obj = JSON.parse(workers);
                $.each(obj, function (i, el) {
                    var date = el['date'];
                    $('.bootstrap-datetimepicker-widget table td.day').each(function (index, element) {
                        var attribute = $(this).attr('data-day');
                        if(attribute == date){
                            $(this).addClass('activeClass');
                            $('.bootstrap-datetimepicker-widget table td.day').on('click', function() {
                                var day = $(this).attr('data-day');
                                var val = $(this).text();
                                if(date == day) {
                                    var address=[];
                                    $.ajax({
                                        type: "POST",
                                        url: "/admin/GetDeliveryByDate",
                                        data: "date=" + day,
                                        success: function () {
                                            $(".modal_delivery_date_address").html(el['address']);
                                            $(".modal_delivery_date_time").html(el['time']);
                                            $(".modal_delivery_date_date").html(el['date']);
                                            $("#detailModal").modal("show");
                                        },
                                        error: function () {
                                            alert("Error");
                                        }
                                    });
                                }
                            });
                            $(this).hover(
                                function () {
                                    $(this).css("background-color", "rosybrown");
                                },
                                function () {
                                    $(this).css("background-color", "red");
                                }
                            );
                            $(".bootstrap-datetimepicker-widget table td.day").hover( function (e) {
                                $(this).toggleClass('hover', e.type === 'mouseenter');
                            });
                            $.ajax({
                                type: "POST",
                                url: "/admin/GetDeliveryByDate",
                                data: "date=" + date,
                                dataType: "json",
                                success: function (response) {
                                    var workers = JSON.stringify(response);
                                    var obj = JSON.parse(workers);
                                    $.each(obj, function(i, el) {
                                        var address = el['address'];
                                        var $element = $(element);
                                        $element.attr("title", address);
                                        $element.data("container", "body");
                                        $element.tooltip();
                                    });
                                },
                                error: function () {
                                }
                            });
                        }
                        if ((attribute, date) > -1) {
                            (date).addClass('activeClass');
                        }
                        if (date <= attribute && date >= attribute ) {
                            return [true, 'activeClass', date];
                        }
                    });
                });
            },
            error: function () {
                alert("Error");
            }
        });
    }).on("dp.change", function (index, element) {
        $('.bootstrap-datetimepicker-widget table td.day').on('click', function(index,element) {
            var day = $(this).attr('data-day');
            var val = $(this).text();
        });
    });
    var attribute = $('#lastDay').attr('lastDay');
    var date = new Date(),
    yr = date.getFullYear(),
    month = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1),
    day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
    newDate = day + '/' + month + '/' + yr;
    newDate = yr + '-' + month + '-' + day;
    $("#output4").html(
        "Start of Week: " + moment(newDate, "DD/MM/YYYY").day(1).format("DD/MM/YYYY")
    );
    $('.day_of_week_monday').attr('date', moment(newDate, "YYYY-MM-DD").day(1).format("YYYY-MM-DD"));
    $('.day_of_week_tuesday').attr('date', moment(newDate, "YYYY-MM-DD").day(2).format("YYYY-MM-DD"));
    $('.day_of_week_wednesday').attr('date', moment(newDate, "YYYY-MM-DD").day(3).format("YYYY-MM-DD"));
    $('.day_of_week_thursday').attr('date', moment(newDate, "YYYY-MM-DD").day(4).format("YYYY-MM-DD"));
    $('.day_of_week_friday').attr('date', moment(newDate, "YYYY-MM-DD").day(5).format("YYYY-MM-DD"));
    $('.day_of_week_saturday').attr('date', moment(newDate, "YYYY-MM-DD").day(6).format("YYYY-MM-DD"));
    $('.day_of_week_sunday').attr('date', moment(newDate, "YYYY-MM-DD").day(7).format("YYYY-MM-DD"));

     $('.days_of_week.day_of_week_monday').html( moment(newDate, "YYYY-MM-DD").day(1).format("YYYY-MM-DD"));
    $('.days_of_week.day_of_week_tuesday').html( moment(newDate, "YYYY-MM-DD").day(2).format("YYYY-MM-DD"));
    $('.days_of_week.day_of_week_wednesday ').html( moment(newDate, "YYYY-MM-DD").day(3).format("YYYY-MM-DD"));
    $('.days_of_week.day_of_week_thursday ').html( moment(newDate, "YYYY-MM-DD").day(4).format("YYYY-MM-DD"));
    $('.days_of_week.day_of_week_friday ').html( moment(newDate, "YYYY-MM-DD").day(5).format("YYYY-MM-DD"));
    $('.days_of_week.day_of_week_saturday').html(moment(newDate, "YYYY-MM-DD").day(6).format("YYYY-MM-DD"));
    $('.days_of_week.day_of_week_sunday').html( moment(newDate, "YYYY-MM-DD").day(7).format("YYYY-MM-DD"));
});
//DELIVERY _END_
//CLIENT
$('.client-links .delete').click(function(){
    var client_id = $(this).attr('client_id');
    $.ajax({
        type:"post",
        url:"/admin/deleteClient",
        data:"client_id="+client_id,
        success:function(response){
            if($.trim(response) == 1) {
                $("#flash-msg-deleting-client").show();
                setTimeout(function () {
                    location.reload();
                }, 1000);
            }
        },
        error:function(){
        }
    })
});
//CLIENT _END_
// ADMINKA
$('.login_in_adminka').click(function() {
    var login = $('#login-adminka').val();
    var password = $('#password-adminka').val();
    $.ajax({
        type: "POST",
        url: "/admin/CheckData",
        data: "login=" +login + "&password="+password,
        success: function (response) {
            if($.trim(response) == 1) {
                window.location.replace("/admin/index");
            }else{
                alert('Проверьте корректность введенных данных!')
            }
        },
        error: function () {
             alert("Error");
        }
    });
});
// ADMINKA _END_
// ALL DEPARTMENTS
$(document).ready(function(){
    $.ajax({
        url: "/admin/GetTreeviewDepartmentEdition",
        method:"POST",
        dataType: "json",
        success: function(data)
        {
            $('#treeview').treeview({
                data: data,
            });
            $('#treeview').click(function() {
                $('.glyphicon.glyphicon-trash').on("click", function(e){
                    var iid = $(this).attr('data-iid');
                    var YOUR_MESSAGE_STRING_CONST = "Are you sure to Delete this worker?";
                    confirmDialog(YOUR_MESSAGE_STRING_CONST, function(){
                        $.ajax({
                            type: "POST",
                            url: "/admin/DeleteDepartmentAdmin",
                            data: "iid=" + iid ,
                            success: function (response) {
                                if(response == 1) {
                                    $("#flash-msg-deleting-department").show();
                                    setTimeout(function () {
                                        location.reload();
                                    }, 4000);
                                }
                            },
                            error: function () {
                                alert("Error");
                            }
                        });
                        console.log("deleted!");
                    });
                    function confirmDialog(message, onConfirm){
                        var fClose = function(){
                            modal.modal("hide");
                        };
                        var modal = $("#confirmModal");
                        modal.modal("show");
                        $("#confirmMessage").empty().append(message);
                        $("#confirmOk").unbind().one('click', onConfirm).one('click', fClose);
                        $("#confirmCancel").unbind().one("click", fClose);
                    }
                });
            });
            $('#treeview').click(function() {
                $("#updateModal").on("show.bs.modal", function(e) {
                    var iid = $(e.relatedTarget).data('iid');
                    $('#datetimepicker2').datetimepicker({
                        defaultDate: new Date()
                    });
                    $(".modal-body #res").html(iid);
                    $.ajax({
                        type: "POST",
                        url: "/admin/GetByIdDepartment",
                        data: "iid="+iid,
                        dataType: "json",
                        success: function (response) {
                            var departments = JSON.stringify(response);
                            var obj = JSON.parse(departments);
                            $.each(obj, function(i, el) {
                                var id = el['id'];
                                var department = el['department'];
                                var parent_id = el['parent_id'];
                                var photo = el['photo'];
                                $('.modal-body #FormControlInputDepartment').attr('value', department);
                                if(parent_id != 0) {
                                    $('.modal-body #FormControlInputPhoto').attr('src', '/application/photo/department/' + photo);
                                }
                                $('.modal_small_img_uploads input[type=file]').change(function(ei) {
                                    var info = ei.target.files;
                                    console.log(info);
                                    var fd = new FormData();
                                    var files = ei.target.files[0];
                                    fd.append('file',files);
                                    $.ajax({
                                        url: "/admin/UploadImageDepartment",
                                        type: 'post',
                                        data: fd,
                                        contentType: false,
                                        processData: false,
                                        success: function (response) {
                                            if (response != 0) {
                                                $('.FormControlInputPhotoDiv').find('img').remove();
                                                $('.FormControlInputPhotoDiv').append($('<img>')
                                                    .attr('src','/application/photo/department/'+response)
                                                    .css('width','250px')
                                                    .css('height','300px')
                                                    .css('margin-top','20px')
                                                )
                                                $.ajax({
                                                    type: "POST",
                                                    url: "/admin/UpdatePhotoDepartmentAdmin",
                                                    data: "photo=" + response+"&department_id="+id,
                                                    success: function () {
                                                        $('#update_new_department').click(function() {
                                                            var department = $('#FormControlInputDepartment').val();
                                                            $.ajax({
                                                                type: "POST",
                                                                url: "/admin/UpdateDepartmentAdmin",
                                                                data: "department=" + department+"&department_id="+id+"&parent_id="+parent_id ,
                                                                success: function () {
                                                                    location.reload();
                                                                },
                                                                error: function () {
                                                                }
                                                            });
                                                        });
                                                    },
                                                    error: function(){
                                                    }
                                                });
                                            } else {
                                                alert('file not uploaded');
                                            }
                                        },
                                    });
                                });
                            });
                        },
                        error: function () {
                            alert("Error");
                        }
                    });
                });
            });
            $("#myModal").on("show.bs.modal", function(e) {
                var iid = $(e.relatedTarget).data('iid');
                $('.modal_small_img_uploads input[type=file]').change(function() {
                    var fd = new FormData();
                    var files = $('#file')[0].files[0];
                    fd.append('file',files);
                    $.ajax({
                        url: "/admin/UploadImageDepartment",
                        type: 'post',
                        data: fd,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            alert(response);
                            if (response != 0) {
                                $.ajax({
                                    type: "POST",
                                    url: "/admin/InsertPhotoDepartmentAdmin",
                                    data: "photo=" + response,
                                    success: function (res) {
                                        var parent_id = $.trim(res);
                                        $('#FormControlInputPhotoDiv').append($('<img>')
                                            .attr('src','/application/photo/department/'+response)
                                            .css('width','250px')
                                            .css('height','300px')
                                            .css('margin-top','20px')
                                        )
                                        $('#add_new_department').click(function() {
                                            var department = $('#FormControlInputDepartment').val();
                                            $.ajax({
                                                type: "POST",
                                                url: "/admin/UpdateDepartmentAdmin",
                                                data: "department=" + department+"&department_id="+parent_id+"&parent_id="+iid ,
                                                success: function (res) {
                                                    if(res == 1) {
                                                        $("#flash-msg-adding-department").show();
                                                        setTimeout(function () {
                                                            location.reload();
                                                        }, 1000);
                                                    }
                                                },
                                                error: function () {}
                                            });
                                        });
                                    },
                                    error: function(){
                                    }
                                });
                            } else {
                                alert('file not uploaded');
                            }
                        },
                    });
                });
                $('#add_new_department').click(function() {
                    var department = $('#FormControlInputDepartment').val();
                    $.ajax({
                        type: "POST",
                        url: "/admin/InsertDepartmentAdminWithoutPhoto",
                        data: "department=" + department+"&department_id="+iid ,
                        success: function (res) {
                            if(res == 1) {
                                $("#flash-msg-adding-department").show();
                                setTimeout(function () {
                                    location.reload();
                                }, 1000);
                            }
                        },
                        error: function () {}
                    });
                });
            });
        }
    });
});
// ALL DEPARTMENTS _END_
$(".column-admin .button-delete").each(function() {
    $(this).on("click", function(){
        var iid = $(this).attr('iid');
        var YOUR_MESSAGE_STRING_CONST = "Are you sure to Delete this product?";
        confirmDialog(YOUR_MESSAGE_STRING_CONST, function(){
            $.ajax({
                type: "POST",
                url: "/admin/DeleteProduct",
                data: "iid=" + iid ,
                success: function (response) {
                    if(response == 1) {
                        $("#flash-msg-deleting-product").show();
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    }
                },
                error: function () {
                    alert("Error");
                }
            });
            console.log("deleted!");
        });
        function confirmDialog(message, onConfirm){
            var fClose = function(){
                modal.modal("hide");
            };
            var modal = $("#confirmModal");
            modal.modal("show");
            $("#confirmMessage").empty().append(message);
            $("#confirmOk").unbind().one('click', onConfirm).one('click', fClose);
            $("#confirmCancel").unbind().one("click", fClose);
        }
    });
});
$('#edit_product').on("hidden.bs.modal", function() {
    location.reload();
});
$(".column-admin .button-edit").each(function(index) {
    $(this).on("click", function() {
        $('#edit_product').modal("show");
        var product_iid = $(this).attr('iid');
        $('#datetimepicker6').datetimepicker({
        }).on("dp.change", function (index, element) {
            var end_date = $('#datetimepicker6 input#bday').val();
            $.ajax({
                type: "POST",
                url: "/admin/UpdateDiscountEndDateValue",
                data: "end_date=" + end_date + "&product_id=" + product_iid,
                success: function (res) {
                },
                error: function () {
                    alert("Error");
                }
            });
        });
        $('#datetimepicker8').datetimepicker({
        }).on("dp.change", function (index, element) {
            var end_date = $('#datetimepicker8 input#bday_special_offer').val();
            $.ajax({
                type: "POST",
                url: "/admin/UpdateSpecialOfferEndDateValue",
                data: "end_date=" + end_date + "&product_id=" + product_iid,
                success: function (res) {
                },
                error: function () {
                    alert("Error");
                }
            });
        });
        var product_iid = $(this).attr('iid');
        $('.id-modal').val(product_iid);
        var name = $(this).attr('name');
        $('.name_modal_edit').val(name);

        $.ajax({
            type: "POST",
            url: "/admin/GetProductById",
            data: "id=" + product_iid,
            dataType: "json",
            success: function (res) {
                var workers = JSON.stringify(res);
                var obj = JSON.parse(workers);
                $(".adding_div_small_img").remove();
                $.each(obj, function(iy, ely) {
                    var id = ely['id'];
                    var name = ely['name'];
                    var brand = ely['brand'];
                    var colour = ely['colour'];
                    var price = ely['price'];
                    var img = ely['photo'];
                    var description = ely['big_description'];
                    var adding_info = ely['adding_info'];
                    var quantity = ely['quantity'];
                    var discount = ely['discount'];
                    var new_product = ely['new_product'];
                    var popular = ely['popular'];
                    var department_id = ely['department_id'];
                    var promotion = ely['promotion'];
                    var special_offer = ely['special_offer'];
                    var res_img = '/application/photo/'+department_id+'/'+img;
                    var value_discount = ely['value_discount'];
                    var end_date = ely['end_date'];
                    var end_date_special_offer = ely['end_date_special_offer'];
                    for(var i in ely['small_images']) {////маленькі фото Галерея вже загружені
                        var small_images = ely['small_images'][i];
                        var res_small_img = $.makeArray(small_images);
                        var small_id = ely['small_id'][i];
                        var res_small_id = $.makeArray(small_id);
                        $(".preview_small").each(function() {
                            $(this).remove();
                        });
                        if ($('.modal_small_images_div' + res_small_id)[0]) {
                        }else{
                            var id_of_this_page_product = $('.id-modal').val();
                            $('.small_images_modal_edit').each(function() {
                                $(this).attr('id_of_this_product', id_of_this_page_product);
                                var attr_id_of_this_product = $(this).attr('id_of_this_product');
                                if (id_of_this_page_product != attr_id_of_this_product) {
                                } else {
                                    $('.small_images').css('display','block');
                                    $('.small_images_modal_edit')
                                    .append($('<div>')
                                        .addClass('adding_div_small_img')
                                        .css('width','160px')
                                        .append($('<div>')
                                            .addClass('modal_small_images_div' + res_small_id)
                                            .css('width', '160px')
                                            .attr('id_of_this_product', id_of_this_page_product)
                                            .css('padding', '10px')
                                            .css('margin-left', '50px')
                                            .css('margin-bottom', '10px')
                                            .append($('<img>')
                                                .attr('src', '/application/photo/small_images/' + department_id + '/' + res_small_img)
                                                .addClass('modal_small_images_main')
                                                .css('width', '120px')
                                                .attr('iid', res_small_id))
                                                .append($('<button>')
                                                    .attr('type', 'button')
                                                    .css('margin-left', '-10px')
                                                    .css('margin-top', '-5px')
                                                    .css('opacity', '1')
                                                    .css('color', 'red')
                                                    .css('margin-left', '-15px')
                                                    .addClass('close')
                                                    .attr('sm_img_iid', res_small_id)
                                                    .attr('aria-label', 'Close')
                                                    .append($('<span>')
                                                        .attr('aria-hidden', true)
                                                        .html('&times;')
                                                )
                                            )
                                        )
                                    )
                                }
                            });
                            $('.close').click(function (index) {
                                var iid_sm_img = $(this).attr('sm_img_iid');
                                $.ajax({
                                    url: "/admin/DeleteSmImgPreview",
                                    type: "POST",
                                    data: "id=" + iid_sm_img,
                                    success: function (res) {
                                    },
                                    error: function () {
                                        alert("Error");
                                    }
                                });
                                $('.modal_small_images_div' + iid_sm_img).remove();
                            });
                        }
                    }
                    $('.name_modal_edit').val(name);
                    $('.brand_modal_edit').val(brand);
                    $('.colour_modal_edit').val(colour);
                    $('.price_edit').val(price);
                    $('.big_description').summernote('code',description);
                    $('.adding_info').summernote('code',adding_info);
                    $('.quantity').val(quantity);
                    $('.quantity_discount').val(value_discount);
                    $('#SelectPromotion').val(promotion);
                    $('#bday').val(end_date);
                    $('#bday_special_offer').val(end_date_special_offer);
                    if(discount ==1){
                        $('#discount').prop('checked', true);
                        $('.quantity_discount').attr('disabled', false);
                        $('#bday').prop('disabled',false);
                    }
                    $('.discount_edit').change(function() {
                        if (this.checked) {
                            $('.quantity_discount').attr('disabled', false);
                            $('#bday').attr('disabled', false);
                        } else {
                            $('.quantity_discount').attr('disabled', true);
                            $('#bday').attr('disabled', true);
                        }
                    });
                    if(promotion !=0){
                        $('#promotion').prop('checked', true);
                        $('#SelectPromotion').attr('disabled', false);
                    }
                    $('#promotion').change(function() {
                        if (this.checked) {
                            $('#SelectPromotion').attr('disabled', false);
                        } else {
                            $('#SelectPromotion').attr('disabled', true);
                        }
                    });
                    $('#special_offer').change(function() {
                        if (this.checked) {
                            $('#bday_special_offer').prop('disabled',false);
                        } else {
                            $('#bday_special_offer').prop('disabled',true);
                        }
                    });
                    if(new_product ==1){
                        $('#new_product').prop('checked', true);
                    }
                    if(special_offer ==1){
                        $('#special_offer').prop('checked', true);
                        $('#bday_special_offer').prop('disabled',false);
                    }
                    if(popular ==1){
                        $('#popular').prop('checked', true);
                    }
                    $('.image_modal_edit').find('img').attr('src',res_img);
                    $('.modal_main_image_block input[type="file"]').change(function(e){//маленька картинка до головної
                        var info = e.target.files;
                        var fileName = e.target.files[0].name;
                        var fd = new FormData();
                        var files = e.target.files[0];
                        fd.append('file',files);
                        $.ajax({
                            url: "/admin/Upload/?department_id_from_url="+department_id,
                            type: 'post',
                            data: fd,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                if (response != 0) {
                                    $('.image_modal_edit').find('img').attr('src','/application/photo/'+department_id+'/' + response);
                                    $('.small_images').css('display','block');
                                    $('.preview').remove();
                                    $('.modal_main_image_block')
                                        .append($('<div>')
                                            .addClass('preview')
                                            .css('width','160px')
                                            .css('margin-left','50px')
                                            .css('padding','10px')
                                            .append($('<img>')
                                                .attr('src', '/application/photo/'+department_id+'/' + response)
                                                .css('width', '120px')
                                                .css('height', '100px')
                                            )
                                            .append($('<button>')
                                                .attr('type', 'button')
                                                .css('margin-left', '-10px')
                                                .css('margin-top', '-5px')
                                                .addClass('close')
                                                .attr('aria-label', 'Close')
                                                .append($('<span>')
                                                    .attr('aria-hidden', true)
                                                    .html('&times;')
                                                )
                                            )
                                        )
                                    $('.preview').show();
                                    $('.preview').click(function () {
                                        $(this).find('img').remove();
                                        $(this).find('button').remove();
                                        $('.modal_main_image_block input[type="file"]').val('');
                                        $('.image_modal_edit').find('img').attr('src','');
                                        $('.small_images').css('display','none');
                                    });
                                    $.ajax({
                                        type: "POST",
                                        url: "/admin/UpdatePhoto",
                                        data: "id=" + product_iid +"&photo=" + response ,
                                        success: function (res) {
                                        },
                                        error: function () {
                                            alert("Error");
                                        }
                                    });
                                } else {
                                    alert('file not uploaded');
                                }
                            },
                        });
                    });
                    $('.small_images').each(function() {////маленькы фото щойно добавлены
                        $(this).on('change', 'input',function(e) {
                            var id_of_this_page_product = $('.id-modal').val();
                            var info = e.target.files;
                            var filesLength = info.length;
                            var fd = new FormData();
                            for (var i = 0; i < filesLength; i++) {
                                var files = info[i];
                                console.log(files);
                            }
                            fd.append('file', files);
                            $('.addimage').find('input:file').val('');
                            $.ajax({
                                url: "/admin/UpSmImg/?department_id_from_url="+department_id,
                                type: 'post',
                                data: fd,
                                contentType: false,
                                processData: false,
                                success: function (response_Sm_Img) {
                                    var img_small =  $.trim(response_Sm_Img);
                                    if (img_small !=0) {
                                        $.ajax({
                                            type: "POST",
                                            url: "/admin/InsertSmallPhoto",
                                            data: "product_id=" + id_of_this_page_product +"&photo=" + img_small ,
                                            success: function (res_Inserted_Small_Img) {
                                                var insertedId_small_img = $.trim(res_Inserted_Small_Img);
                                                if (insertedId_small_img != 0) {
                                                    $('.modal_small_img_uploads')
                                                        .css('width', '160px')
                                                        .css('padding', '10px')
                                                        .css('margin-left', '50px')
                                                        .append($('<div>')
                                                            .addClass('preview_small')
                                                            .append($('<div>')
                                                                .addClass('preview_small'+insertedId_small_img)
                                                                .append($('<img>')
                                                                    .attr('src', '/application/photo/small_images/' + department_id + '/' + img_small)
                                                                    .css('width', '120px')
                                                                    .css('height', '100px')
                                                                    .css('margin-bottom', '30px')
                                                                )
                                                                .append($('<button>')
                                                                    .attr('type', 'button')
                                                                    .css('margin-left', '-10px')
                                                                    .css('margin-top', '-5px')
                                                                    .css('color', 'red')
                                                                    .css('opacity', '1')
                                                                    .addClass('close')
                                                                    .attr('sm_img_iid', insertedId_small_img)
                                                                    .attr('aria-label', 'Close')
                                                                    .append($('<span>')
                                                                        .attr('aria-hidden', true)
                                                                        .html('&times;')
                                                                    )
                                                                )
                                                            )
                                                        )
                                                    $('.preview_small').css('display', 'block');
                                                    $('.small_images').css('display', 'block');
                                                }
                                            },
                                            error: function () {
                                                alert("Error");
                                            }
                                        });
                                        $('.close').click(function () {
                                            $('#addimage0  input[type="file"]').val('');
                                            var iid_small_images = $(this).attr('sm_img_iid');
                                            $.ajax({
                                                url: "/admin/DeleteSmImgAdded",
                                                type: "POST",
                                                data: "id=" + iid_small_images,
                                                success: function (res) {
                                                },
                                                error: function () {
                                                    alert("Error");
                                                }
                                            });
                                            $(this).remove();
                                            $(this).find('img').remove();
                                            $('.preview_small'+iid_small_images).find('div').remove();
                                        });
                                    } else {
                                        alert('file not uploaded');
                                    }
                                },
                            });
                        });///close
                    });
                });
                $('#submit_form_edit').click(function(){
                    if ($('#new_product').is(':checked')) {
                        var new_product = '1';
                    } else {
                        var new_product = '0';
                    }
                    if($('#discount').is(':checked')) {
                        var discount = '1';
                        var value_discount = $('.quantity_discount').val();
                        var end_date_discount = $('#datetimepicker6 input#bday').val();
                    }else{
                        var discount = '0';
                        var value_discount = '0';
                        var end_date_discount = '0';
                    }
                    if ($('#popular').is(':checked')) {
                        var popular = '1';
                    } else {
                        var popular = '0';
                    }
                    if ($('#special_offer').is(':checked')) {
                        var special_offer = '1';
                        var value_special_offer = $('.description_special_offer').val();
                        var end_date_special_offer = $('#datetimepicker8 input#bday_special_offer').val();
                    } else {
                        var special_offer = '0';
                        var value_special_offer = '0';
                        var end_date_special_offer = '0';
                    }
                    if ($('#promotion').is(':checked')) {
                        var promotion = $("#SelectPromotion option:selected").attr('promotion_id');
                    } else {
                        var promotion = '0';
                    }
                    var name = $('.name_modal_edit').val();
                    var brand = $('.brand_modal_edit').val();
                    var colour = $('.colour_modal_edit').val();
                    var price = $('.price_edit').val();
                    var big_description = $('.big_description').val();
                    var adding_info = $('.adding_info').val();
                    var quantity = $('.quantity').val();
                    $.ajax({
                        type: "POST",
                        url: "/admin/UpdateProduct",
                        data: "name="+name+"&value_discount="+value_discount+"&end_date_discount="+end_date_discount+"&value_special_offer="+value_special_offer+"&end_date_special_offer="+end_date_special_offer+"&brand="+brand+"&colour="+colour+"&price="+price+"&big_description="+big_description+"&adding_info="+adding_info+"&quantity="+quantity + "&iid=" + product_iid + "&discount=" + discount + "&new_product=" + new_product + "&special_offer="+ special_offer + "&popular=" + popular+"&promotion="+promotion,
                        success: function (res) {
                            if($.trim(res==1)){
                                $("#flash-msg-edition-product").show();
                                setTimeout(function () {
                                    location.reload();
                                }, 2000);
                            }
                        },
                        error: function () {
                        }
                    });
                });
            },
            error: function () {
            }
        });
        $('.small_images').on('click','a', function () {
            var rel = $(this).attr("rel");
            $("#addimage" + rel).fadeOut(300, function () {
                $("#addimage" + rel).remove();
                $('#addimage' + (rel )).find('input:file').val('');
                $('.preview_small' + (rel)).find('img').remove();
                $('.preview_small' + (rel)).find('button').remove();
                $('.preview_small' + (rel)).find('hr').remove();
            });
        });
        $('.quantity_discount').change(function(){
            var value_discount = $('.quantity_discount').val();
            $.ajax({
                type: "POST",
                url: "/admin/UpdateDiscountValue",
                data: "value_discount=" + value_discount + "&product_id=" + product_iid,
                success: function (res) {
                },
                error: function () {
                    alert("Error");
                }
            });
        });
    });
});
// ABOUT
$('.admin-about').click(function(){
    $("#modalAbout").modal("show");
    $.ajax({
        type:"post",
        url:"/main/GetAbout",
        data:"id="+1,
        dataType:"json",
        success:function(res){
            var workers = JSON.stringify(res);
            var obj = JSON.parse(workers);
            $.each(obj, function(iy, ely) {
                var content = ely['content'];
                $('#adminAboutContent').summernote('code',content);
            });
        },
        error:function(){
        }
    });
    $('#about_company_admin').click(function(){
        var title =  $('#adminAboutTitle').val();
        var textareaValue = $('#adminAboutContent').summernote('code');
        $.ajax({
            type:"post",
            url:"/admin/UpdateAboutCompany",
            data:"title="+title+"&content="+textareaValue,
            success:function(res){
            },
            error:function(){
            }
        })
    });
});
// ABOUT _END_