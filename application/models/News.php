<?php 
namespace Application\models;  
use Application\core\App;
use Application\models\Region;
use Application\models\Curier;

class News
{
    public $conn;

    public function get_news()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM news ")->fetchAll();
    }

    public function get_limited_news()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM news LIMIT 3")->fetchAll();
    }

    public function update_photo($filename,$id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE news SET img = :img WHERE id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":img", $filename, \PDO::PARAM_STR);
        $update = $stmt->execute();
        return $update;
    }

    public function update_new($title,$id,$content)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE news SET title = :title,content=:content WHERE id=:id");
        $stmt->bindParam(":title", $title, \PDO::PARAM_STR);
        $stmt->bindParam(":content", $content, \PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $update = $stmt->execute();
        return $update;
    }

    public function get_news_by_id($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM news WHERE id= ?");
        $stmt->bindValue(1, $id);
        return $stmt;
    }

    public function insert_new_without_photo($title,$content)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare( "INSERT INTO news (title,content)  VALUES(:title,:content)");
        $stmt->bindParam(":title", $title, \PDO::PARAM_STR);
        $stmt->bindParam(":content", $content, \PDO::PARAM_STR);
        $stmt->execute();
    }

    public function insert_photo($photo)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare( "INSERT INTO news (img)  VALUES(:img)");
        $stmt->bindParam(":img", $photo, \PDO::PARAM_STR);
        $stmt->execute();
    }

    public function delete_new($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("DELETE  FROM news WHERE id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>  
