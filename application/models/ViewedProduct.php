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

    public function insert_ids_viewed_products($id_exists_user,$id_of_product,$ip_address)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare( "INSERT INTO viewed_products (user_id,ids_viewed_products,ip_address)  VALUES(:user_id,:ids_viewed_products,:ip_address)");
        $stmt->bindParam(":user_id", $id_exists_user, \PDO::PARAM_INT);
        $stmt->bindParam(":ids_viewed_products", $id_of_product, \PDO::PARAM_INT);
        $stmt->bindParam(":ip_address", $ip_address, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function check_if_exists_viewed_id($ip_address, $id_viewed_product)
    {
        $conn = App::$app->get_db();
        $stmt =$conn->prepare("SELECT * FROM viewed_products WHERE ip_address = ? AND ids_viewed_products = ?");
        $stmt->bindValue(1, $ip_address);
        $stmt->bindValue(2, $id_viewed_product);
        return $stmt;
    }

    public function get_viewed_products_by_user($ip_address)
    {
        $conn = App::$app->get_db();
        $stmt =$conn->prepare("SELECT p.name,p.price,p.photo,p.id,p.department_id FROM products p LEFT JOIN viewed_products vp ON vp.ids_viewed_products=p.id LEFT JOIN users u ON vp.user_id=u.id WHERE u.ip_address= ? ");
        $stmt->bindValue(1, $ip_address);
        return $stmt;
    }
}  
?>  
