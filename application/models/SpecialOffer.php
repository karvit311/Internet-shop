<?php 
namespace Application\models;  
use Application\core\App;
use Application\models\Region;
use Application\models\Curier;

class SpecialOffer
{
    public $conn;

    public function get_special_offers()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM special_offer ")->fetchAll();
    }

    public function get_special_offer_by_id($product_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM special_offer WHERE product_id=?");
        $stmt->bindValue(1, $product_id);
        return $stmt;
    }

    public function delete_product_from_special_offer($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("DELETE  FROM special_offer WHERE product_id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $update = $stmt->execute();
        return $update;
    }

    public function insert_special_offer_value($id,$end_date)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare( "INSERT INTO special_offer (product_id,end_date)  VALUES(:product_id,:end_date)");
        $stmt->bindParam(":product_id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":end_date", $end_date, \PDO::PARAM_STR);
        $stmt->execute();
    }

    public function insert_only_end_date($id,$end_date)
    {
        $conn = App::$app->get_db();
        $end_date = date("Y-m-d  H:s:i", strtotime($end_date));
        $stmt = $conn->prepare( "INSERT INTO special_offer (product_id,end_date)  VALUES(:product_id,:end_date)");
        $stmt->bindParam(":product_id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":end_date", $end_date, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function update_special_offer($id,$end_date)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE special_offer SET end_date = :end_date WHERE product_id=:product_id");
        $end_date = date("Y-m-d  H:s:i", strtotime($end_date));
        $stmt->bindParam(":product_id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":end_date", $end_date, \PDO::PARAM_STR);
        $update = $stmt->execute();
        return $update;
    }

    public function update_special_offer_end_date_value($id,$end_date)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE special_offer SET end_date =:end_date WHERE product_id=:product_id");
        $stmt->bindParam(":product_id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":end_date", $end_date, \PDO::PARAM_STR);
        $update = $stmt->execute();
        return $update;
    }
}
?>  
