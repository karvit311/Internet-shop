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
        <link rel="stylesheet" href="/application/css/main-index.css">
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
<?php
$haystacks = ['55.100','55.01','50.001','55.00','55.1009100','55.034301200'];
$patterns = [
'/^(\d+)(\.)(0+)$/',
'/(\d+\.)(([0]*+[1-9]+)+)?(0+)$/U',
];
$replacements = [
'$1',
'$1$2',
];
foreach ($haystacks as $key => $number) {
echo $number . "->" . preg_replace($patterns, $replacements, $number) . "<br>";
}



$haystacks = ['іфвкотяра','вфікоте','кот','вкотп','котя','котн'];
$patterns = [
        '/(кот)(яра|е|я|п|н)*/u',
//        '/(кот)+(a-z)+/u',
];
$replacements = [
     '$1',
//    '$1',
];
foreach($haystacks as $key => $res){
    echo $res . "->".preg_replace($patterns,$replacements,$res)."<br>";
}
$string = 'April 15, 2003';
$pattern = '/(\w+) (\d+), (\d+)/i';
$replacement = '${1}1,$3';
echo preg_replace($pattern, $replacement, $string);
?>
<script src="/application/js/main.js"></script>
