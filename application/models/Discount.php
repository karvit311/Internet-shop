<?php 
namespace Application\models;  
use Application\core\App;
use Application\models\Region;
use Application\models\Curier;

class Discount
{
    public $conn;

    public function get_discounts()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM discount ")->fetchAll();
    }

        public function get_discounts_by_product_id($product_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM discount WHERE product_id=?");
        $stmt->bindValue(1, $product_id);
        return $stmt;
    }

    public function delete_product_from_discount($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("DELETE  FROM discount WHERE product_id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $update = $stmt->execute();
        return $update;
    }

    public function insert_only_discount_value($id,$value_discount)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare( "INSERT INTO discount (product_id,value_discount)  VALUES(:product_id,:value_discount)");
        $stmt->bindParam(":product_id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":value_discount", $value_discount, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function insert_only_end_date($id,$end_date)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare( "INSERT INTO discount (product_id,end_date)  VALUES(:product_id,:end_date)");
        $stmt->bindParam(":product_id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":end_date", $end_date, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function insert_discount_value($id,$value_discount,$end_date)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare( "INSERT INTO discount (product_id,value_discount,end_date)  VALUES(:product_id,:value_discount,:end_date)");
        $stmt->bindParam(":product_id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":value_discount", $value_discount, \PDO::PARAM_INT);
        $stmt->bindParam(":end_date", $end_date, \PDO::PARAM_STR);
        $stmt->execute();
    }

    public function update_discount_value($id,$value_discount)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE discount SET value_discount = :value_discount WHERE product_id=:product_id");
        $stmt->bindParam(":product_id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":value_discount", $value_discount, \PDO::PARAM_INT);
        $update = $stmt->execute();
        return $update;
    }

    public function update_discount_end_date_value($id,$end_date)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE discount SET end_date =:end_date WHERE product_id=:product_id");
        $stmt->bindParam(":product_id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":end_date", $end_date, \PDO::PARAM_STR);
        $update = $stmt->execute();
        return $update;
    }
}
?>  
