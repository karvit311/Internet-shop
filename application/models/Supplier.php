<?php 
namespace Application\models;  
use Application\core\App;
use Application\models\Region;
use Application\models\Curier;

class Supplier
{
    public $conn;

    public function get_suppliers()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM supplier ")->fetchAll();
    }

    public function get_exist_new_supplier($supplier)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM supplier WHERE supplier=? ");
        $stmt->bindValue(1, $supplier);
        return $stmt;
    }

    public function insert_supplier($new_supplier,$new_info_supplier,$department)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare( "INSERT INTO supplier (supplier,info,department)  VALUES(:supplier,:info,:department)");
        $stmt->bindParam(":supplier", $new_supplier, \PDO::PARAM_STR);
        $stmt->bindParam(":info", $new_info_supplier, \PDO::PARAM_STR);
        $stmt->bindParam(":department", $department, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function get_supplier_conditionals_supplier_id($supplier_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM supplier WHERE id=? ");
        $stmt->bindValue(1, $supplier_id);
        return $stmt;
    }
}
?>  
