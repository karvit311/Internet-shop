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
//    public function get_departments_parent($parent)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("SELECT * FROM department WHERE parent_id =? ");
//        $stmt->bindValue(1, $parent);
//        return $stmt;
//    }
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
        $stmt = $conn->prepare("SELECT * FROM small_images WHERE product_id =? ");
        $stmt->bindValue(1, $product_id);
        return $stmt;
    }
//
//    public function get_deliveres_conditionals($date)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("SELECT * FROM schedule_of_delivery WHERE date=? ");
//        $stmt->bindValue(1, $date);
//        return $stmt;
//    }
//
//    public function get_department_conditionals_id($department_id)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("SELECT * FROM department WHERE id=? ");
//        $stmt->bindValue(1, $department_id);
//        return $stmt;
//    }
//    public function get_if_exist_added_department($department)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("SELECT * FROM department WHERE department=? ");
//        $stmt->bindValue(1, $department);
//        return $stmt;
//    }
//    public function insert_department($department,$parent_id)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare( "INSERT INTO department (department,parent_id)  VALUES(:department,:parent_id)");
//        $stmt->bindParam(":department", $department, \PDO::PARAM_STR);
//        $stmt->bindParam(":parent_id", $parent_id, \PDO::PARAM_INT);
//        $stmt->execute();
//    }
//    public function get_deliveres_date_city_id($city_id, $date)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("SELECT * FROM schedule_of_delivery WHERE city_id=? AND date=?");
//        $stmt->bindValue(1, $city_id);
//        $stmt->bindValue(2, $date);
//        return $stmt;
//    }
//    public function get_deliveres_date_city_id_time($time, $date)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("SELECT * FROM schedule_of_delivery WHERE time=? AND date=?");
//        $stmt->bindValue(1, $time);
//        $stmt->bindValue(2, $date);
//        return $stmt;
//    }
//    public function get_supplier_conditionals_supplier_id($supplier_id)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("SELECT * FROM supplier WHERE id=? ");
//        $stmt->bindValue(1, $supplier_id);
//        return $stmt;
//    }
}
?>  
