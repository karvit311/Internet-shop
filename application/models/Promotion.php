<?php 
namespace Application\models;  
use Application\core\App;
use Application\models\Region;
use Application\models\Curier;

class Promotion
{
    public $conn;

    public function get_promotions()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM promotion ")->fetchAll();
    }
    public function get_total_by_promotion()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT COUNT(id)as total FROM promotion ")->fetchAll();
        return $stmt;
    }
    public function get_promotions_actual($today,$limit,$start)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM promotion WHERE end_date > :end_date LIMIT :limit OFFSET :start");
//        $stmt->bindValue(1, $today);
//        $stmt->bindValue(2, $limit);
//        $stmt->bindValue(3, $start);
        $stmt->bindParam(":end_date", $today, \PDO::PARAM_INT);
        $stmt->bindParam(":limit", $limit, \PDO::PARAM_INT);
        $stmt->bindParam(":start", $start, \PDO::PARAM_INT);
        return $stmt;
    }
    public function get_promotions_by_iid($iid)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM promotion WHERE id= ?");
        $stmt->bindValue(1, $iid);
        return $stmt;
    }
    public function insert_only_end_date($id,$end_date)
    {
        $conn = App::$app->get_db();
        $end_date = date("Y-m-d  H:i:s", strtotime($end_date));
        $stmt = $conn->prepare( "INSERT INTO promotion (product_id,end_date)  VALUES(:product_id,:end_date)");
        $stmt->bindParam(":product_id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":end_date", $end_date, \PDO::PARAM_INT);
        $stmt->execute();
    }
    public function get_promotion_by_id($product_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM promotion WHERE product_id=?");
        $stmt->bindValue(1, $product_id);
        return $stmt;
    }
    public function delete_product_from_promotion($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("DELETE  FROM promotion WHERE product_id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $update = $stmt->execute();
        return $update;
    }
    public function delete_promotion($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("DELETE  FROM promotion WHERE id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $update = $stmt->execute();
        return $update;
    }

    public function insert_all_promotion_value($id, $description, $left_block, $title, $type, $end_date)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare( "INSERT INTO promotion (value_promotion,end_date,left_block,title,type,product_id)  VALUES(:value_promotion,:end_date,:left_block,:product_id,:title,:type)");
        $end_date = date("Y-m-d", strtotime($end_date));
        $stmt->bindParam(":product_id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":value_promotion", $description, \PDO::PARAM_STR);
        $stmt->bindParam(":left_block", $left_block, \PDO::PARAM_STR);
        $stmt->bindParam(":title", $title, \PDO::PARAM_STR);
        $stmt->bindParam(":type", $type, \PDO::PARAM_STR);
        $stmt->bindParam(":end_date", $end_date, \PDO::PARAM_STR);
        $stmt->execute();
    }
//    public function insert_promotion_value($id,$value_promotion,$end_date)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare( "INSERT INTO promotion (product_id,value_promotion,end_date)  VALUES(:product_id,:value_promotion,:end_date)");
////        $end_date = date("Y-m-d", strtotime($end_date));
//        $stmt->bindParam(":product_id", $id, \PDO::PARAM_INT);
//        $stmt->bindParam(":value_promotion", $value_promotion, \PDO::PARAM_STR);
//        $stmt->bindParam(":end_date", $end_date, \PDO::PARAM_STR);
//        $stmt->execute();
//    }
    public function update_promotion_value($id,$description,$left_block,$title,$type,$end_date)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE promotion SET value_promotion = :description,left_block=:left_block,title=:title,type=:type,end_date=:end_date WHERE id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":description", $description, \PDO::PARAM_STR);
        $stmt->bindParam(":left_block", $left_block, \PDO::PARAM_STR);
        $stmt->bindParam(":title", $title, \PDO::PARAM_STR);
        $stmt->bindParam(":type", $type, \PDO::PARAM_STR);
        $end_date = date("Y-m-d", strtotime($end_date));
        $stmt->bindParam(":end_date", $end_date, \PDO::PARAM_STR);
        $update = $stmt->execute();
        return $update;
    }
    public function update_promotion_end_date_value($id,$end_date)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE promotion SET end_date =:end_date WHERE product_id=:product_id");
        $stmt->bindParam(":product_id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":end_date", $end_date, \PDO::PARAM_STR);
        $update = $stmt->execute();
        return $update;
    }

//        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
//        $stmt->execute();
//    public function get_products_by_department_id($department_id)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("SELECT * FROM products WHERE department_id=?");
//        $stmt->bindValue(1, $department_id);
//        return $stmt;
//    }
//
//    public function get_products_by_brand_and_department_id($brand,$department_id)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("SELECT * FROM products  WHERE brand =? AND department_id=?");
////        $stmt->bindParam(":department_id", $department_id, \PDO::PARAM_INT);
////        $stmt->bindParam(":brand", $brand, \PDO::PARAM_STR);
//        $stmt->bindValue(1, $brand);
//        $stmt->bindValue(2, $department_id);
//
//        return $stmt;
//    }
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
//    public function get_prices_by_discount()
//    {
//        $conn = App::$app->get_db();
//        return $conn->query("SELECT p.id,d.product_id,p.discount,p.price,d.end_date,d.value_discount,p.name,p.photo FROM products p LEFT JOIN discount d ON d.product_id=p.id WHERE p.discount=1")->fetchAll();
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
//    public function update_product($iid,$name,$price,$colour,$brand,$quantity,$description,$adding_info,$discount,$new_product,$promotion,$popular,$department_id)
//    {
//        $conn = App::$app->get_db();
//        $stmt = $conn->prepare("UPDATE products SET name=:name, price=:price,color=:colour,brand=:brand,quantity=:quantity,big_description=:big_description,adding_info=:adding_info, discount=:discount, new=:new,promotion=:promotion,popular=:popular,department_id=:department_id WHERE id=:id");
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
//        $stmt->bindParam(":popular", $popular, \PDO::PARAM_INT);
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
?>  
