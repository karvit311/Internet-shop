<?php 
namespace Application\models;  
use Application\core\App;
use Application\models\Region;
use Application\models\Curier;

class SmallImages
{
    public $conn;

    public function get_small_images()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM small_images ")->fetchAll();
    }

    public function get_small_image_by_id($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM small_images WHERE product_id =? ");
        $stmt->bindValue(1, $id);
        return $stmt;
    }

    public function get_small_image_by_product_id($product_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT s.id,s.name,s.product_id,p.id,p.department_id FROM small_images s LEFT JOIN products p ON p.id=s.product_id WHERE s.product_id =? ");
        $stmt->bindValue(1, $product_id);
        return $stmt;
    }

    public function insert_photo($small_img,$product_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("INSERT INTO small_images (name,product_id)  VALUES(:name,:product_id)");
        $stmt->bindParam(":product_id", $product_id, \PDO::PARAM_INT);
        $stmt->bindParam(":name", $small_img, \PDO::PARAM_STR);
        $stmt->execute();
    }

    public function update_small_photos($arr_ids,$product_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE small_images SET product_id = :product_id WHERE id=:ids");
        $stmt->bindParam(":ids", $arr_ids, \PDO::PARAM_INT);
        $stmt->bindParam(":product_id", $product_id, \PDO::PARAM_INT);
        $update = $stmt->execute();
        return $update;
    }

    public function update_small_photo($filename,$id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE products SET photo = :photo WHERE id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":photo", $filename, \PDO::PARAM_STR);
        $update = $stmt->execute();
        return $update;
    }

    public function delete_small_images($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("DELETE  FROM small_images WHERE product_id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function delete_small_images_preview($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("DELETE  FROM small_images WHERE id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function delete_small_images_added($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("DELETE  FROM small_images WHERE id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>  
