<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Menu</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-1.12.2.min.js" integrity="sha256-lZFHibXzMHo3GGeehn1hudTAP3Sc0uKXBXAzHX1sjtk=" crossorigin="anonymous"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/application/css/css.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" />
    </head>
    <body>
        <?php
        $departments = new \Application\models\Department();
        $res_departments = $departments->get_departments();
        ?>
        <div class="container">
            <div class="row">
                <!-- ADDING SUCCESS-->
                <div class="alert alert-success selecting-department alert-dismissable" style="display: none;" id="flash-msg-adding-new-user">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <h4><i class="icon fa fa-check"></i>Success!</h4><p>User've  successfully added!</p>
                </div>
                <div id="right-block-container-menu">
                    <ul id="right-block-container-menu-ul">

                    </ul>
                </div>
                <nav class="navbar navbar-default sidebar" role="navigation">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <?php foreach($res_departments as $res_department){
                                    if($res_department['parent_id']==0){
                                ?>
                                <li class="active left-block-menu-index" department_id="<?= $res_department['id']?>"><a href="#"><?= $res_department['department'];?><span style="font-size:16px;" class="pull-right hidden-xs showopacity "></span></a></li>

<!--                                <li class="dropdown">-->
<!--                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuarios <span class="caret"></span><span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-user"></span></a>-->
<!--                                    <ul class="dropdown-menu forAnimate" role="menu">-->
<!--                                        <li><a href="{{URL::to('createusuario')}}">Crear</a></li>-->
<!--                                        <li><a href="#">Modificar</a></li>-->
<!--                                        <li><a href="#">Reportar</a></li>-->
<!--                                        <li class="divider"></li>-->
<!--                                        <li><a href="#">Separated link</a></li>-->
<!--                                        <li class="divider"></li>-->
<!--                                        <li><a href="#">Informes</a></li>-->
<!--                                    </ul>-->
<!--                                </li>-->
<!--                                <li ><a href="#">Libros<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-th-list"></span></a></li>-->
<!--                                <li ><a href="#">Tags<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-tags"></span></a></li>-->
                                <?php }
                                } ?>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </body>
</html>
<script>
    $('#right-block-container-menu-ul')
        .find("li").remove();
    $('.left-block-menu-index').hover(function(){
        // $('#right-block-container-menu').add
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
                                .attr('href','/main/view/?id='+ id)
                                .prepend($('<img>',{id:'theImg',src:'/application/photo/department/' + photo})
                                    .addClass('right-block-menu-index-img')

                                )
                                .append($('<div>')
                                        .addClass('right-block-img-text-block')
                                        // .append($('<p>')
                                        //     .addClass('right-block-img-text-block-p')
                                        .text(department)
                                    // )
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
</script>
<style>
    .right-block-img-text-block {
        position: absolute;
        margin-top:-37px;
        margin-left:3px;
        font-family: "Roboto Condensed",sans-serif;
        font-size:13px;
        text-transform: uppercase;
        font-weight:bold;
        padding:8px;
        background:rosybrown;
        color:white;


        /*top: 20px;*/
        /*left: 0;*/
        /*width: 100%;*/
    }
    .right-block-img-text-block-p{
        padding:10px;
        margin:0px;
        font-size: 30px;
    }
    .right-block-menu-index-img{
        width:100%;
        height:100%;
        position:relative;

    }
    .right-block-menu-index-img:hover{
        width:101%;
        height:101%;

    }
    #right-block-container-menu-ul{
        margin-left:-20px;
        margin-top:20px;
    }
    .right-block-menu-index{
        float:left;
        list-style:none;
        margin:3px;
        /*margin-top:20px;*/
        /*width:33.3334%;*/
        width:32%;
        height:150px;

        border:1px solid rosybrown;
    }
    #right-block-container-menu{
        float:right;
        background:#ffcaca;
        width:960px;
        height:360px;
        background: url("/application/photo/main_photo/7.jpg") no-repeat;
        /*height:100%;*/
    }
    .container{
        /*background: url("/application/photo/main_photo/3.jpg") no-repeat;*/

    }
    nav.sidebar, .main{
        -webkit-transition: margin 200ms ease-out;
        -moz-transition: margin 200ms ease-out;
        -o-transition: margin 200ms ease-out;
        transition: margin 200ms ease-out;
    }
    .main{
        padding: 10px 10px 0 10px;
    }
    @media (min-width: 765px) {

        .main{
            position: absolute;
            width: calc(100% - 40px);
            margin-left: 40px;
            float: right;
        }
        nav.sidebar:hover + .main{
            margin-left: 200px;
        }
        nav.sidebar.navbar.sidebar>.container .navbar-brand, .navbar>.container-fluid .navbar-brand {
            margin-left: 0px;
        }
        nav.sidebar .navbar-brand, nav.sidebar .navbar-header{
            text-align: center;
            width: 100%;
            margin-left: 0px;
        }
        nav.sidebar a{
            padding-right: 13px;
        }
        nav.sidebar .navbar-nav > li:first-child{
            border-top: 1px #e5e5e5 solid;
        }
        nav.sidebar .navbar-nav > li{
            border-bottom: 1px #e5e5e5 solid;
        }
        nav.sidebar .navbar-nav .open .dropdown-menu {
            position: static;
            float: none;
            width: auto;
            margin-top: 0;
            background-color: transparent;
            border: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
        }
        nav.sidebar .navbar-collapse, nav.sidebar .container-fluid{
            padding: 0 0px 0 0px;
        }
        .navbar-inverse .navbar-nav .open .dropdown-menu>li>a {
            color: #777;
        }
        nav.sidebar{
            width: 200px;
            height: 100%;
            margin-left: -160px;
            float: left;
            margin-bottom: 0px;
        }
        nav.sidebar li {
            width: 100%;
        }
        nav.sidebar:hover{
            margin-left: 0px;
        }
        .forAnimate{
            opacity: 0;
        }
    }
    @media (min-width: 1330px) {
        .main{
            width: calc(100% - 200px);
            margin-left: 200px;
        }
        nav.sidebar{
            margin-left: 0px;
            float: left;
        }
        nav.sidebar .forAnimate{
            opacity: 1;
        }
    }
    nav.sidebar .navbar-nav .open .dropdown-menu>li>a:hover, nav.sidebar .navbar-nav .open .dropdown-menu>li>a:focus {
        color: #CCC;
        background-color: transparent;
    }
    nav:hover .forAnimate{
        opacity: 1;
    }
    section{
        padding-left: 15px;
    }

</style>
