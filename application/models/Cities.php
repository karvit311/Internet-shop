<?php 
namespace Application\models; 
use Application\core\App;

class Cities
{
    public $conn;

    public function get_cities()
    {  
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM cities_deliveres")->fetchAll();
    }

    public function get_cities_by_id($city_id)
    {
        $conn = App::$app->get_db();
        $stmt =$conn->prepare("SELECT * FROM cities_delieres WHERE id = ?");
        $stmt->bindParam(1, $city_id);
        return $stmt;
    }
}  
?>  
