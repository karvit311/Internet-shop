<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Soon Be Over</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
    .main_block_workers_news{
        display: inline-block;
    }
    .main_block_workers_news {
        color:#676b6f;
        text-decoration:none;
    }
    .main_block_workers_news a:hover{
        color:#1f4577;
        text-decoration:none;
    }
    .title_block_new{
        font-size:16px;
        font-weight:bold;
        margin-bottom:30px;
    }
    .main_block_workers_news img{
        margin-top:10px;
        margin-left:200px;
        margin-bottom:30px;
    }
</style>
    <body>
        <?php
        $id = $_GET['id']; ?>
        <div class="container">
            <div class="row">
                <div class="main_block_workers_news">
                    <?php $get_news = new \Application\models\News();
                    $res_get_news = $get_news->get_news_by_id($id);
                    $res_get_news->execute(array($id));
                    foreach($res_get_news as $res_get_new){?>
                        <div class="main_block_worker_new">
                            <span><h1 class="title_block_new text-uppercase text-center "><?= $res_get_new['title'];?></h1></span>
                            <img width="700px" height="700px" src="/application/photo/news/<?= $res_get_new['img'];?>" />
                            <div class="content_block_new text-center">
                                <p><?= $res_get_new['content'];?></p>
                            </div>
                        </div>
                        <hr>
                    <?php  }?>
                </div>
            </div>
        </div>
    </body>
</html>
