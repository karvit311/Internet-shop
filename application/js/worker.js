// WORKER
$(document).ready(function() {
    $('#example').DataTable();
});
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
                $('.glyphicon.glyphicon-trash').on("click", function(){
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
                    defaultDate: new Date()
                });
                $('#datetimepicker3').datetimepicker({
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
// WORKER _ENE_