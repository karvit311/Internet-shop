<?php 
namespace Application\models;  
use Application\core\App;
use Application\models\Region;
use Application\models\Curier;

class Cart
{
    public $conn;

    public function get_cart()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM cart ")->fetchAll();
    }

    public function add_to_cart($id,$ip_address,$quantity,$price,$real_price)
    {
        $conn =App::$app->get_db();
        $stmt=$conn->prepare("INSERT INTO cart(product_id,ip_address,quantity,price,real_price,email) VALUES(:id,:ip_address,:quantity,:price,:real_price,0)");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":ip_address", $ip_address, \PDO::PARAM_STR);
        $stmt->bindParam(":quantity", $quantity, \PDO::PARAM_INT);
        $stmt->bindParam(":price", $price, \PDO::PARAM_STR);
        $stmt->bindParam(":real_price", $real_price, \PDO::PARAM_STR);
        $stmt->execute();
    }

    public function add_to_cart_with_email($id,$ip_address,$quantity,$price,$real_price,$email)
    {
        $conn =App::$app->get_db();
        $stmt=$conn->prepare("INSERT INTO cart(product_id,ip_address,quantity,price,real_price,email) VALUES(:id,:ip_address,:quantity,:price,:real_price,:email)");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":ip_address", $ip_address, \PDO::PARAM_STR);
        $stmt->bindParam(":quantity", $quantity, \PDO::PARAM_INT);
        $stmt->bindParam(":price", $price, \PDO::PARAM_STR);
        $stmt->bindParam(":real_price", $real_price, \PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, \PDO::PARAM_STR);
        $stmt->execute();
    }

    public function update_cart($product_id, $res_ip_address, $final_quantity,$price)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE cart SET quantity=:quantity, price=:price WHERE product_id=:product_id AND ip_address=:ip_address");
        $stmt->bindParam(":product_id", $product_id, \PDO::PARAM_INT);
        $stmt->bindParam(":ip_address", $res_ip_address, \PDO::PARAM_INT);
        $stmt->bindParam(":quantity", $final_quantity, \PDO::PARAM_INT);
        $stmt->bindParam(":price", $price, \PDO::PARAM_STR);
        $update = $stmt->execute();
        return $update;
    }

    public function get_cart_by_ip_address($ip_address)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT  COUNT(id) as total FROM cart WHERE ip_address=?");
        $stmt->bindValue(1, $ip_address);
        return $stmt;
    }

    public function get_cart_by_ip_address_Session_email($ip_address,$email)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT  COUNT(id) as total FROM cart WHERE ip_address=? AND email=?");
        $stmt->bindValue(1, $ip_address);
        $stmt->bindValue(2, $email);
        return $stmt;
    }

    public function get_product_from_cart_by_ip_address($ip_address,$email)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT p.id as ProductId,c.product_id,c.id as CartId,c.ip_address,c.real_price,p.name,c.quantity,p.photo,p.price as productPrice,p.department_id,c.price as cartPrice,d.id,d.value_discount,d.product_id,d.end_date,p.discount FROM cart c LEFT JOIN products p ON p.id=c.product_id 
            LEFT JOIN discount d ON p.id=d.product_id  WHERE c.ip_address=? AND email=?");
        $stmt->bindValue(1, $ip_address);
        $stmt->bindValue(2, $email);
        return $stmt;
    }

    public function delete_one_from_cart($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("DELETE  FROM cart WHERE product_id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function delete_all_from_cart($ip_address)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("DELETE  FROM cart WHERE ip_address=:ip_address");
        $stmt->bindParam(":ip_address", $ip_address, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function delete_from_cart($ip_address,$email)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("DELETE  FROM cart WHERE ip_address=:ip_address AND email=:email");
        $stmt->bindParam(":ip_address", $ip_address, \PDO::PARAM_INT);
        $stmt->bindParam(":email", $email, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function check_if_exist($product_id,$ip_address)
    {
        $conn = App::$app->get_db();
        $stmt =$conn->prepare("SELECT COUNT(id) as total FROM cart WHERE product_id = ? AND ip_address = ? AND email = 0");
        $stmt->bindParam(1, $product_id);
        $stmt->bindParam(2, $ip_address);
        return $stmt;
    }

    public function check_if_exist_with_email($product_id,$ip_address,$email)
    {
        $conn = App::$app->get_db();
        $stmt =$conn->prepare("SELECT COUNT(id) as total FROM cart WHERE product_id = ? AND ip_address = ? AND email=? ");
        $stmt->bindParam(1, $product_id);
        $stmt->bindParam(2, $ip_address);
        $stmt->bindParam(3, $email);
        return $stmt;
    }

    public function get_product_from_cart($product_id)
    {
        $conn = App::$app->get_db();
        $stmt =$conn->prepare("SELECT * FROM cart WHERE product_id = ? ");
        $stmt->bindParam(1, $product_id);
        return $stmt;
    }
}

