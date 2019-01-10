<?php 
namespace Application\models;  
use Application\core\App;
use Application\models\Region;
use Application\models\Curier;

class Orders
{
    public $conn;

    public function get_orders()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM orders")->fetchAll();
    }

    public function get_orders_sort_desc()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM orders ORDER BY id DESC")->fetchAll();
    }

    public function get_confirmed_orders()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM orders WHERE order_confirmed='yes' ORDER BY order_confirmed DESC")->fetchAll();
    }

    public function count_confirmed_orders()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT COUNT(id)as total FROM orders WHERE order_confirmed='yes' ORDER BY order_confirmed DESC")->fetchAll();
    }

    public function get_no_confirmed_orders()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM orders WHERE order_confirmed='no' ORDER BY order_confirmed DESC")->fetchAll();
    }

    public function count_no_confirmed_orders()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT COUNT(id)as total FROM orders WHERE order_confirmed='no' ORDER BY order_confirmed DESC")->fetchAll();
    }

    public function newOrder($order_fio,$order_delivery,$order_email,$order_phone,$order_address,$price,$product_ids_arr,$ip_address,$arr_quantity,$datetime)
    {
        $conn =App::$app->get_db();
        $stmt=$conn->prepare("INSERT INTO orders(order_fio,order_delivery,order_email,order_phone,order_address,price,product_id,ip_address,quantity,datetime) VALUES(:order_fio,:order_delivery,:order_email,:order_phone,:order_address,:price,:product_id,:ip_address,:quantity,:datetime)");
        $stmt->bindParam(":order_fio", $order_fio, \PDO::PARAM_STR);
        $stmt->bindParam(":order_delivery", $order_delivery, \PDO::PARAM_STR);
        $stmt->bindParam(":order_email", $order_email, \PDO::PARAM_STR);
        $stmt->bindParam(":order_phone", $order_phone, \PDO::PARAM_INT);
        $stmt->bindParam(":order_address", $order_address, \PDO::PARAM_STR);
        $stmt->bindParam(":price", $price, \PDO::PARAM_STR);
        $stmt->bindParam(":product_id", $product_ids_arr, \PDO::PARAM_INT);
        $stmt->bindParam(":ip_address", $ip_address, \PDO::PARAM_STR);
        $stmt->bindParam(":quantity", $arr_quantity, \PDO::PARAM_INT);
        $stmt->bindParam(":datetime", $datetime, \PDO::PARAM_STR);
        $stmt->execute();
    }

    public function del_of_order($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("DELETE FROM orders WHERE id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function accept_order($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE orders SET order_confirmed ='yes' WHERE id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $update = $stmt->execute();
        return $update;
    }

    public function get_order_by_order_id($order_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT id,order_fio,order_delivery,order_email,order_phone,order_address,price,product_id,ip_address,payed,accepted,datetime,order_confirmed, COUNT(id) as total FROM orders WHERE id=?");
        $stmt->bindValue(1, $order_id);
        return $stmt;
    }

    public function get_order_and_product_by_order_id($order_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT p.id,p.name,o.order_fio,o.order_delivery,o.order_email,o.order_phone,o.order_address,o.price as priceOrder,o.quantity,o.product_id,o.ip_address,o.payed,o.accepted,o.datetime,o.order_confirmed, COUNT(o.id) as total FROM orders o
            LEFT JOIN products p ON o.product_id=p.id  WHERE o.id=?");
        $stmt->bindValue(1, $order_id);
        return $stmt;
    }

        public function count_all_orders()
    {
        $conn = App::$app->get_db();
        $stmt = $conn->query("SELECT  COUNT(id)as total FROM orders ORDER BY id DESC")->fetchAll();
        return $stmt;
    }

    public function count_no_accepted_orders()
    {
        $conn = App::$app->get_db();
        $stmt = $conn->query("SELECT  COUNT(id)as total FROM orders WHERE accepted =0")->fetchAll();
        return $stmt;
    }

    public function get_all_orders()
    {
        $conn = App::$app->get_db();
        $stmt = $conn->query("SELECT o.price,o.id,o.product_id,p.id,p.name,o.payed,o.datetime FROM orders o LEFT JOIN products p ON o.product_id=p.id ")->fetchAll();
        return $stmt;
    }
}

