<?php 
namespace Application\models;  
use Application\core\App;
use Application\models\Region;
use Application\models\Curier;

class Delivery
{
    public $conn;

    public function get_deliveres()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM schedule_of_delivery ")->fetchAll();
    }

    public function get_deliveres_conditionals($date)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM schedule_of_delivery WHERE date=? ");
        $stmt->bindValue(1, $date);
        return $stmt;
    }

    public function get_array_deliveres_conditionals_city_id($city_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM schedule_of_delivery WHERE city_id=?   ");
        $stmt->bindValue(1, $city_id);
        return $stmt;
    }

    public function get_deliveres_conditionals_city_id($city_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT *FROM schedule_of_delivery WHERE city_id=? ");
        $stmt->bindValue(1, $city_id);
        return $stmt;
    }
    public function get_deliveres_conditionals_supplier_id($supplier_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT *FROM schedule_of_delivery WHERE supplier_id=? ");
        $stmt->bindValue(1, $supplier_id);
        return $stmt;
    }
    public function get_deliveres_conditionals_supplier($supplier)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT *FROM schedule_of_delivery WHERE supplier=? ");
        $stmt->bindValue(1, $supplier);
        return $stmt;
    }

    public function get_deliveres_date_city_id($city_id, $date)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM schedule_of_delivery WHERE city_id=? AND date=?");
        $stmt->bindValue(1, $city_id);
        $stmt->bindValue(2, $date);
        return $stmt;
    }
    public function get_deliveres_date_city_id_time($time, $date,$city_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM schedule_of_delivery WHERE time=? AND date=? AND city_id=?");
        $stmt->bindValue(1, $time);
        $stmt->bindValue(2, $date);
        $stmt->bindValue(3, $city_id);
        return $stmt;
    }
    public function insert_delivery($address,$date,$time,$city_id,$supplier_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare( "INSERT INTO schedule_of_delivery (address,date,time,city_id,supplier_id)  VALUES(:address,:date,:time,:city_id,:supplier_id)");
//        $birth_day = date("Y-m-d H:i:s", strtotime($birth_day));
        $stmt->bindParam(":address", $address, \PDO::PARAM_STR);
        $stmt->bindParam(":date", $date, \PDO::PARAM_STR);
        $stmt->bindParam(":time", $time, \PDO::PARAM_STR);
        $stmt->bindParam(":city_id", $city_id, \PDO::PARAM_INT);
        $stmt->bindParam(":supplier_id", $supplier_id, \PDO::PARAM_INT);
//        $stmt->bindParam(":salary", $salary, \PDO::PARAM_INT);
//        $stmt->bindParam(":email", $email, \PDO::PARAM_STR);
//        $stmt->bindParam(":post_id", $post_id, \PDO::PARAM_INT);
        $stmt->execute();
    }
    public function update_delivery($id,$lastname,$name,$patronymic,$birth_day,$salary,$email,$post_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE workers SET lastname = :lastname,name = :name,patronymic=:patronymic,birth_day=:birth_day,salary=:salary,email=:email,post_id=:post_id WHERE id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $birth_day = date("Y-m-d H:i:s", strtotime($birth_day));
        $stmt->bindParam(":lastname", $lastname, \PDO::PARAM_STR);
        $stmt->bindParam(":name", $name, \PDO::PARAM_STR);
        $stmt->bindParam(":patronymic", $patronymic, \PDO::PARAM_STR);
        $stmt->bindParam(":birth_day", $birth_day, \PDO::PARAM_STR);
        $stmt->bindParam(":salary", $salary, \PDO::PARAM_INT);
        $stmt->bindParam(":email", $email, \PDO::PARAM_STR);
        $stmt->bindParam(":post_id", $post_id, \PDO::PARAM_INT);
        $update = $stmt->execute();
        return $update;
    }
}
?>  
