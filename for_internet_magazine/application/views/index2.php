<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Company info</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
</head>
<body>
<div id="default-tree"></div>

<div class="container">

    <h2>Deliveres</h2>
    <div style="overflow:hidden;">
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <div id="datetimepicker4"></div>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-hover">
        <thead>
        <tr style="background: #ffcaca;">
            <th>Город доставки</th>
            <?php
            //$date = new \Application\models\Delivery();
            // $post_res = $post->get_post($worker['post_id']);
            //$post_res->execute(array($worker['post_id']));?>
            <th class="day_of_week_monday" date="">Пн.</th>
            <th class="day_of_week_tuesday" date="">Вт.</th>
            <th class="day_of_week_wednesday" date="">Ср.</th>
            <th class="day_of_week_thursday" date="">Чт.</th>
            <th class="day_of_week_friday" date="">Пт.</th>
            <th class="day_of_week_saturday" date="">Сб.</th>
            <th class="day_of_week_sunday" date="">Вс.</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $list_cities = new \Application\models\Cities();
        $cities = $list_cities->get_cities();
        foreach ($cities as $city){?>
            <tr>
                <td class="city_deliver" date="" city_id="<?= $city['id'];?>" ><?= $city['city'];?></td>
                <td class="hour_delivery day_of_week_monday" date="" city_id="<?= $city['id'];?>"></td>
                <td class="hour_delivery day_of_week_tuesday" date="" city_id="<?= $city['id'];?>"></td>
                <td class="hour_delivery day_of_week_wednesday" date="" city_id="<?= $city['id'];?>"></td>
                <td class="hour_delivery day_of_week_thursday" id="" city_id="<?= $city['id'];?>"></td>
                <td class="hour_delivery day_of_week_friday" id=""city_id="<?= $city['id'];?>"></td>
                <td class="hour_delivery day_of_week_saturday" id="" city_id="<?= $city['id'];?>"></td>
                <td class="hour_delivery day_of_week_sunday" id="" city_id="<?= $city['id'];?>"></td>
            </tr>
        <?php }?>
        <script>
        </script>
        </tbody>
    </table>
</div>
<div id="output4"></div>
<div id="output5"></div>
</body>
</html>
<script>
    $(document).ready(function() {
        // });
        var attribute = $('#lastDay').attr('lastDay');
        var date = new Date(),
            yr = date.getFullYear(),
            month = (date.getMonth() + 1) < 10 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1),
            day = date.getDate() < 10 ? '0' + date.getDate() : date.getDate(),
            newDate = day + '/' + month + '/' + yr;
        newDate = yr + '-' + month + '-' + day;
        // console.log(newDate);

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
        $.each($('.city_deliver'), function (i,el) {
            var attribute_city_id = $(this).attr('city_id');
            //
        });
        var attribute_city_id = 3;
            $.ajax({
                type: "POST",
                url: "/main/GetDeliveryByCityId",
                data: "city_id=" + attribute_city_id,
                //dataType: "json",
                success: function (response) {
                    var arr = response;
                    // console.log(response);
                    // console.log(response['date']);
                    $.each(response, function (i,el) {

                        // console.log(el[response]);
                    });
                    // arr = obj;
                    for (var i = 0; i < 3; i++) {
                        // console.log(response[i]);
                    }
                    var i;
                    // alert(response.time);
                    for (i in response) {
                        // console.log(response[i]);
                    }
                    // });
                },
                error: function () {
                    // alert("Error");
                }
            });
        //});
    });
</script>
<style>
    .activeClass{
        background: red;
        color:darkgreen;
    }
    .hover{
        background: greenyellow;
        color:darkgreen;
    }
</style>;