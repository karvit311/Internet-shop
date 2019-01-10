<?php 
namespace Application\models; 
use Application\core\App;

class Salary
{
    public $conn;

    public function get_salaries()
    {  
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM salary")->fetchAll();
    }

    public function insert_worker($lastname,$name,$patronymic,$birth_day,$salary,$email,$post_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare( "INSERT INTO workers (lastname,name,patronymic,birth_day,salary,email,post_id)  VALUES(:lastname,:name,:patronymic,:birth_day,:salary,:email,:post_id)");
        $stmt->bindParam(":lastname", $lastname, \PDO::PARAM_STR);
        $stmt->bindParam(":name", $name, \PDO::PARAM_STR);
        $stmt->bindParam(":patronymic", $patronymic, \PDO::PARAM_STR);
        $stmt->bindParam(":birth_day", $birth_day, \PDO::PARAM_STR);
        $stmt->bindParam(":salary", $salary, \PDO::PARAM_INT);
        $stmt->bindParam(":email", $email, \PDO::PARAM_STR);
        $stmt->bindParam(":post_id", $post_id, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function update_worker($id,$lastname,$name,$patronymic,$birth_day,$salary,$email,$post_id)
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

    public function delete_worker($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("DELETE  FROM workers WHERE id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();
    }
}  
?>  
