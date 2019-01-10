<?php 
namespace Application\models;  
use Application\core\App;
use Application\models\Region;
use Application\models\Curier;

class Promotion
{
    public $conn;

    public function get_promotions()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM promotion ")->fetchAll();
    }

    public function get_total_by_promotion()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT COUNT(id)as total FROM promotion ")->fetchAll();
        return $stmt;
    }

    public function get_promotions_actual($today,$limit,$start)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM promotion WHERE end_date > :end_date LIMIT :limit OFFSET :start");
        $stmt->bindParam(":end_date", $today, \PDO::PARAM_INT);
        $stmt->bindParam(":limit", $limit, \PDO::PARAM_INT);
        $stmt->bindParam(":start", $start, \PDO::PARAM_INT);
        return $stmt;
    }

    public function get_promotions_by_iid($iid)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM promotion WHERE id= ?");
        $stmt->bindValue(1, $iid);
        return $stmt;
    }

    public function insert_only_end_date($id,$end_date)
    {
        $conn = App::$app->get_db();
        $end_date = date("Y-m-d  H:i:s", strtotime($end_date));
        $stmt = $conn->prepare( "INSERT INTO promotion (product_id,end_date)  VALUES(:product_id,:end_date)");
        $stmt->bindParam(":product_id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":end_date", $end_date, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function get_promotion_by_id($product_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM promotion WHERE product_id=?");
        $stmt->bindValue(1, $product_id);
        return $stmt;
    }

    public function delete_product_from_promotion($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("DELETE  FROM promotion WHERE product_id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $update = $stmt->execute();
        return $update;
    }

    public function delete_promotion($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("DELETE  FROM promotion WHERE id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $update = $stmt->execute();
        return $update;
    }

    public function insert_all_promotion_value($id, $description, $left_block, $title, $type, $end_date)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare( "INSERT INTO promotion (value_promotion,end_date,left_block,title,type,product_id)  VALUES(:value_promotion,:end_date,:left_block,:product_id,:title,:type)");
        $end_date = date("Y-m-d", strtotime($end_date));
        $stmt->bindParam(":product_id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":value_promotion", $description, \PDO::PARAM_STR);
        $stmt->bindParam(":left_block", $left_block, \PDO::PARAM_STR);
        $stmt->bindParam(":title", $title, \PDO::PARAM_STR);
        $stmt->bindParam(":type", $type, \PDO::PARAM_STR);
        $stmt->bindParam(":end_date", $end_date, \PDO::PARAM_STR);
        $stmt->execute();
    }

    public function update_promotion_value($id,$description,$left_block,$title,$type,$end_date)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE promotion SET value_promotion = :description,left_block=:left_block,title=:title,type=:type,end_date=:end_date WHERE id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":description", $description, \PDO::PARAM_STR);
        $stmt->bindParam(":left_block", $left_block, \PDO::PARAM_STR);
        $stmt->bindParam(":title", $title, \PDO::PARAM_STR);
        $stmt->bindParam(":type", $type, \PDO::PARAM_STR);
        $end_date = date("Y-m-d", strtotime($end_date));
        $stmt->bindParam(":end_date", $end_date, \PDO::PARAM_STR);
        $update = $stmt->execute();
        return $update;
    }

    public function update_promotion_end_date_value($id,$end_date)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE promotion SET end_date =:end_date WHERE product_id=:product_id");
        $stmt->bindParam(":product_id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":end_date", $end_date, \PDO::PARAM_STR);
        $update = $stmt->execute();
        return $update;
    }
}
?>  
