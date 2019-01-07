<?php 
namespace Application\models; 
use Application\core\App;

class Users
{
    public $conn;

    public function get_users()
    {  
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM users")->fetchAll();
    }
    public function check_if_exists($ip_address)
    {
        $conn = App::$app->get_db();
        $stmt =$conn->prepare("SELECT * FROM users WHERE ip_address = ?");
        $stmt->bindParam(1, $ip_address);
        return $stmt;
    }
    public function check_if_exists_by_email($email)
    {
        $conn = App::$app->get_db();
        $stmt =$conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bindParam(1, $email);
        return $stmt;
    }

    public function check_user($email,$password)
    {
        $email = trim($email);
        $password = trim($password);
        $conn = App::$app->get_db();
        $stmt =$conn->prepare("SELECT * FROM users WHERE email =? AND password =?");
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $password);
        return $stmt;
    }
    public function check_user_data($email)
    {
        $email = trim($email);
        $conn = App::$app->get_db();
        $stmt =$conn->prepare("SELECT * FROM users WHERE email = ? ");
        $stmt->bindParam(1, $email);
        return $stmt;
    }
    public function count_all_users()
    {
        $conn = App::$app->get_db();
        $stmt = $conn->query("SELECT  COUNT(id)as total FROM users ")->fetchAll();
        return $stmt;
    }
//    public function rules_signup($email)
//    {
//        $conn = App::$app->get_db();
//        $stmt =$conn->prepare("SELECT * FROM users WHERE email = ? ");
//        $stmt->bindParam(1, $email);
//        return $stmt;
//    }
//
//    public function get_posts()
//    {
//        $conn = App::$app->get_db();
//        return $conn->query("SELECT * FROM posts")->fetchAll();
//    }
//    public function get_post($post_id)
//    {
//        $conn = App::$app->get_db();
//        $stmt =$conn->prepare("SELECT  posts.post, posts.post_id FROM posts
//            LEFT JOIN workers ON posts.id=workers.post_id
//            WHERE workers.post_id = ?
//           ");
//        $stmt->bindParam(1, $post_id);
//        return $stmt;
//    }
//
    public function get_user_by_ip_address($ip_address)
    {
        $conn = App::$app->get_db();
        $stmt =$conn->prepare("SELECT * FROM users WHERE ip_address = ?");
        $stmt->bindParam(1, $ip_address);
        return $stmt;
    }
    public function get_user_by_email($email)
    {
        $conn = App::$app->get_db();
        $stmt =$conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bindParam(1, $email);
        return $stmt;
    }

    public function insert_guest_user($ip_address)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare( "INSERT INTO users (ip_address)  VALUES(:ip_address)");
        $stmt->bindParam(":ip_address", $ip_address, \PDO::PARAM_INT);
        $stmt->execute();
    }
    public function insert_register_user($name,$password,$lastname,$patronymic,$birthday,$email,$ip_address)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare( "INSERT INTO users (name,password,lastname,patronymic,birthday,email,ip_address)  VALUES(:name,:password,:lastname,:patronymic,:birthday,:email,:ip_address)");
        $birthday = date("Y-m-d H:i:s", strtotime($birthday));
        $stmt->bindParam(":name", $name, \PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, \PDO::PARAM_STR);
        $stmt->bindParam(":lastname", $lastname, \PDO::PARAM_STR);
        $stmt->bindParam(":patronymic", $patronymic, \PDO::PARAM_STR);
        $stmt->bindParam(":birthday", $birthday, \PDO::PARAM_INT);
        $stmt->bindParam(":email", $email, \PDO::PARAM_STR);
        $stmt->bindParam(":ip_address", $ip_address, \PDO::PARAM_INT);
        $stmt->execute();
    }
//
//    public function insert_ids_viewed_products($id_exists_user,$id_of_product)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("UPDATE viewed_products SET id_exists_user = :id_exists_user WHERE id=:id_exists_user");
//        $stmt->bindParam(":id_exists_user", $id_exists_user, \PDO::PARAM_INT);
//        $stmt->bindParam(":id_of_product", $id_of_product, \PDO::PARAM_INT);
//        $update = $stmt->execute();
//        return $update;
//    }

    public function del_of_client($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("DELETE  FROM users WHERE id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();
    }

}  

