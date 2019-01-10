<?php 
namespace Application\models;  
use Application\core\App;
use Application\models\Region;
use Application\models\Curier;

class Product
{
    public $conn;

    public function get_products()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM products ")->fetchAll();
    }

    public function check_if_exist_product($product_name)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM products WHERE name=?");
        $stmt->bindValue(1, $product_name);
        return $stmt;
    }

    public function get_total_products_by_department_id($department_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT COUNT(id)as total FROM products WHERE department_id=?");
        $stmt->bindValue(1, $department_id);
        return $stmt;
    }

    public function get_products_by_department_id($department_id,$limit,$start)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT  p.id,p.department_id,p.name,p.price,p.discount,p.promotion,p.popular,p.new_product,p.special_offer,p.photo,p.quantity,p.big_description,p.adding_info,p.brand,p.colour,d.product_id,d.value_discount,d.end_date  FROM products p LEFT JOIN discount d ON p.id=d.product_id WHERE p.department_id=:department_id  LIMIT :limit OFFSET :start  ");
        $stmt->bindParam(":department_id", $department_id, \PDO::PARAM_INT);
        $stmt->bindParam(":limit", $limit, \PDO::PARAM_INT);
        $stmt->bindParam(":start", $start, \PDO::PARAM_INT);
        return $stmt;
    }

    public function get_products_and_promotions($promotion_id,$limit,$start)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT pm.promotion_discount,pm.promotion_offer,pm.promotion_minus,pm.promotion_discount_value,
        pr.special_offer,pr.discount,pr.photo,pr.new_product,pr.popular,pr.id as ProductId,pr.name,pr.price,pr.department_id,
        pr.promotion,pm.id as PromotionId,pm.value_promotion,pm.end_date,pm.left_block,pm.title,pm.type FROM products pr LEFT JOIN 
         promotion pm ON pr.promotion=pm.id WHERE pr.promotion=:promotion_id  LIMIT :limit OFFSET :start ");
        $stmt->bindParam(":promotion_id", $promotion_id, \PDO::PARAM_INT);
        $stmt->bindParam(":limit", $limit, \PDO::PARAM_INT);
        $stmt->bindParam(":start", $start, \PDO::PARAM_INT);
        return $stmt;
    }

    public function get_total_by_product_promotion($promotion_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT COUNT(id)as total FROM products WHERE promotion=?");
        $stmt->bindValue(1, $promotion_id);
        return $stmt;
    }

    public function update_checkboxes_promotions($selected,$promotion_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE products SET promotion =:promotion_id WHERE id=:selected");
        $stmt->bindParam(":selected", $selected, \PDO::PARAM_INT);
        $stmt->bindParam(":promotion_id", $promotion_id, \PDO::PARAM_INT);
        $update = $stmt->execute();
        return $update;
    }

    public function remove_discount($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE products SET discount = 0 WHERE id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $update = $stmt->execute();
        return $update;
    }

    public function get_products_by_news($limit,$start)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM products WHERE new_product=1 LIMIT :limit OFFSET :start");
        $stmt->bindParam(":limit", $limit, \PDO::PARAM_INT);
        $stmt->bindParam(":start", $start, \PDO::PARAM_INT);
        return $stmt;
    }

    public function get_products_by_popular($limit,$start)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM products WHERE popular=1 LIMIT :limit OFFSET :start");
        $stmt->bindParam(":limit", $limit, \PDO::PARAM_INT);
        $stmt->bindParam(":start", $start, \PDO::PARAM_INT);
        return $stmt;
    }

    public function get_total_by_new_product()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT COUNT(id)as total FROM products WHERE new_product=1")->fetchAll();
        return $stmt;
    }

    public function get_total_by_popular()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT COUNT(id)as total FROM products WHERE popular=1")->fetchAll();
        return $stmt;
    }

    public function get_total_by_soon_be_over()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT COUNT(id)as total FROM products WHERE quantity<10")->fetchAll();
        return $stmt;
    }

    public function get_products_soon_be_over($limit,$start)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM products WHERE quantity<10 LIMIT :limit OFFSET :start");
        $stmt->bindParam(":limit", $limit, \PDO::PARAM_INT);
        $stmt->bindParam(":start", $start, \PDO::PARAM_INT);
        return $stmt;
    }

    public function get_products_by_brand_and_department_id($brand,$department_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM products  WHERE brand =? AND department_id=?");
        $stmt->bindValue(1, $brand);
        $stmt->bindValue(2, $department_id);
        return $stmt;
    }

    public function get_discount_by_special_offer_and_discount()
    {
        $conn = App::$app->get_db();
       return $conn->query("SELECT d.value_discount,d.product_id,p.id,p.department_id,p.discount,s.product_id,p.special_offer FROM products p LEFT JOIN discount d ON d.product_id=p.id LEFT JOIN special_offer s ON s.product_id=p.id  WHERE p.discount=1 AND p.special_offer=1")->fetchAll();

    }

    public function get_discount_by_product_id($iid)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT d.value_discount,d.product_id,p.id,p.department_id,p.discount FROM products p LEFT JOIN discount d ON d.product_id=p.id WHERE p.discount=1 AND p.id=?");
        $stmt->bindValue(1, $iid);
        return $stmt;
    }

    public function get_discount_by_department_id_and_discount($department_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT d.value_discount,d.product_id,p.id,p.department_id,p.discount FROM products p LEFT JOIN discount d ON d.product_id=p.id WHERE p.discount=1 AND p.department_id=?");
        $stmt->bindValue(1, $department_id);
        return $stmt;
    }

    public function get_brands_by_department_id($department_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM products  WHERE department_id=? GROUP BY brand,department_id");
        $stmt->bindValue(1, $department_id);
        return $stmt;
    }
    public function get_colors_by_department_id($department_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM products  WHERE department_id=? GROUP BY colour,department_id");
        $stmt->bindValue(1, $department_id);
        return $stmt;
    }

    public function get_allprices_by_department_id($department_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM products  WHERE department_id=? GROUP BY price,department_id");
        $stmt->bindValue(1, $department_id);
        return $stmt;
    }

    public function get_prices_by_department_id($department_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT MIN(price) as min, MAX(price) as max FROM products  WHERE department_id=? ");
        $stmt->bindValue(1, $department_id);
        return $stmt;
    }

    public function update_promotion_value_into_product($iid,$stmt)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE products SET promotion = :promotion WHERE id=:id");
        $stmt->bindParam(":id", $iid, \PDO::PARAM_INT);
        $stmt->bindParam(":promotion", $stmt, \PDO::PARAM_STR);
        $update = $stmt->execute();
        return $update;
    }

    public function get_prices_by_discount($limit,$start)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT p.id,d.product_id,p.discount,p.price,d.end_date,d.value_discount,p.name,p.photo,p.department_id,p.brand,p.colour FROM products p LEFT JOIN discount d ON d.product_id=p.id WHERE p.discount=1 LIMIT :limit OFFSET :start");
        $stmt->bindParam(":limit", $limit, \PDO::PARAM_INT);
        $stmt->bindParam(":start", $start, \PDO::PARAM_INT);
        return $stmt;
    }

    public function get_total_by_discount()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT COUNT(id)as total FROM products WHERE discount=1")->fetchAll();
        return $stmt;
    }

    public function get_total_by_special_offers()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT COUNT(id)as total FROM products WHERE special_offer=1")->fetchAll();
        return $stmt;
    }

    public function get_prices_by_special_offers($limit,$start)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM products WHERE special_offer=1 LIMIT :limit OFFSET :start ");
        $stmt->bindParam(":limit", $limit, \PDO::PARAM_INT);
        $stmt->bindParam(":start", $start, \PDO::PARAM_INT);
        return $stmt;
    }

    public function get_product_by_id($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT d.product_id, d.value_discount,d.end_date,p.id as productId,p.name,p.photo,p.price,p.discount,p.promotion,p.popular,p.special_offer,p.new_product,p.big_description,p.colour,p.adding_info,p.brand,p.department_id,p.quantity FROM products p LEFT JOIN discount d ON d.product_id=p.id  WHERE p.id =? ");
        $stmt->bindValue(1, $id);
        return $stmt;
    }

    public function update_photo($filename,$id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE products SET photo = :photo WHERE id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":photo", $filename, \PDO::PARAM_STR);
        $update = $stmt->execute();
        return $update;
    }

    public function update_product($iid,$name,$price,$colour,$brand,$quantity,$description,$adding_info,$discount,$new_product,$promotion,$special_offer,$popular)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE products SET name =:name,price=:price,colour=:colour,brand=:brand,quantity=:quantity,big_description=:big_description,adding_info=:adding_info,
                    discount=:discount,new_product=:new_product,promotion=:promotion,special_offer=:special_offer, popular=:popular WHERE id=:id");
        $stmt->bindParam(":id", $iid, \PDO::PARAM_INT);
        $stmt->bindParam(":name", $name, \PDO::PARAM_STR);
        $stmt->bindParam(":price", $price, \PDO::PARAM_INT);
        $stmt->bindParam(":colour", $colour, \PDO::PARAM_STR);
        $stmt->bindParam(":brand", $brand, \PDO::PARAM_STR);
        $stmt->bindParam(":quantity", $quantity, \PDO::PARAM_STR);
        $stmt->bindParam(":big_description", $description, \PDO::PARAM_STR);
        $stmt->bindParam(":adding_info", $adding_info, \PDO::PARAM_STR);
        $stmt->bindParam(":discount", $discount, \PDO::PARAM_INT);
        $stmt->bindParam(":new_product", $new_product, \PDO::PARAM_INT);
        $stmt->bindParam(":promotion", $promotion, \PDO::PARAM_INT);
        $stmt->bindParam(":special_offer", $special_offer, \PDO::PARAM_INT);
        $stmt->bindParam(":popular", $popular, \PDO::PARAM_INT);
        $update = $stmt->execute();
        return $update;
    }

    public function insert_new_product($name,$department_id,$price,$discount,$popular,$new_product,$special_offer,$promotion,$photo,$quantity,$big_description,$adding_info,$brand,$colour)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("INSERT INTO products (name,department_id, price,discount,popular,new_product,special_offer,promotion,photo,quantity,big_description,adding_info,brand,colour) 
            VALUES(:name,:department_id, :price,:discount,:popular,:new_product,:special_offer,:promotion,:photo,:quantity,:big_description,:adding_info,:brand,:colour)");
        $stmt->bindParam(":name", $name, \PDO::PARAM_STR);
        $stmt->bindParam(":department_id", $department_id, \PDO::PARAM_INT);
        $stmt->bindParam(":price", $price, \PDO::PARAM_INT);
        $stmt->bindParam(":discount", $discount, \PDO::PARAM_INT);
        $stmt->bindParam(":popular", $popular, \PDO::PARAM_INT);
        $stmt->bindParam(":new_product", $new_product, \PDO::PARAM_INT);
        $stmt->bindParam(":special_offer", $special_offer, \PDO::PARAM_INT);
        $stmt->bindParam(":promotion", $promotion, \PDO::PARAM_INT);
        $stmt->bindParam(":photo", $photo, \PDO::PARAM_STR);
        $stmt->bindParam(":quantity", $quantity, \PDO::PARAM_INT);
        $stmt->bindParam(":big_description", $big_description, \PDO::PARAM_STR);
        $stmt->bindParam(":adding_info", $adding_info, \PDO::PARAM_STR);
        $stmt->bindParam(":brand", $brand, \PDO::PARAM_STR);
        $stmt->bindParam(":colour", $colour, \PDO::PARAM_STR);
        $stmt->execute();
    }

    public function delete_product($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("DELETE  FROM products WHERE id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function insert_main_photo($photo)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare( "INSERT INTO products (photo)  VALUES(:photo)");
        $stmt->bindParam(":photo", $photo, \PDO::PARAM_STR);
        $stmt->execute();
    }

    public function count_all_products()
    {
        $conn = App::$app->get_db();
        $stmt = $conn->query("SELECT  COUNT(id)as total FROM products ")->fetchAll();
        return $stmt;
    }
}
?>  
