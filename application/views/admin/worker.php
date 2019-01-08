<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$_SESSION['urlpage'] = "<a href='/site/index'>Работники</a>";?>
<!DOCTYPE html>
<html>
    <head>
        <title>Редактирование работников!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <style>
        h3{
            margin-top:30px;
            margin-bottom:30px;
            font-weight:bold;
        }
        #treeview{
            margin-top:50px;
            margin-bottom:60px;
        }
        .dataTables_wrapper {
            border:1px solid rosybrown;
        }
    </style>
    <style>
        #example{
            float:left;
            display:inline-block;
        }
    </style>
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

    <body>
        <br /><br />
            <div class="container" style="width:900px;">
                <div class="row">
                    <div class="body-admin">
                        <div id="block-body-admin">
                            <?php
                                include("block-header.php");
                            ?>
                            <div id="block-content-admin">
                                <?php
                                if($_SESSION['admin'] = "admin"){
                                    if (isset($_SESSION['admin_role'])) {
                                        if($_SESSION['admin_role'] == 'admin-worker' || $_SESSION['admin_role'] == 'admin'){
                                        ?>
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
                                            <h3 class="text-uppercase text-center " ><span>Edition of Workers</span></h3>
                                            <div id="treeview"></div>
                                            <h3 class="text-uppercase text-center ">Searching Workers</h3>
                                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                <tr style="background:rosybrown;">
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                    <th>Office</th>
                                                    <th>Age</th>
                                                    <th>Start date</th>
                                                    <th>Salary</th>
                                                    <th>Salary</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $list_workers = new \Application\models\Workers();
                                                    $workers = $list_workers->get_workers();
                                                    foreach($workers as $worker) {
                                                        $initial_lastname = utf8_encode($worker['lastname']);
                                                        $initial_lastname = utf8_decode($initial_lastname);
                                                        $initial_name = utf8_encode($worker['name']);
                                                        $initial_name = mb_substr($initial_name,0,2);
                                                        $initial_name = utf8_decode($initial_name);
                                                        $initial_patronymic = utf8_encode($worker['patronymic']);
                                                        $initial_patronymic = mb_substr($initial_patronymic,0,2);
                                                        $initial_patronymic = utf8_decode($initial_patronymic);
                                                        $initial = $initial_lastname.'. '.$initial_name.'. '.$initial_patronymic;
                                                        $todayDate = $date = date('Y-m-d H:i:s');
                                                        $age = $todayDate - $worker['birth_day'];
                                                        $post = new \Application\models\Workers();
                                                        $post_res = $post->get_post($worker['post_id']);
                                                        $post_res->execute(array($worker['post_id']));
                                                        foreach ($post_res as $res){
                                                        }?>
                                                        <tr>
                                                            <td><?= $initial;?></td>
                                                            <td><?= $worker['birth_day']?></td>
                                                            <td><?= $res['post']; ?></td>
                                                            <td><?= $age.' лет'; ?></td>
                                                            <td><?= $worker['start_day']; ?></td>
                                                            <td><?= $worker['salary'].'$'; ?></td>
                                                            <td><?= $worker['email']?></td>
                                                        </tr>
                                                    <?php }?>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                    <th>Office</th>
                                                    <th>Age</th>
                                                    <th>Start date</th>
                                                    <th>Salary</th>
                                                    <th>Salary</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                            <!-- The Modal -->
                                            <div class="modal" id="myModal-admin-worker-add-new-worker">
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
                                                            <form method="post" class="feedback-admin-worker-add-new-worker">
                                                                <div class="form-group">
                                                                    <label for="FormControlInputName">Name:</label>
                                                                    <input type="text" name="name"  id="FormControlInputName" class="form-control" placeholder="Name" autocomplete="off">
                                                                    <label for="FormControlInputLastName">Last name:</label>
                                                                    <input type="text" name="lastname" id="FormControlInputLastName" class="form-control" placeholder="Last name">
                                                                    <label for="FormControlInputPatronymic">Patronymic:</label>
                                                                    <input type="text" name="patronymic" id="FormControlInputPatronymic" class="form-control" placeholder="Patronymic">
                                                                    <label for="FormControlInputPost">Post:</label>
                                                                    <select class="form-control" id="FormControlInputPost">
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
                                                                    <label for="datetimepicker3">Start Day:</label>
                                                                    <div class='input-group date' id='datetimepicker3' >
                                                                        <input type='text' class="form-control" id="start_day" name="start_day"/>
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
                                                                    <label for="datetimepicker2">Birth Day:</label>
                                                                    <div class='input-group date' id='datetimepicker2'>
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
                                    <?php
                                    }else{?>
                                        <!-- ERROR PRIVILEGE-->
                                        <div class="alert alert-danger  alert-dismissable error-privilege"  id="flash-msg-privilege-orders">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                            <h4><i class="icon fa fa-check"></i>ERROR!</h4><p>У Вас нет прав на редактирование работников!</p>
                                        </div>
                                        <?php
                                    }
                                }else{ ?>
                                    <script type="text/javascript">
                                        window.location.href = '/main/Login';
                                    </script>
                                <?php }
                            } else {
                                header('Location: /main/Login');
                            }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>

    <script>
        $(document).ready(function(){
            $.ajax({
                url: "/admin/response",
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
                                    url: "/admin/DeleteWorker",
                                    data: "&iid=" + iid ,
                                    success: function (response) {
                                        if(response == 1) {
                                            $("#flash-msg-deleting-worker").show();
                                            setTimeout(function () {
                                                location.reload();
                                            }, 2000);
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
                                // format: 'DD/MM/YYYY',
                                defaultDate: new Date()
                            });
                            $(".modal-body #res").html(iid);
                            $.ajax({
                                type: "POST",
                                url: "/admin/GetId",
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
                                        $('.modal-body #datetimepicker2 input#bday').val(birth_day);
                                        $('.modal-body #FormControlInputSalary').attr('value', salary);
                                        $('.modal-body #FormControlInputEmail').attr('value', email);
                                        $('.modal-body #FormControlInputPost').val(post);
                                    });
                                    $("button#update_new_worker").click(function() {
                                        var post_id = $('select#FormControlInputPost option:selected').attr('post_id');
                                        $.ajax({
                                            type: "POST",
                                            url: "/admin/UpdateWorker",
                                            data: $('form.feedback').serialize() + "&iid=" + iid +"&post_id="+ post_id,
                                            success: function (response) {
                                                if(response == 1) {
                                                    $("#flash-msg-updating-worker").show();
                                                    setTimeout(function () {
                                                        location.reload();
                                                    }, 2000);
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
                    $("#myModal-admin-worker-add-new-worker").on("show.bs.modal", function(e) {
                        var iid = $(e.relatedTarget).data('iid');
                        var post_id = $(e.relatedTarget).data('post_id');
                        $.ajax({
                            type: "POST",
                            url: "/admin/GetPostByParent",
                            data: "post_id="+post_id,
                            dataType:"json",
                            success: function (response) {
                                console.log(response);
                                var post=[];
                                $('#FormControlInputPost').find('option').remove();
                                $.each(response, function(i, el) {
                                    // $('#FormControlInputPost').append($('<option>')
                                    //     .text(post)
                                    //     .attr('post_id',post_id)
                                    // )
                                    for(var ii in el['post']) {
                                        var posts = el['post'][ii];
                                        var post_id = el['id'][ii];

                                        $('#FormControlInputPost').append($('<option>')
                                            .text(posts)
                                            .attr('post_id',post_id)
                                        )
                                    }
                                });
                            },
                            error: function () {
                                alert("Error");
                            }
                        });

                        $('#datetimepicker1').datetimepicker({
                            // format: 'DD/MM/YYYY',
                            defaultDate: new Date()
                        });
                        $('#datetimepicker3').datetimepicker({
                            // format: 'DD/MM/YYYY',
                            defaultDate: new Date()
                        });

                    });
                    $("button#add_new_worker").click(function () {
                        var name = $('#FormControlInputName').val();
                        var last_name = $('#FormControlInputLastName').val();
                        var patronymic = $('#FormControlInputPatronymic').val();
                        var salary = $('#FormControlInputSalary').val();
                        var email = $('#FormControlInputEmail').val();
                        var bday = $('#bday').val();
                        var start_day = $('#start_day').val();
                        var post_id = $('select#FormControlInputPost option:selected').attr('post_id');
                        $.ajax({
                            type: "POST",
                            url: "/admin/AddWorker",
                            data: "name="+name+"&last_name="+last_name+"&patronymic="+patronymic+"&salary="+salary+"&email="+email+"&bday="+bday + "&post_id=" + post_id+"&start_day="+start_day,
                            success: function (response) {
                                // alert(response);
                                if(response == 1) {
                                    $("#flash-msg-adding-worker").show();
                                    setTimeout(function () {
                                        location.reload();
                                    }, 2000);
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