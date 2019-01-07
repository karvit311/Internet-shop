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
//    public function get_order_by_ip_address($ip_address)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("SELECT * FROM orders o LEFT JOIN products p ON p.id=o.product_id WHERE o.ip_address=?");
//        $stmt->bindValue(1, $ip_address);
//        return $stmt;
//    }


//    public function remove_discount($id)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("UPDATE products SET discount = 0 WHERE id=:id");
//        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
//        $update = $stmt->execute();
//        return $update;
//    }
//    public function get_products_by_news()
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->query("SELECT * FROM products WHERE new=1")->fetchAll();
//        return $stmt;
//    }
//    public function get_products_by_popular()
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->query("SELECT * FROM products WHERE popular=1")->fetchAll();
//        return $stmt;
//    }
//    public function get_products_soon_be_over()
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->query("SELECT * FROM products WHERE quantity<10")->fetchAll();
////        $stmt->bindValue(1, $department_id);
//        return $stmt;
//    }
//
//    public function get_products_by_brand_and_department_id($brand,$department_id)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("SELECT * FROM products  WHERE brand =? AND department_id=?");
//        $stmt->bindValue(1, $brand);
//        $stmt->bindValue(2, $department_id);
//        return $stmt;
//    }
//
////    public function get_discount_by_special_offer_and_discount()
////    {
////        $conn = App::$app->get_db();
////        return $conn->prepare("SELECT s.product_id,p.id,p.department_id,p.special_offer FROM products p LEFT JOIN special_offer s ON s.product_id=p.id WHERE p.special_offer=1")->fetchAll();
////
////    }
//    public function get_discount_by_special_offer_and_discount()
//    {
//        $conn = App::$app->get_db();
//       return $conn->query("SELECT d.value_discount,d.product_id,p.id,p.department_id,p.discount,s.product_id,p.special_offers FROM products p LEFT JOIN discount d ON d.product_id=p.id LEFT JOIN special_offer s ON s.product_id=p.id  WHERE p.discount=1 AND p.special_offers=1")->fetchAll();
//
//    }
//
//    public function get_discount_by_department_id_and_discount($department_id)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("SELECT d.value_discount,d.product_id,p.id,p.department_id,p.discount FROM products p LEFT JOIN discount d ON d.product_id=p.id WHERE p.discount=1 AND p.department_id=?");
//        $stmt->bindValue(1, $department_id);
//        return $stmt;
//    }
//
//    public function get_brands_by_department_id($department_id)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("SELECT * FROM products  WHERE department_id=? GROUP BY brand,department_id");
//        $stmt->bindValue(1, $department_id);
//        return $stmt;
//    }
//    public function get_colors_by_department_id($department_id)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("SELECT * FROM products  WHERE department_id=? GROUP BY color,department_id");
//        $stmt->bindValue(1, $department_id);
//        return $stmt;
//    }
//    public function get_allprices_by_department_id($department_id)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("SELECT * FROM products  WHERE department_id=? GROUP BY price,department_id");
//        $stmt->bindValue(1, $department_id);
//        return $stmt;
//    }
//    public function get_prices_by_department_id($department_id)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("SELECT MIN(price) as min, MAX(price) as max FROM products  WHERE department_id=? ");
//        $stmt->bindValue(1, $department_id);
//        return $stmt;
//    }
//
////    public function get_promotion_products()
////    {
////        $conn = App::$app->get_db();
////        return $conn->query("SELECT pd.id,pm.product_id,pd.discount,pd.price,pm.end_date,pm.value_promotion,pd.name,pd.photo FROM products pd LEFT JOIN promotion pm ON pm.product_id=pd.id WHERE pd.discount=1")->fetchAll();
////        return $stmt;
////    }
//    public function get_prices_by_discount()
//    {
//        $conn = App::$app->get_db();
//        return $conn->query("SELECT p.id,d.product_id,p.discount,p.price,d.end_date,d.value_discount,p.name,p.photo,p.brand,p.color FROM products p LEFT JOIN discount d ON d.product_id=p.id WHERE p.discount=1")->fetchAll();
//        return $stmt;
//    }
//    public function get_prices_by_special_offers()
//    {
//        $conn = App::$app->get_db();
//        return $conn->query("SELECT * FROM products WHERE special_offers=1")->fetchAll();
//        return $stmt;
//    }
//
//    public function get_product_by_id($id)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("SELECT * FROM products  WHERE id =? ");
//        $stmt->bindValue(1, $id);
//        return $stmt;
//    }
//
//    public function update_photo($filename,$id)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("UPDATE products SET photo = :photo WHERE id=:id");
//        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
//        $stmt->bindParam(":photo", $filename, \PDO::PARAM_STR);
//        $update = $stmt->execute();
//        return $update;
//    }

//    public function update_product($iid,$name,$price,$colour,$brand,$quantity,$description,$adding_info,$discount,$new_product,$promotion,$special_offer,$department_id)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("UPDATE products SET name=:name, price=:price,color=:colour,brand=:brand,quantity=:quantity,big_description=:big_description,adding_info=:adding_info, discount=:discount, new=:new,promotion=:promotion,special_offers=:special_offer,department_id=:department_id WHERE id=:id");
//        $stmt->bindParam(":id", $iid, \PDO::PARAM_INT);
//        $stmt->bindParam(":name", $name, \PDO::PARAM_STR);
//        $stmt->bindParam(":price", $price, \PDO::PARAM_INT);
//         $stmt->bindParam(":colour", $colour, \PDO::PARAM_STR);
//        $stmt->bindParam(":brand", $brand, \PDO::PARAM_STR);
//        $stmt->bindParam(":quantity", $quantity, \PDO::PARAM_INT);
//        $stmt->bindParam(":big_description", $description, \PDO::PARAM_STR);
//        $stmt->bindParam(":adding_info", $adding_info, \PDO::PARAM_STR);
//        $stmt->bindParam(":discount", $discount, \PDO::PARAM_INT);
//        $stmt->bindParam(":new", $new_product, \PDO::PARAM_INT);
//        $stmt->bindParam(":promotion", $promotion, \PDO::PARAM_INT);
//        $stmt->bindParam(":special_offer", $special_offer, \PDO::PARAM_INT);
//        $stmt->bindParam(":department_id", $department_id, \PDO::PARAM_INT);
//        $update = $stmt->execute();
//        return $update;
//    }
//    public function delete_product($id)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("DELETE  FROM products WHERE id=:id");
//        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
//        $stmt->execute();
//    }
//    public function insert_main_photo($photo)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare( "INSERT INTO products (photo)  VALUES(:photo)");
//        $stmt->bindParam(":photo", $photo, \PDO::PARAM_STR);
//        $stmt->execute();
//    }
//    public function get_deliveres_date_city_id($city_id, $date)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("SELECT * FROM schedule_of_delivery WHERE city_id=? AND date=?");
//        $stmt->bindValue(1, $city_id);
//        $stmt->bindValue(2, $date);
//        return $stmt;
//    }
//    public function get_deliveres_date_city_id_time($time, $date)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("SELECT * FROM schedule_of_delivery WHERE time=? AND date=?");
//        $stmt->bindValue(1, $time);
//        $stmt->bindValue(2, $date);
//        return $stmt;
//    }
//    public function get_supplier_conditionals_supplier_id($supplier_id)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("SELECT * FROM supplier WHERE id=? ");
//        $stmt->bindValue(1, $supplier_id);
//        return $stmt;
//    }
}

