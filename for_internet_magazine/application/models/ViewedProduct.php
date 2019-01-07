<?php 
namespace Application\models; 
use Application\core\App;

class ViewedProduct
{
    public $conn;

    public function get_viewed_products()
    {  
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM viewed_products")->fetchAll();
    }
    public function insert_ids_viewed_products($id_exists_user,$id_of_product)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare( "INSERT INTO viewed_products (user_id,ids_viewed_products)  VALUES(:user_id,:ids_viewed_products)");
        $stmt->bindParam(":user_id", $id_exists_user, \PDO::PARAM_INT);
        $stmt->bindParam(":ids_viewed_products", $id_of_product, \PDO::PARAM_INT);
        $stmt->execute();
    }
    public function check_if_exists_viewed_id($id_user, $id_viewed_product)
    {
        $conn = App::$app->get_db();
        $stmt =$conn->prepare("SELECT * FROM viewed_products WHERE user_id = ? AND ids_viewed_products = ?");
        $stmt->bindValue(1, $id_user);
        $stmt->bindValue(2, $id_viewed_product);
        return $stmt;
    }
    public function get_viewed_products_by_user($ip_address)
    {
        $conn = App::$app->get_db();
        $stmt =$conn->prepare("SELECT p.name,p.price,p.photo,p.id FROM products p LEFT JOIN viewed_products vp ON vp.ids_viewed_products=p.id LEFT JOIN users u ON vp.user_id=u.id WHERE u.ip_address= ? ");
        $stmt->bindValue(1, $ip_address);
        return $stmt;
    }
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
//    public function get_cities_by_id($city_id)
//    {
//        $conn = App::$app->get_db();
//        $stmt =$conn->prepare("SELECT * FROM cities_delieres WHERE id = ?");
//        $stmt->bindParam(1, $city_id);
//        return $stmt;
//    }
//    public function insert_worker($lastname,$name,$patronymic,$birth_day,$salary,$email,$post_id)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare( "INSERT INTO workers (lastname,name,patronymic,birth_day,salary,email,post_id)  VALUES(:lastname,:name,:patronymic,:birth_day,:salary,:email,:post_id)");
////        $birth_day = date("Y-m-d H:i:s", strtotime($birth_day));
//        $stmt->bindParam(":lastname", $lastname, \PDO::PARAM_STR);
//        $stmt->bindParam(":name", $name, \PDO::PARAM_STR);
//        $stmt->bindParam(":patronymic", $patronymic, \PDO::PARAM_STR);
//        $stmt->bindParam(":birth_day", $birth_day, \PDO::PARAM_STR);
//        $stmt->bindParam(":salary", $salary, \PDO::PARAM_INT);
//        $stmt->bindParam(":email", $email, \PDO::PARAM_STR);
//        $stmt->bindParam(":post_id", $post_id, \PDO::PARAM_INT);
//        $stmt->execute();
//    }
//
//    public function update_worker($id,$lastname,$name,$patronymic,$birth_day,$salary,$email,$post_id)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("UPDATE workers SET lastname = :lastname,name = :name,patronymic=:patronymic,birth_day=:birth_day,salary=:salary,email=:email,post_id=:post_id WHERE id=:id");
//        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
//        $birth_day = date("Y-m-d H:i:s", strtotime($birth_day));
//        $stmt->bindParam(":lastname", $lastname, \PDO::PARAM_STR);
//        $stmt->bindParam(":name", $name, \PDO::PARAM_STR);
//        $stmt->bindParam(":patronymic", $patronymic, \PDO::PARAM_STR);
//        $stmt->bindParam(":birth_day", $birth_day, \PDO::PARAM_STR);
//        $stmt->bindParam(":salary", $salary, \PDO::PARAM_INT);
//        $stmt->bindParam(":email", $email, \PDO::PARAM_STR);
//        $stmt->bindParam(":post_id", $post_id, \PDO::PARAM_INT);
//        $update = $stmt->execute();
//        return $update;
//    }
//    public function delete_worker($id)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("DELETE  FROM workers WHERE id=:id");
//        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
//        $stmt->execute();
//    }

}  
?>  
