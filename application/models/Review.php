<?php 
namespace Application\models;  
use Application\core\App;
use Application\models\Region;
use Application\models\Curier;

class Review
{
    public $conn;

    public function get_reviews()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM review ")->fetchAll();
    }

    public function get_reviews_and_products()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT p.photo,p.id,r.product_id,r.name,r.review,r.accepted,p.department_id, p.name as productName,r.id as reviewId FROM review r LEFT JOIN products p ON r.product_id=p.id ")->fetchAll();
    }

    public function accept_review($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE review SET accepted = 1 WHERE id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $update = $stmt->execute();
        return $update;
    }

    public function del_of_review($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("DELETE FROM review WHERE id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function get_sort_accepted()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT p.photo,p.id,r.product_id,r.name,r.review,r.accepted,p.department_id, p.name as productName,r.id as reviewId FROM review r LEFT JOIN products p ON r.product_id=p.id WHERE r.accepted=1 ORDER BY r.id DESC")->fetchAll();
    }

    public function get_sort_no_accepted()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT p.photo,p.id,r.product_id,r.name,r.review,r.accepted,p.department_id, p.name as productName,r.id as reviewId FROM review r LEFT JOIN products p ON r.product_id=p.id WHERE r.accepted=0 ORDER BY r.id DESC")->fetchAll();
    }


    public function count_review_by_ip_address($ip_address)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT  COUNT(id) as total FROM cart WHERE ip_address=?");
        $stmt->bindValue(1, $ip_address);
        return $stmt;
    }

    public function get_review_by_ip_address($ip_address)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM review WHERE ip_address=?");
        $stmt->bindValue(1, $ip_address);
        return $stmt;
    }

    public function insert_new_review($name,$review,$product_id,$ip_address)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("INSERT INTO review (name,review,product_id,ip_address)  VALUES(:name,:review,:product_id,:ip_address)");
        $stmt->bindParam(":name", $name, \PDO::PARAM_STR);
        $stmt->bindParam(":review", $review, \PDO::PARAM_STR);
        $stmt->bindParam(":product_id", $product_id, \PDO::PARAM_INT);
        $stmt->bindParam(":ip_address", $ip_address, \PDO::PARAM_STR);
        $stmt->execute();
    }

    public function count_all_reviews()
    {
        $conn = App::$app->get_db();
        $stmt = $conn->query("SELECT  COUNT(id)as total FROM review ")->fetchAll();
        return $stmt;
    }

    public function count_no_accepted_reviews()
    {
        $conn = App::$app->get_db();
        $stmt = $conn->query("SELECT  COUNT(id)as total FROM review WHERE accepted=0")->fetchAll();
        return $stmt;
    }
}

