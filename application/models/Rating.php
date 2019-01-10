<?php 
namespace Application\models;  
use Application\core\App;
use Application\models\Region;
use Application\models\Curier;

class Rating
{
    public $conn;

    public function get_ratings()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM rating ")->fetchAll();
    }

    public function get_total_rating($product_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT AVG(rating)as total FROM rating WHERE product_id=?");
        $stmt->bindValue(1, $product_id);
        return $stmt;
    }

    public function get_sum_rating($product_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT SUM(rating)as total FROM rating WHERE product_id=?");
        $stmt->bindValue(1, $product_id);
        return $stmt;
    }

    public function get_total_users_rated($product_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT COUNT(rating_id)as total FROM rating WHERE product_id=?");
        $stmt->bindValue(1, $product_id);
        return $stmt;
    }

    public function get_rating_by_product_id($product_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT p.id,r.product_id,p.name,r.rating_id,p.department_id,p.discount,r.rating,p.big_description,p.brand FROM rating r LEFT JOIN products p ON p.id=r.product_id  WHERE r.product_id=?");
        $stmt->bindValue(1, $product_id);
        return $stmt;
    }

    public function insert_new_rating($product_id,$rate,$ip_address)
    {
        $conn =App::$app->get_db();
        $stmt=$conn->prepare("INSERT INTO rating(product_id,rating,ip_address) VALUES(:product_id,:rating,:ip_address)");
        $stmt->bindParam(":product_id", $product_id, \PDO::PARAM_INT);
        $stmt->bindParam(":rating", $rate, \PDO::PARAM_INT);
        $stmt->bindParam(":ip_address", $ip_address, \PDO::PARAM_STR);
        $stmt->execute();
    }
}

