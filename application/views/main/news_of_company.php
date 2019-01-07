<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>News of Company</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <?php
        $id = $_GET['id']; ?>
        <div class="container">
            <div class="row">
                <div class="block_right_workers_news">
                    <?php $get_news = new \Application\models\News();
                    $res_get_news = $get_news->get_limited_news();
                    foreach($res_get_news as $res_get_new){
                        $wordCount = 30;
                        $outputText = implode(' ', (array_slice(explode(' ', $res_get_new['content']), 0, $wordCount))).' ...';?>
                        <a href="/main/NewsOfCompany/?id=<?= $res_get_new['id'];?>">
                            <div class="block_right_worker_new">
                                <span><p class="title_right_block_new"><?= $res_get_new['title'];?></p></span>
                                <img width="310px" height="270px" src="/application/photo/news/<?= $res_get_new['img'];?>" />
                                <div class="content_right_block_new">
                                    <p><?= $outputText;?></p>
                                </div>
                            </div>
                            <hr>
                        </a>
                    <?php }?>
                </div>
                <div class="main_block_workers_news">
                    <?php $get_news = new \Application\models\News();
                    $res_get_news = $get_news->get_news_by_id($id);
                    $res_get_news->execute(array($id));
                    foreach($res_get_news as $res_get_new){?>
                        <div class="main_block_worker_new">
                            <span><h1 class="title_block_new text-uppercase text-center "><?= $res_get_new['title'];?></h1></span>
                            <img width="700px" height="600px" src="/application/photo/news/<?= $res_get_new['img'];?>" />
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
