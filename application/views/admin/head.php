<!DOCTYPE html>
<html lang="en">
<head>
<!--    <title></title>-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/application/js/dist/summernote.css">
    <link rel="stylesheet" href="/application/js/dist/summernote.min.css">
    <link rel="stylesheet" href="/application/js/dist/summernote-bs4.css">
    <link rel="stylesheet" href="/application/js/dist/summernote-bs4.min.css">
    <link rel="stylesheet" href="/application/js/dist/summernote-lite.css">
    <link rel="stylesheet" href="/application/js/dist/summernote-lite.min.css">

    <link rel="stylesheet" href="/application/js/jquery-ui-1.12.1.custom/jquery-ui.css">
    <link rel="stylesheet" href="/application/js/jquery-ui-1.12.1.custom/jquery-ui.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="/application/js/bootstrap-wysihtml5-master/lib/css/prettify.css"/>
    <link rel="stylesheet" type="text/css" href="/application/js/bootstrap-wysihtml5-master/src/bootstrap-wysihtml5.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" />
    <link rel="stylesheet" href="/application/css/site2.css">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/application/css/css.css">

    <link rel="stylesheet" href="/application/css/admin.css">
    <link rel="stylesheet" href="/application/css/newsAdmin.css">
    <link rel="stylesheet" href="/application/css/footer.css">

<!--    <script type="text/javascript">-->
<!--        var jQuery_1_12_2 = $.noConflict(true);-->
<!--    </script>-->

<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>-->
<!--    <script src="https://code.jquery.com/jquery-1.12.2.min.js" integrity="sha256-lZFHibXzMHo3GGeehn1hudTAP3Sc0uKXBXAzHX1sjtk=" crossorigin="anonymous"></script>-->
    <script
            src="https://code.jquery.com/jquery-1.9.0.js"
            integrity="sha256-TXsBwvYEO87oOjPQ9ifcb7wn3IrrW91dhj6EMEtRLvM="
            crossorigin="anonymous"></script>
<!--    <script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
<!--    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>-->

<!--    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>-->
    <script src="/application/js/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
    <script src="/application/js/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>

    <!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
    <!--        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<!--    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css"/>-->
<!--    <script src=" https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>-->
<!--    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>-->

    <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript"  src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="/application/js/jcarousellite_1.1.js"></script>
    <script src="/application/js/popper/popper.js"></script>
    <script src="/application/js/popper/popper.min.js"></script>
    <script src="/application/js/popper/tooltip.js"></script>
    <script src="/application/js/popper/tooltip.min.js"></script>
    <script src="/application/js/dist/summernote.js"></script>
    <script src="/application/js/dist/summernote.min.js"></script>
    <script src="/application/js/dist/summernote-bs4.js"></script>
    <script src="/application/js/dist/summernote-bs4.min.js"></script>
    <script src="/application/js/dist/summernote-lite.js"></script>
    <script src="/application/js/dist/summernote-lite.min.js"></script>
<!--    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>-->
    <script src="/application/js/JQuery-Session-Plugin-master/jquery.session.js"></script>



</head>
<style>
    .dropdown-menu a{
        background:white;
    }
</style>
    <body>
        <div id="head-index">
            <ul id="head-list-my" class="list-group">
                <li class="list-group-item"><a href="/admin/index">Main</a></li>
                <li class="list-group-item admin-about"><a href="#">About us</a></li>
                <li class="dropdown list-group-item ">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Products <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/admin/SpecialOffers/?page=1">Special offers</a></li>
                        <li><a href="/admin/Discount/?page=1">Discounts</a></li>
                        <li><a href="/admin/Promotion/?page=1">Promotions</a></li>
                        <li><a href="/admin/BeOver/?page=1">Will soon be over</a></li>
                        <li><a href="/admin/Popular/?page=1">Popular</a></li>
                        <li><a href="/admin/News/?page=1">New Products</a></li>
                    </ul>
                </li>
                <li class="list-group-item"><a href="/admin/Delivery">Deliveries</a></li>
                <li class="list-group-item"><a href="/admin/worker">Our Workers</a></li>
                <?php if (session_status() != PHP_SESSION_NONE) {
                    if ($_SESSION['loggedin'] == 1) {?>
                        <li class="list-group-item"><a href="/main/Logout"><?= $_SESSION['admin_login'] ?> (Выйти)</a></li>
                    <?php }
                }else{ ?>
                    <li class="list-group-item"><a href="/main/Login">Login</a></li>
                <?php } ?>
            </ul>
            <br>
            <br>
            <hr >
        </div>
    </body>
</html>
<!-- The Modal -->
<div class="modal" id="modalAbout">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="modal-title">О компании ALLPan</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" class="feedback" >
                    <?php $about_company = new \Application\models\About();
                    $res_about_companies= $about_company->get_about();
                    foreach($res_about_companies as $res_about_company){
                    ?>
                    <div class="form-group">
                        <label for="adminAboutTitle">Title</label>
                        <input type="text" class="form-control" id="adminAboutTitle" aria-describedby="emailHelp"  value="<?php //$res_about_company['title'];?>">
                    </div>
                    <div class="form-group">
                        <label for="adminAboutContent">Content</label>
                        <textarea class="form-control" id="adminAboutContent" rows="100">
                        </textarea>

                    </div>
                    <?php }?>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" name="about_company_admin" id="about_company_admin" class="btn btn-info" data-dismiss="modal" >Сохранить</button>
            </div>
        </div>
    </div>
</div><!--END MODAl -->
<script>
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
           // alert(title);
           //  $('.big_description').summernote('code',description);
           var content = $.trim($('#adminAboutContent').val());
            var textareaValue = $('#adminAboutContent').summernote('code');
            // alert(textareaValue);
            // var textareaValue = $("#summernote").code();
            // alert()
           $.ajax({
               type:"post",
               url:"/admin/UpdateAboutCompany",
               data:"title="+title+"&content="+textareaValue,
               success:function(res){
                   alert(res);
               },
               error:function(){

               }
           })
        });
    });
</script>
