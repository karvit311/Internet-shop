<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>About company AllPan</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="big_description"></div>
                <div class="main_block_about">
                    <?php $about_company = new \Application\models\About();
                    $res_about_companies= $about_company->get_about();
                    foreach($res_about_companies as $res_about_company){
                    ?>
                   <h2><?= $res_about_company['title']?></h2>
                    <?= $res_about_company['content'];?>
                    <?php }?>
                </div>
            </div>
        </div>
    </body>
</html>
