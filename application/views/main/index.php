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
    </head>
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
            nav.sidebar  li a {
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

    <body>
        <?php
        $departments = new \Application\models\Department();
        $res_departments = $departments->get_departments();
       // print_r($_SESSION);
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
                                    if($res_department['parent_id']==1){
                                ?>
                                <li class="active left-block-menu-index" department_id="<?= $res_department['id']?>"><a href="#"><?= $res_department['department'];?><span style="font-size:16px;" class="pull-right hidden-xs showopacity "></span></a></li>
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
                                .attr('href','/main/products/?department_id='+ id+'&page=1')
                                .prepend($('<img>',{id:'theImg',src:'/application/photo/department/' + photo})
                                    .addClass('right-block-menu-index-img')

                                )
                                .append($('<div>')
                                        .addClass('right-block-img-text-block')
                                        .text(department)
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
