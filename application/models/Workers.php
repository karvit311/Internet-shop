<?php 
namespace Application\models; 
use Application\core\App;

class Workers
{
    public $conn;

    public function get_workers()
    {  
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM workers")->fetchAll();
    }
    public function get_posts()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM posts")->fetchAll();
    }
    public function get_post($post_id)
    {
        $conn = App::$app->get_db();
        $stmt =$conn->prepare("SELECT  posts.post, posts.post_id FROM posts 
            LEFT JOIN workers ON posts.id=workers.post_id
            WHERE workers.post_id = ?
           ");
        $stmt->bindParam(1, $post_id);
        return $stmt;
    }

    public function get_workers_by_id($workers_id)
    {
        $conn = App::$app->get_db();
        $stmt =$conn->prepare("SELECT * FROM workers WHERE id = ?");
        $stmt->bindParam(1, $workers_id);
        return $stmt;
    }        
    public function insert_worker($lastname,$name,$patronymic,$birth_day,$salary,$email,$post_id,$start_day)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare( "INSERT INTO workers (lastname,name,patronymic,birth_day,salary,email,post_id,start_day)  VALUES(:lastname,:name,:patronymic,:birth_day,:salary,:email,:post_id,:start_day)");
//        $birth_day = date("Y-m-d H:i:s", strtotime($birth_day));
        $stmt->bindParam(":lastname", $lastname, \PDO::PARAM_STR);
        $stmt->bindParam(":name", $name, \PDO::PARAM_STR);
        $stmt->bindParam(":patronymic", $patronymic, \PDO::PARAM_STR);
        $stmt->bindParam(":birth_day", $birth_day, \PDO::PARAM_STR);
        $stmt->bindParam(":salary", $salary, \PDO::PARAM_INT);
        $stmt->bindParam(":email", $email, \PDO::PARAM_STR);
        $stmt->bindParam(":post_id", $post_id, \PDO::PARAM_INT);
        $stmt->bindParam(":start_day", $start_day, \PDO::PARAM_STR);
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
