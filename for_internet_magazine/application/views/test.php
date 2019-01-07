<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>
<!DOCTYPE html>
<html>
    <head>
        <title>Webslesson Tutorial | Make Treeview using Bootstrap Treeview Ajax JQuery with PHP</title>
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
        <br /><br />
            <div class="container" style="width:900px;">
                <h2 align="center">All workers</h2>
                <br /><br />
                <div class="row">
                    <!-- DELETING SUCCESS-->
                    <div class="alert alert-success deleting_worker alert-dismissable" style="display: none;" id="flash-msg-deleting-worker">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <h4><i class="icon fa fa-check"></i>Success!</h4><p>Worker've  successfully deleted!</p>
                    </div>
                    <!--DELETING SUCCESS-->
                    <!--  UPDATING SUCCESS-->
                    <div class="alert alert-success deleting_worker alert-dismissable" style="display: none;" id="flash-msg-updating-worker">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <h4><i class="icon fa fa-check"></i>Success!</h4><p>Worker've  successfully updated!</p>
                    </div>
                    <!--UPDATING SUCCESS-->
                    <!-- ADDING SUCCESS-->
                    <div class="alert alert-success deleting_worker alert-dismissable" style="display: none;" id="flash-msg-adding-worker">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <h4><i class="icon fa fa-check"></i>Success!</h4><p>Worker've  successfully added!</p>
                    </div>
                    <div class="form-group">
                        <div class='input-group date' id='datetimepicker3'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                        </div>
                    </div>
                    <div id="treeview"></div>

                    <!-- The Modal -->
                    <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h3 class="modal-title">Add new worker</h3>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <?php
                                    $posts = new \Application\models\Workers();
                                    $res_posts = $posts->get_posts();?>
                                    <form method="post" class="feedback" >
                                        <div class="form-group">
                                            <label for="FormControlInputName">Name:</label>
                                            <input type="text" name="name"  id="FormControlInputName" class="form-control" placeholder="Name">
                                            <label for="FormControlInputLastName">Last name:</label>
                                            <input type="text" name="lastname" id="FormControlInputLastName" class="form-control" placeholder="Last name">
                                            <label for="FormControlInputPatronymic">Patronymic:</label>
                                            <input type="text" name="patronymic" id="FormControlInputPatronymic" class="form-control" placeholder="Patronymic">
                                            <label for="FormControlInputPost">Post:</label>
                                            <select class="form-control" id="FormControlInputPost">
                                                <option selected>Выбрать...</option>
                                                <?php foreach ($res_posts as $res_post){?>
                                                    <option post_id="<?= $res_post['id'];?>"><?= $res_post['post'];?></option>
                                                <?php }?>
                                            </select>
                                            <label for="FormControlInputSalary">Salary:</label>
                                            <input type="text" name="salary" id="FormControlInputSalary" class="form-control" placeholder="Salary">
                                            <label for="FormControlInputEmail">Email:</label>
                                            <input type="text" name="email" id="FormControlInputEmail" class="form-control" placeholder="Email">
                                            <label for="datetimepicker1">Birth Day:</label>
                                            <div class='input-group date' id='datetimepicker1' >
                                                <input type='text' class="form-control" id="bday" name="bday"/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="submit" name="add_new_worker" id="add_new_worker" class="btn btn-info" data-dismiss="modal" >Добавить</button>
                                </div>
                            </div>
                        </div>
                    </div><!--END MODAl -->
                    <!-- The UPDATE Modal -->
                    <div class="modal" id="updateModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h3 class="modal-title">Add new worker</h3>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <?php
                                    $posts = new \Application\models\Workers();
                                    $res_posts = $posts->get_posts();
                                    ?>
                                    <form method="post" class="feedback" >
                                        <div class="form-group">
                                            <label for="FormControlInputName">Name:</label>
                                            <input type="text" name="name" id="FormControlInputName" class="form-control" placeholder="Name">
                                            <label for="FormControlInputLastName">Last name:</label>
                                            <input type="text" name="lastname" id="FormControlInputLastName" class="form-control" placeholder="Last name">
                                            <label for="FormControlInputPatronymic">Patronymic:</label>
                                            <input type="text" name="patronymic" id="FormControlInputPatronymic" class="form-control" placeholder="Patronymic">
                                            <label for="FormControlInputPost">Post:</label>
                                            <select class="form-control" id="FormControlInputPost">
                                                <option selected>Выбрать...</option>
                                                <?php foreach ($res_posts as $res_post){?>
                                                    <option id="yes" post_id="<?= $res_post['id']; ?>"><?= $res_post['post'];?></option>
                                                <?php }?>
                                            </select>
                                            <label for="FormControlInputSalary">Salary:</label>
                                            <input type="text" name="salary" id="FormControlInputSalary" class="form-control" placeholder="Salary">
                                            <label for="FormControlInputEmail">Email:</label>
                                            <input type="text" name="email" id="FormControlInputEmail" class="form-control" placeholder="Email">
                                            <label for="datetimepicker1">Birth Day:</label>
                                            <div class='input-group date' id='datetimepicker2' >
                                                <input type='text' class="form-control" id="bday" name="bday"/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                            <div id="res"></div><br>
                                            <div id="res1"></div>
                                        </div>
                                    </form>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="submit" name="update_new_worker" id="update_new_worker" class="btn btn-info" data-dismiss="modal" >Обновить</button>
                                </div>
                            </div>
                        </div>
                    </div><!--END UPDATE MODAl -->
                    <!-- Modal confirm -->
                    <div class="modal" id="confirmModal" style="display: none; z-index: 1050;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body" id="confirmMessage">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" id="confirmOk">Ok</button>
                                    <button type="button" class="btn btn-default" id="confirmCancel">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div id="showDate"></div>
        <div id="DateTest"></div>
        <div id="lbl2"></div>
        <div id="detailModal" style="display:none;" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h3 class="modal-title">Details of delivery(ies) for this day</h3>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <table class="table table-dark">
                            <thead>
                            <tr>
                                <th>Address</th>
                                <th>Date</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="modal_delivery_date_address"></td>
                                <td class="modal_delivery_date_date"></td>
                                <td class="modal_delivery_date_time"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<style>
    .activeClass{
        background: red;
        color:darkgreen;
    }
    .hover{
        background: greenyellow;
        color:darkgreen;
    }
</style>

    <script>
        $(document).ready(function(){
            $(function () {
                $('#datetimepicker1').datetimepicker({
                    defaultDate: new Date()
                });
                $('#datetimepicker2').datetimepicker({
                    defaultDate: new Date()
                });
                $(function () {
                    $('#datetimepicker3').datetimepicker({
                        format: 'DD/MM/YYYY',
                        defaultDate: new Date()
                    }).on("dp.show", function () {
                        $.ajax({
                            type: "POST",
                            url: "/main/GetDelivery",
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
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "/main/GetDeliveryByDate",
                                                        data: "date=" + day,
                                                        success: function () {
                                                            var address = el['address'];
                                                            var time = el['time'];
                                                            var date = el['date'];
                                                            $(".modal_delivery_date_address").html(address);
                                                            $(".modal_delivery_date_time").html(time);
                                                            $(".modal_delivery_date_date").html(date);
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
                                                url: "/main/GetDeliveryByDate",
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
                                                     alert("Error");
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
                });
            });
            $.ajax({
                url: "/main/response",
                method:"POST",
                dataType: "json",
                success: function(data)
                {
                    $('#treeview').treeview({
                        data: data,
                    });
                    $('#treeview').click(function() {
                        $('.glyphicon.glyphicon-trash').on("click", function(e){
                            var iid = $(this).attr('iid');
                            var YOUR_MESSAGE_STRING_CONST = "Are you sure to Delete this worker?";
                            confirmDialog(YOUR_MESSAGE_STRING_CONST, function(){
                                $.ajax({
                                    type: "POST",
                                    url: "/main/DeleteWorker",
                                    data: "&iid=" + iid ,
                                    success: function (response) {
                                        if(response == 1) {
                                            $("#flash-msg-deleting-worker").show();
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
                            $(".modal-body #res").html(iid);
                            $.ajax({
                                type: "POST",
                                url: "/main/GetId",
                                data: "iid="+iid,
                                dataType: "json",
                                success: function (response) {
                                    var workers = JSON.stringify(response);
                                    var obj = JSON.parse(workers);
                                    $.each(obj, function(i, el) {
                                        var lastname = el['lastname'];
                                        var name = el['name'];
                                        var patronymic = el['patronymic'];
                                        var birth_day = el['birth_day'];
                                        var salary = el['salary'];
                                        var email = el['email'];
                                        var post = el['post'];
                                        $('.modal-body #FormControlInputName').attr('value', name);
                                        $('.modal-body #FormControlInputLastName').attr('value', lastname);
                                        $('.modal-body #FormControlInputPatronymic').attr('value', patronymic);
                                        $('.modal-body #datetimepicker2 input#bday').val( birth_day);
                                        $('.modal-body #FormControlInputSalary').attr('value', salary);
                                        $('.modal-body #FormControlInputEmail').attr('value', email);
                                        $('.modal-body #FormControlInputPost').val(post);
                                    });
                                    $("button#update_new_worker").click(function() {
                                        var post_id = $('select#FormControlInputPost option:selected').attr('post_id');
                                        $.ajax({
                                            type: "POST",
                                            url: "/main/UpdateWorker",
                                            data: $('form.feedback').serialize() + "&iid=" + iid +"&post_id="+ post_id,
                                            success: function (response) {
                                                if(response == 1) {
                                                    $("#flash-msg-updating-worker").show();
                                                    setTimeout(function () {
                                                        location.reload();
                                                    }, 4000);
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
                    $("button#add_new_worker").click(function () {
                        var post_id = $('select#FormControlInputPost option:selected').attr('post_id');
                        $.ajax({
                            type: "POST",
                            url: "/main/AddWorker",
                            data: $('#myModal form.feedback').serialize() + "&post_id=" + post_id,
                            success: function (response) {
                                if(response == 1) {
                                    $("#flash-msg-adding-worker").show();
                                    setTimeout(function () {
                                        location.reload();
                                    }, 4000);
                                }
                            },
                            error: function () {
                                alert("Error");
                            }
                        });
                    });
                }
            });
        });
    </script>