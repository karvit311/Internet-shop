<?php
namespace Application\controllers;
use Application\models\Workers;
use Application\models\Schedule;
use Application\models\Region;
use Application\models\Uploader;

class MainController 
{
//    private $uploader;
//    public function __construct() {
//        $this->uploader = new Uploader();
//    }
	public function actionIndex()
	{
        session_start();
        require_once(ROOT . '/application/views/main/head.php');
    	require_once(ROOT . '/application/views/main/index.php');
        require_once(ROOT . '/application/views/main/footer.php');
	}
    public function actionNewsOfCompany()
    {
        require_once(ROOT . '/application/views/main/head.php');
        require_once(ROOT . '/application/views/main/news_of_company.php');
        require_once(ROOT . '/application/views/main/footer.php');
    }
//    public function actionDelivery()
//    {
//        session_start();
//        require_once(ROOT . '/application/views/main/head.php');
//        require_once(ROOT . '/application/views/main/delivery.php');
//        require_once(ROOT . '/application/views/main/footer.php');
//    }
    public function actionNews()
    {
        session_start();
        require_once(ROOT . '/application/views/main/head.php');
        require_once(ROOT . '/application/views/main/news.php');
        require_once(ROOT . '/application/views/main/footer.php');
    }
    public function actionPopular()
    {
        session_start();
        require_once(ROOT . '/application/views/main/head.php');
        require_once(ROOT . '/application/views/main/popular.php');
        require_once(ROOT . '/application/views/main/footer.php');
    }
    public function actionBeOver()
    {
        session_start();
        require_once(ROOT . '/application/views/main/head.php');
        require_once(ROOT . '/application/views/main/be_over.php');
        require_once(ROOT . '/application/views/main/footer.php');
    }
    public function actionSignup()
    {
       // session_start();
        require_once(ROOT . '/application/views/main/head.php');
        require_once(ROOT . '/application/views/main/signup.php');
        require_once(ROOT . '/application/views/main/footer.php');
    }
    public function actionLogout()
    {
        session_start();
        session_unset();
        $_SESSION = array();
        session_destroy();
        header('Location: /main/index');
    }
//
//    public function actionSignupData()
//    {
//        if(isset($_POST['name'])){
//            $name = $_POST['name'];
//            echo $name;
//        }
//    }
    public function actionCheckUnique()
    {
        if (NULL !=($_POST['email'])) {
            $check_email = ($_POST['email']);
            $check_email_res = new \Application\models\Users();
            $check_email_result = $check_email_res->check_user_data($check_email);
            $check_email_result->execute(array($check_email));
            $count = $check_email_result->fetchColumn();
            if ($count > 0) {
                echo 1;
            }else{
                echo 2;
            }
        }
    }
    public function actionCheckData()
    {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $check_correct_user_data = new \Application\models\Users();
            $res_check_correct_user_data = $check_correct_user_data->check_user($email,$password);
            $res_check_correct_user_data->execute(array($email,$password));
            $count = $res_check_correct_user_data->fetchColumn();
            if ($count > 0) {
                $get_user = new \Application\models\Users();
                $res_get_user = $get_user->check_user_data($email);
                $res_get_user->execute(array($email));
                foreach($res_get_user as $result_get_user) {
                    $id = $result_get_user['id'];
                    $name = $result_get_user['name'];
                    session_start();
                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["email"] = $email;
                    $_SESSION["name"] = $name;
                }
                echo 1;
            }else{
                echo '2';
            }
        }
    }

    public function actionGetAbout()
    {
        $about = new \Application\models\About();
        $res_abouts= $about->get_about();
        foreach ($res_abouts as $res) {
            $sub_data['id'] = $res['id'];
            $sub_data['title'] = $res['title'];
            $sub_data['content'] = $res['content'];
            $data[] = $sub_data;
        }
        echo json_encode($data);
    }

    public function actionAbout()
    {
        session_start();
        require_once(ROOT . '/application/views/main/head.php');
        require_once(ROOT . '/application/views/main/about.php');
        require_once(ROOT . '/application/views/main/footer.php');
    }

    public function actionLogin()
    {
        session_start();
//        session_unset();
//        $_SESSION = array();
//        session_destroy();
        require_once(ROOT . '/application/views/main/head.php');
        require_once(ROOT . '/application/views/main/login.php');
        require_once(ROOT . '/application/views/main/footer.php');
    }

    public function actionSpecialOffers()
    {
        session_start();
        require_once(ROOT . '/application/views/main/head.php');
        require_once(ROOT . '/application/views/main/special_offers.php');
        require_once(ROOT . '/application/views/main/footer.php');

    }

    public function actionDiscount()
    {
        session_start();
        require_once(ROOT . '/application/views/main/head.php');
        require_once(ROOT . '/application/views/main/discount.php');
        require_once(ROOT . '/application/views/main/footer.php');

    }

    public function actionPromotion()
    {
        session_start();
        require_once(ROOT . '/application/views/main/head.php');
        require_once(ROOT . '/application/views/main/promotion.php');
        require_once(ROOT . '/application/views/main/footer.php');

    }

    public function actionpromotionsProducts()
    {
        session_start();
        require_once(ROOT . '/application/views/main/head.php');
        require_once(ROOT . '/application/views/main/promotions_products.php');
        require_once(ROOT . '/application/views/main/footer.php');

    }

    public function actionProducts()
    {
        $department_id = $_GET['department_id'];
        session_start();
        require_once(ROOT . '/application/views/main/head.php');
        require_once(ROOT . '/application/views/main/products.php');
        require_once(ROOT . '/application/views/main/footer.php');
    }

    public function actionView()
    {
        session_start();
        $id = $_GET['id'];
            $ip_address_user = $_GET['ip_address'];
            $users = new \Application\models\Users();
            $check_if_exists = $users->check_if_exists($ip_address_user);
            $check_if_exists->execute(array($ip_address_user));
            $count = $check_if_exists->fetchColumn();
            if ($count > 0) {
                $users_by_ip_address = new \Application\models\Users();
                $res_users_by_ip_address = $users_by_ip_address->get_user_by_ip_address($ip_address_user);
                $res_users_by_ip_address->execute(array($ip_address_user));
                foreach($res_users_by_ip_address as $user){
                    $ids_viewed_product = new \Application\models\ViewedProduct();
                    $check_if_exists_ids = $ids_viewed_product->check_if_exists_viewed_id($ip_address_user, $id);
                    $check_if_exists_ids->execute(array($ip_address_user, $id));
                    $count_product = $check_if_exists_ids->fetchColumn();
                    if ($count_product > 0) {
                    } else {
                        $id_of_product = $_GET['id'];
                        $insert_viewed_product = new \Application\models\ViewedProduct();
                        $insert_viewed_product->insert_ids_viewed_products($user['id'], $id_of_product,$ip_address_user);
                    }
                }
            } else {
                $id_of_product = $_GET['id'];
                $update_exists_user = new \Application\models\Users();
                $update_exists_user->insert_guest_user($ip_address_user);
                $last_insert_id = \Application\core\App::$app->lastInsertId();
                $insert_viewed_product = new \Application\models\ViewedProduct();
                $insert_viewed_product->insert_ids_viewed_products($last_insert_id,$id_of_product,$ip_address_user);
            }

        require_once(ROOT . '/application/views/main/head.php');
        require_once(ROOT . '/application/views/main/view.php');
        require_once(ROOT . '/application/views/main/footer.php');
    }

//    public function actionDepartment()
//    {
//        require_once(ROOT . '/application/views/main/head.php');
//        require_once(ROOT . '/application/views/main/department.php');
//        require_once(ROOT . '/application/views/main/footer.php');
//    }
//
//    public function actionSalary()
//    {
//        require_once(ROOT . '/application/views/main/head.php');
//        require_once(ROOT . '/application/views/main/salary.php');
//        require_once(ROOT . '/application/views/main/footer.php');
//    }
    public function actionCart()
    {
        session_start();
        require_once(ROOT . '/application/views/main/head.php');
        require_once(ROOT . '/application/views/main/cart.php');
        require_once(ROOT . '/application/views/main/footer.php');
    }

//    public function actionGetDelivery()
//    {
//        $get_deliveries = new \Application\models\Delivery();
//        $deliveries  = $get_deliveries->get_deliveres();
//        foreach ($deliveries as $delivery) {
//            $sub_data['address'] = $delivery['address'];
//            $date = $delivery['date'];
//            $change_format_date = date_create($date);
//            $change_format_date = date_format($change_format_date, 'm/d/Y');
//            $sub_data['date'] = $change_format_date;
//            $sub_data['time'] = $delivery['time'];
//            $data[] = $sub_data;
//        }
//        echo json_encode($data);
//    }

    public function actionInsertOrder() /////////////////
    {
        if ( isset ($_POST['price'])) {
            $order_delivery = $_POST['order_delivery'];
            $order_fio = $_POST['order_fio'];
            $order_phone = $_POST['order_phone'];
            $order_email = $_POST['order_email'];
            $order_address = $_POST['order_address'];
            $ip_address = $_POST['ip_address'];
            $array_prices = $_POST['array_prices'];
            $product_ids = $_POST['product_ids'];
            $arr_quantity = $_POST['arr_quantity'];
            $length = $_POST['length'];
            $datetime = date("Y-m-d H:i:s");
            $product_explode =explode(',',$product_ids);
            $prices_explode = explode(',',$array_prices);
            $quantity_explode = explode(',',$arr_quantity);
            for($i=0; $i<=$length;$i++){
                $product_ids_arr[]=$product_explode[$i];
                $prices_arr[]=$prices_explode[$i];
                $quantity_arr[]= $quantity_explode[$i];
                $new_order = new \Application\models\Orders();
                $res_new_order = $new_order->newOrder($order_fio,$order_delivery,$order_email,$order_phone,$order_address,$prices_arr[$i],$product_ids_arr[$i],$ip_address,$quantity_arr[$i],$datetime);
                $stmt=\Application\core\App::$app->lastInsertId();
                echo $stmt;
            }
        }
    }

    public function actionAddNewReview()
    {
        if (NULL !=($_POST['review'])) {
            $name = $_POST['name'];
            $review = $_POST['review'];
            $product_id = $_POST['product_id'];
            $ip_address= $_POST['ip_address'];
            $insert_new_review = new \Application\models\Review();
            $res_insert_new_reviews = $insert_new_review->insert_new_review($name,$review,$product_id,$ip_address);
            echo 1;
        }
    }

    public function actionGetPromotionByIid()
    {
        if (NULL !=($_POST['iid'])) {
            $id = $_POST['iid'];
            $info_promotion_by_id = new \Application\models\Promotion();
            $res_info_promotion_by_id= $info_promotion_by_id->get_promotions_by_iid($id);
            $res_info_promotion_by_id->execute(array($id));
            foreach ($res_info_promotion_by_id as $res) {
                $sub_data['id'] = $res['id'];
                $sub_data['value_promotion'] = $res['value_promotion'];
                $sub_data['end_date'] = $res['end_date'];
                $sub_data['left_block'] = $res['left_block'];
                $sub_data['title'] = $res['title'];
                $sub_data['type'] = $res['type'];
                $data[] = $sub_data;
            }
            echo json_encode($data);
        }
    }

    public function actionGetProductById()
    {
        if (NULL !=($_POST['id'])) {
            $id = $_POST['id'];
            $info_product_by_id = new \Application\models\Product();
            $res_info_product_by_id= $info_product_by_id->get_product_by_id($id);
            $res_info_product_by_id->execute(array($id));
            foreach ($res_info_product_by_id as $res_info_product) {
                $sub_data['id'] = $res_info_product['id'];
                $sub_data['name'] = $res_info_product['name'];
                $sub_data['photo'] = $res_info_product['photo'];
                $sub_data['brand'] = $res_info_product['brand'];
                $sub_data['color'] = $res_info_product['color'];
                $sub_data['price'] = $res_info_product['price'];
                $sub_data['big_description'] = $res_info_product['big_description'];
                $sub_data['adding_info'] = $res_info_product['adding_info'];
                $sub_data['quantity'] = $res_info_product['quantity'];
                $sub_data['discount'] = $res_info_product['discount'];
                $sub_data['new'] = $res_info_product['new'];
                $sub_data['popular'] = $res_info_product['popular'];
                $sub_data['promotion'] = $res_info_product['promotion'];
                $discounts = new \Application\models\Discount();
                $res_discounts = $discounts->get_discounts_by_product_id($id);
                $res_discounts->execute(array($id));
                foreach($res_discounts as $res_discount) {
                    $sub_data['value_discount'][] = $res_discount['value_discount'];
                    $sub_data['product_id'][] = $res_discount['product_id'];
                    $sub_data['end_date'][] = $res_discount['end_date'];
                }
                $special_offers = new \Application\models\SpecialOffer();
                $res_special_offers= $special_offers->get_special_offer_by_id($id);
                $res_special_offers->execute(array($id));
                foreach($res_special_offers as $res_special_offer) {
                    $sub_data['end_date_special_offer'][] = $res_special_offer['end_date'];
                }
                $small_imgs = new \Application\models\SmallImages();
                $res_small_imgs= $small_imgs->get_small_image_by_id($id);
                $res_small_imgs->execute(array($id));
                foreach($res_small_imgs as $res_small_img) {
                    $sub_data['small_images'][] = $res_small_img['name'];
                    $sub_data['small_id'][] = $res_small_img['id'];
                }
                $data[] = $sub_data;
            }
            echo json_encode($data);
        }
    }

    public function actionUpdateSpecialOffer()
    {

        if (isset($_POST['iid']) && isset($_POST['end_date']) ) {
            $iid = trim($_POST['iid']);
            $end_date = $_POST['end_date'];
            $update_checkboxes = new \Application\models\SpecialOffer();
            $res_update_checkboxes = $update_checkboxes->update_special_offer($iid,$end_date);
            echo 1;
        }
    }

//    public function actionUpSmImg()
//    {
//        /* Getting file name */
//        $filename = $_FILES['file']['name'];
//        /* Location */
//        $location = "C:/OpenServer/domains/localhost/application/photo/phone/small_images/".$filename;
//        $uploadOk = 1;
//        $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
//        /* Valid Extensions */
//        $valid_extensions = array("jpg","jpeg","png");
//        /* Check file extension */
//        if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
//            $uploadOk = 0;
//        }
//        if($uploadOk == 0){
//            echo 0;
//        }else{
//            /* Upload file */
//            if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
//                echo $filename;
//            }else{
//                 echo 0;
//            }
//        }
//    }

//    public function actionUploadSmallImages()
//    {
//        /* Getting file name */
//        $filename = $_FILES['file']['name'];
//        /* Location */
//        $location = "C:/OpenServer/domains/localhost/application/photo/phone/small_images/".$filename;
//        $uploadOk = 1;
//        $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
//        /* Valid Extensions */
//        $valid_extensions = array("jpg","jpeg","png");
//        /* Check file extension */
//        if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
//            $uploadOk = 0;
//        }
//        if($uploadOk == 0){
//            echo 0;
//        }else{
//            /* Upload file */
//            if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
//                echo $filename;
//            }else{
//               // echo 0;
//            }
//        }
//    }

//    public function actionUpload()
//    {
//        /* Getting file name */
//        $filename = $_FILES['file']['name'];
//        /* Location */
//        $location = "C:/OpenServer/domains/localhost/application/photo/phone/".$filename;
//        $uploadOk = 1;
//        $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
//        /* Valid Extensions */
//        $valid_extensions = array("jpg","jpeg","png");
//        /* Check file extension */
//        if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
//            $uploadOk = 0;
//            echo 0;
//        }
//        if($uploadOk == 0){
//            echo 0;
//        }else{
//            /* Upload file */
//            if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
//                echo $filename;
//            }else{
//                echo 0;
//            }
//        }
//    }

    public function actionInsertMainPhotoAdd()
    {
        if (NULL !=($_POST['photo'])) {
            $photo = $_POST['photo'];
            $insert_main_photo = new \Application\models\Product();
            $res  = $insert_main_photo->insert_main_photo($photo);
            $stmt=\Application\core\App::$app->lastInsertId();
            echo $stmt;
        }
    }

    public function actionUpdatePhoto()
    {
        if (NULL !=($_POST['photo'])) {
            $photo = $_POST['photo'];
            $id = $_POST['id'];
            $update_main_photo = new \Application\models\Product();
            $res  = $update_main_photo->update_photo($photo,$id);
            echo 1;
        }
    }

    public function actionInsertSmallPhoto()
    {
        if (NULL !=($_POST['photo'])) {
            $photo = $_POST['photo'];
            $id = $_POST['id'];
            $insert_small_photo = new \Application\models\SmallImages();
            $res  = $insert_small_photo->insert_photo($photo,$id);
            $stmt=\Application\core\App::$app->lastInsertId();
            echo trim($stmt);
        }
    }

    public function actionGetDiscountValueForIcon()
    {
        if(isset($_POST['iid']))
        {
            $iid = $_POST['iid'];
            $get_discounts = new \Application\models\Product();
            $discounts  = $get_discounts->get_discount_by_product_id($iid);
            $discounts->execute(array($iid));
            foreach ($discounts as $discount) {
                $sub_data['product_id'] = $discount['product_id'];
                $sub_data['value_discount'] = $discount['value_discount'];
                $sub_data['end_date'] = $discount['end_date'];
                $data[] = $sub_data;
            }
            echo json_encode($data);
        }
    }

    public function actionGetImage()
    {
        if (NULL !=($_POST['image_id'])) {
            $image_id = $_POST['image_id'];
            $small_image_ids = new \Application\models\SmallImages();
            $res_small_image_ids = $small_image_ids->get_small_image_by_id($image_id);
            $res_small_image_ids->execute(array($image_id));
            foreach ($res_small_image_ids as $res_small_image_id) {
                $sub_data['id'] = $res_small_image_id['id'];
                $sub_data['name'] = $res_small_image_id['name'];
                $data[] = $sub_data;
            }
            echo json_encode($data);
        }
    }

    public function actionGetInfoAboutPurchase()
    {
        if (NULL !=($_POST['iid'])) {
            $iid = $_POST['iid'];
            $info_products = new \Application\models\Products();
            $res_small_image_ids = $info_products->get_small_image_by_id($iid);
            $res_small_image_ids->execute(array($iid));
            foreach ($res_small_image_ids as $res_small_image_id) {
                $sub_data['id'] = $res_small_image_id['id'];
                $sub_data['name'] = $res_small_image_id['name'];
                $data[] = $sub_data;
            }
            echo json_encode($data);
        }
    }

    public function actionGetDepartmentId()
    {
        if (NULL !=($_POST['department'])) {
            $department = $_POST['department'];
            $search_department = new \Application\models\Department();
            $departments  = $search_department->get_department_id($department);
            echo 1;
        }
    }
//
//    public function actionAddNewDelivery()
//    {
//        if (NULL !=($_POST['city_id'])) {
//            $address = $_POST['address'];
//            $date = strip_tags($_POST['date']);
//            $date = date_create($date);
//            $date = date_format($date, 'Y-m-d H:s:i');
//            $time = $_POST['time'];
//            $city_id = $_POST['city_id'];
//            $supplier_id = $_POST['supplier_id'];
//            $new_delivery = new \Application\models\Delivery();
//            $new_delivery->insert_delivery($address,$date,$time,$city_id,$supplier_id);
//            echo 1;
//        }
//    }

    public function actionAddNewDepartment()
    {
        if (NULL !=($_POST['new_department'])){
            $new_department = $_POST['new_department'];
        }
        if( isset($_POST['selected_department_id'])){
            $parent_id = $_POST['selected_department_id'];
        }
        if(isset($_POST['selected_sub_parent_id'])) {
            $parent_id = $_POST['selected_sub_parent_id'];
        }else{
            if( isset($_POST['selected_department_id'])){
                $parent_id = $_POST['selected_department_id'];
            }
        }
        if(isset($new_department) && isset($parent_id)) {
             $res_new_department = new \Application\models\Department();
             $res_new_department->insert_department($new_department, $parent_id);
             $stmt=\Application\core\App::$app->lastInsertId();
             echo $stmt;
        }else{
            echo 'Отдел не добавлен';
        }
    }

    public function actionGetChildOfDepartment()
    {
        if (NULL !=($_POST['main_department_id'])) {
            $main_department_id = $_POST['main_department_id'];
            $department_childs = new \Application\models\Department();
            $res_department_childs = $department_childs->get_departments_parent($main_department_id);
            $res_department_childs->execute(array($main_department_id));
            foreach ($res_department_childs as $department_child) {
                $sub_data['department'] = $department_child['department'];
                $sub_data['id'] = $department_child['id'];
                $sub_data['parent_id'] = $department_child['parent_id'];
                $sub_data['photo'] = $department_child['photo'];
                $data[] = $sub_data;
            }
            echo json_encode($data);
        }
    }

    public function actionAddNewSupplier()
    {
        if (isset($_POST['new_supplier']) && isset($_POST['new_info_supplier'])&& isset($_POST['new_department'])) {
            $new_supplier = $_POST['new_supplier'];
            $new_info_supplier = $_POST['new_info_supplier'];
            $department = trim($_POST['new_department']);
            $if_exist_new_supplier = new \Application\models\Supplier();
            $res_exist_supplier = $if_exist_new_supplier->get_exist_new_supplier($new_supplier);
            $res_exist_supplier->execute(array($new_supplier));
            $count = $res_exist_supplier->fetchColumn();
            if ($count > 0) {
                echo 'already exist';
            } else {
                $res_new_supplier = new \Application\models\Supplier();
                $res_new_supplier->insert_supplier($new_supplier, $new_info_supplier, $department);
                echo $department;
            }
        }
    }
//
//    public function actionUpdateDelivery()
//    {
//        if(isset($_POST['supplier_id']) && isset($_POST['city_id']) && isset($_POST['address']) && isset($_POST['date'])&& isset($_POST['time'])&& isset($_POST['info'])&& isset($_POST['department'])) {
//            $supplier_id = $_POST['supplier_id'];
//            $supplier = $_POST['supplier'];
//            $city_id = $_POST['city_id'];
//            $address = $_POST['address'];
//            $date = $_POST['date'];
//            $time = $_POST['time'];
//            $info = $_POST['info'];
//            $department = $_POST['department'];
//            $delivery = new \Application\models\Delivery();
//            $search_delivery = $delivery->get_deliveres_conditionals_supplier($supplier);
//            $search_delivery->execute(array($supplier));
//            $count = $search_delivery->rowCount();
//            if ($count > 0) {
//                echo 'count';
//            } else {
//            $deliveries = new \Application\models\Delivery();
//            $update_delivery = $deliveries->update_worker($supplier_id, $city_id, $address, $date, $time);
//            echo 1;
//            }
//        }
//    }

    public function actionGetFilterProductBrand()
    {
        if(isset($_POST['brand'])  )
        {
            $res = $_POST['brand'];
            $r = explode(',',$res);
            foreach($r as $ress){
                $string = trim(preg_replace('/\s+/', '', $ress));
                $department_id =15;
                $get_products = new \Application\models\Product();
                $products  = $get_products->get_products_by_brand_and_department_id($string,$department_id);
                $products->execute(array($string,$department_id));
                foreach ($products as $product) {
                    $sub_data['id'] = $product['id'];
                    $sub_data['name'] = $product['name'];
                    $sub_data['department_id'] = $product['department_id'];
                    $sub_data['photo'] = $product['photo'];
                    $sub_data['price'] = $product['price'];
                    $data_res = $sub_data;
                }
                echo json_encode($data_res);
           }
        }
    }
    public function actionGetInfoAboutSupplier()
    {
        if(isset($_POST['supplier_id'])  )
        {
            $supplier_id = $_POST['supplier_id'];
            $get_suppliers = new \Application\models\Supplier();
            $suppliers  = $get_suppliers->get_supplier_conditionals_supplier_id($supplier_id);
            $suppliers->execute(array($supplier_id));
            foreach ($suppliers as $supplier) {
                $sub_data['supplier_id'] = $supplier_id;
                $sub_data['supplier'] = $supplier['supplier'];
                $sub_data['info'] = $supplier['info'];
                $sub_data['city_id'] = $supplier['city_id'];
                $get_departments= new \Application\models\Department();
                $departments = $get_departments->get_department_conditionals_id($supplier['department']);
                $departments->execute(array($supplier['department']));
                foreach ($departments as $department) {
                    $sub_data['department'] = $department['department'];
                }
                $data[] = $sub_data;
            }
            echo json_encode($data);
        }
    }
//    public function actionGetInfoAboutDelivery()
//    {
//        if(isset($_POST['date']) && isset($_POST['time']) )
//        {
//            $date = $_POST['date'];
//            $time = $_POST['time'];
//            $change_format_date = date_create($date);
//            $change_format_date = date_format($change_format_date, 'Y-m-d');
//            $get_deliveries = new \Application\models\Delivery();
//            $deliveries  = $get_deliveries->get_deliveres_date_city_id_time($time,$change_format_date);
//            $deliveries->execute(array($time,$change_format_date));
//            foreach ($deliveries as $delivery) {
//                $get_suppliers= new \Application\models\Supplier();
//                $suppliers = $get_suppliers->get_supplier_conditionals_supplier_id($delivery['supplier_id']);
//                $suppliers->execute(array($delivery['supplier_id']));
//                foreach ($suppliers as $supplier) {
//                    $sub_data['address'] = $delivery['address'];
//                    $sub_data['date'] = $delivery['date'];
//                    $sub_data['time'] = $delivery['time'];
//                    $sub_data['supplier_id'] = $delivery['supplier_id'];
//                    $sub_data['supplier'] = $supplier['supplier'];
//                    $sub_data['info'] = $supplier['info'];
//                    $get_departments= new \Application\models\Department();
//                    $departments = $get_departments->get_department_conditionals_id($supplier['department']);
//                    $departments->execute(array($supplier['department']));
//                    foreach ($departments as $department) {
//                        $sub_data['department'] = $department['department'];
//                    }
//                    $data[] = $sub_data;
//                }
//            }
//            echo json_encode($data);
//        }
//    }
//    public function actionGetDeliveryByDate()
//    {
//        if(isset($_POST['date']))
//        {
//            $date = $_POST['date'];
//            $change_format_date = date_create($date);
//            $change_format_date = date_format($change_format_date, 'Y-m-d');
//            $get_deliveries = new \Application\models\Delivery();
//            $deliveries  = $get_deliveries->get_deliveres_conditionals($change_format_date);
//            $deliveries->execute(array($change_format_date));
//            foreach ($deliveries as $delivery) {
//                $sub_data['address'] = $delivery['address'];
//                $sub_data['date'] = $delivery['date'];
//                $sub_data['time'] = $delivery['time'];
//                $data[] = $sub_data;
//            }
//        echo json_encode($data);
//        }
//    }

//    public function actionGetAllDeliveriesForThisSupplier(){
//        if(isset($_POST['supplier_id'])) {
//            $supplier_id = $_POST['supplier_id'];
//            $get_deliveries = new \Application\models\Delivery();
//            $deliveries = $get_deliveries->get_deliveres_conditionals_supplier_id($supplier_id);
//            $deliveries->execute(array($supplier_id));
//            foreach ($deliveries as $delivery) {
//                $get_suppliers= new \Application\models\Supplier();
//                $suppliers = $get_suppliers->get_supplier_conditionals_supplier_id($delivery['supplier_id']);
//                $suppliers->execute(array($delivery['supplier_id']));
//                foreach ($suppliers as $supplier) {
//                    $sub_data['supplier_id'] = $delivery['supplier_id'];
//                    $sub_data['supplier'] = $supplier['supplier'];
//                    $sub_data['info'] = $supplier['info'];
//                    $sub_data['address'] = $delivery['address'];
//                    $sub_data['city_id'] = $delivery['city_id'];
//                    $sub_data['date'] = $delivery['date'];
//                    $sub_data['time'] = $delivery['time'];
//                    $get_departments= new \Application\models\Department();
//                    $departments = $get_departments->get_department_conditionals_id($supplier['department']);
//                    $departments->execute(array($supplier['department']));
//                    foreach ($departments as $department) {
//                        $sub_data['department'] = $department['department'];
//                    }
//                    $ou[] = $sub_data;
//                }
//            }
//            $output[] = $ou;
//        }
//        echo json_encode($output);
//    }
//    public function actionGetAllDeliveriesForThisCity(){
//        if(isset($_POST['city_id'])) {
//            $city_id = $_POST['city_id'];
//                $get_deliveries = new \Application\models\Delivery();
//                $deliveries = $get_deliveries->get_array_deliveres_conditionals_city_id($city_id);
//                $deliveries->execute(array($city_id));
//                foreach ($deliveries as $delivery) {
//                    $get_suppliers= new \Application\models\Supplier();
//                    $suppliers = $get_suppliers->get_supplier_conditionals_supplier_id($delivery['supplier_id']);
//                    $suppliers->execute(array($delivery['supplier_id']));
//                    foreach ($suppliers as $supplier) {
//                        $sub_data['supplier_id'] = $delivery['supplier_id'];
//                        $sub_data['supplier'] = $supplier['supplier'];
//                        $sub_data['info'] = $supplier['info'];
//                        $sub_data['address'] = $delivery['address'];
//                        $sub_data['city_id'] = $delivery['city_id'];
//                        $sub_data['date'] = $delivery['date'];
//                        $sub_data['time'] = $delivery['time'];
//                        $get_departments= new \Application\models\Department();
//                        $departments = $get_departments->get_department_conditionals_id($supplier['department']);
//                        $departments->execute(array($supplier['department']));
//                        foreach ($departments as $department) {
//                            $sub_data['department'] = $department['department'];
//                        }
//                        $ou[] = $sub_data;
//                    }
//                }
//                $output[] = $ou;
//            }
//            echo json_encode($output);
//    }

    public function actionGetArrayOfProductsPromotion()
    {
        if(isset($_POST['promotion_id']))
        {
            $promotion_id = $_POST['promotion_id'];
            $get_products = new \Application\models\Product();
            $products = $get_products->get_products_and_promotions($promotion_id);
            $products->execute(array($promotion_id));
            foreach ($products as $product) {
                $sub_data['ProductId'] = $product['ProductId'];
                $sub_data['name'] = $product['name'];
                $sub_data['price'] = $product['price'];
                $sub_data['department_id'] = $product['department_id'];
                $sub_data['promotion'] = $product['promotion'];
                $sub_data['PromotionId'] = $product['PromotionId'];
                $sub_data['value_promotion'] = $product['value_promotion'];
                $sub_data['end_date'] = $product['end_date'];
                $sub_data['left_block'] = $product['left_block'];
                $sub_data['title'] = $product['title'];
                $sub_data['type'] = $product['type'];
            }
            $data[] = $sub_data;
            echo json_encode($data);
        }
    }
    public function actionByCityId()
    {
        if(isset($_POST['city_id']))
        {
            $city_id = $_POST['city_id'];
            $get_deliveries = new \Application\models\Delivery();
            $deliveries = $get_deliveries->get_deliveres_conditionals_city_id($city_id);
            $deliveries->execute(array($city_id));
            foreach ($deliveries as $delivery) {
                $sub_data['address'] = $delivery['address'];
                $sub_data['city_id'] = $delivery['city_id'];
                $sub_data['date'] = $delivery['date'];
                $sub_data['time'] = $delivery['time'];
            }
            $data[] = $sub_data;
                echo json_encode($data);
        }
    }

    public function actionDeleteProduct()
    {
        if(isset($_POST['iid']))
        {
            $id = $_POST['iid'];
            $delete_product = new \Application\models\Product();
            $delete_product->delete_product($id);
            echo 1;
        }
    }

    public function actionDeleteAllFromCart()
    {
        if(isset($_POST['ip_address']))
        {
            $ip_address = $_POST['ip_address'];
            $delete_all_from_cart = new \Application\models\Cart();
            $delete_all_from_cart->delete_all_from_cart($ip_address);
            echo 1;
        }
    }
    public function actionDeleteOneFromCart()
    {
        if(isset($_POST['id']))
        {
            $id = $_POST['id'];
            $delete_one_from_cart = new \Application\models\Cart();
            $delete_one_from_cart->delete_one_from_cart($id);
            echo 1;
        }
    }

    public function actionDeletePromotion()
    {
        if(isset($_POST['iid']))
        {
            $id = $_POST['iid'];
            $delete_promotion = new \Application\models\Promotion();
            $delete_promotion->delete_promotion($id);
            echo 1;
        }
    }
//    public function actionDeleteProductFromDiscount()
//    {
//        if(isset($_POST['iid']))
//        {
//            $id = $_POST['iid'];
//            $delete_discount = new \Application\models\Product();
//            $delete_discount->remove_discount($id);
//            $delete_pr_from_discount = new \Application\models\Discount();
//            $delete_pr_from_discount->delete_product_from_discount($id);
//            echo 1;
//        }
//    }
//
//    public function actionInsertDiscountValue()
//    {
//        if(isset($_POST['value_discount']))
//        {
//            $id = $_POST['product_id'];
//            $value_discount = $_POST['value_discount'];
//            $end_date = $_POST['end_date'];
//            $insert_discount = new \Application\models\Discount();
//            $insert_discount->insert_discount_value($id,$value_discount,$end_date);
//            echo 1;
//        }
//    }

    public function actionAddToCart()
    {
        if(isset($_POST['iid']) && isset($_POST['res_ip_address']) && isset($_POST['quantity']) && isset($_POST['price']))
        {
            $product_id = $_POST['iid'];
            $res_ip_address = $_POST['res_ip_address'];
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];
            $real_price = $_POST['real_price'];
            $email = $_POST['email'];
            $check_if_exist_this_product_in_cart = new \Application\models\Cart();
            $result_counts = $check_if_exist_this_product_in_cart->check_if_exist_with_email($product_id,$res_ip_address,$email);
            $result_counts->execute(array($product_id,$res_ip_address,$email));
            foreach($result_counts as $result_count ){
                if($result_count['total'] >0) {
                    $get_product_from_cart = new \Application\models\Cart();
                    $result = $get_product_from_cart->get_product_from_cart($product_id);
                    $result->execute(array($product_id));
                    foreach($result as $res ){
                        $quantity_from_db = $res['quantity'];
                        $price_from_db = $res['price'];
                        $final_quantity = $quantity_from_db+$quantity;
                        $final_qprice = $price_from_db+$price;
                        $update_cart = new \Application\models\Cart();
                        $update_cart->update_cart($product_id, $res_ip_address, $final_quantity,$final_qprice);
                    }
                    echo 1;
                }else {
                    $add_to_cart = new \Application\models\Cart();
                    $add_to_cart->add_to_cart_with_email($product_id, $res_ip_address, $quantity,$price,$real_price,$email);
                    echo 1;
                }
            }
        }
    }
//    public function actionAddToCart()
//    {
//        if(isset($_POST['iid']) && isset($_POST['res_ip_address']) && isset($_POST['quantity']) && isset($_POST['price']))
//        {
//            $product_id = $_POST['iid'];
//            $res_ip_address = $_POST['res_ip_address'];
//            $quantity = $_POST['quantity'];
//            $price = $_POST['price'];
//            $real_price = $_POST['real_price'];
//            $check_if_exist_this_product_in_cart = new \Application\models\Cart();
//            $result_counts = $check_if_exist_this_product_in_cart->check_if_exist($product_id,$res_ip_address);
//            $result_counts->execute(array($product_id,$res_ip_address));
//            foreach($result_counts as $result_count ){
//                if($result_count['total'] >0) {
//                    $get_product_from_cart = new \Application\models\Cart();
//                    $result = $get_product_from_cart->get_product_from_cart($product_id);
//                    $result->execute(array($product_id));
//                    foreach($result as $res ){
//                        $quantity_from_db = $res['quantity'];
//                        $price_from_db = $res['price'];
//                        $final_quantity = $quantity_from_db+$quantity;
//                        $final_qprice = $price_from_db+$price;
//                        $update_cart = new \Application\models\Cart();
//                        $update_cart->update_cart($product_id, $res_ip_address, $final_quantity,$final_qprice);
//                    }
//                    echo 1;
//                }else {
//                    $add_to_cart = new \Application\models\Cart();
//                    $add_to_cart->add_to_cart($product_id, $res_ip_address, $quantity,$price,$real_price);
//                    echo 1;
//                }
//            }
//        }
//    }

//    public function actionInsertPromotionValue()
//    {
//        if(isset($_POST['value_promotion']))
//        {
//            $id = $_POST['product_id'];
//            $value_promotion = $_POST['value_promotion'];
//            $end_date = $_POST['end_date'];
//            $insert_promotion = new \Application\models\Promotion();
//            $insert_promotion->insert_promotion_value($id,$value_promotion,$end_date);
//            echo 1;
//        }
//    }
//    public function actionInsertSpecialOfferValue()
//    {
//        if(isset($_POST['value_special_offer']))
//        {
//            $id = $_POST['product_id'];
//            $value_special_offer = $_POST['value_special_offer'];
//            $end_date = $_POST['end_date'];
//            $insert_special_offer = new \Application\models\SpecialOffer();
//            $insert_special_offer->insert_special_offer_value($id,$value_special_offer,$end_date);
//            echo 1;
//        }
//    }
//    public function actionUpdateDiscountValue()
//    {
//        if(isset($_POST['value_discount']))
//        {
//            $id = $_POST['product_id'];
//            $value_discount = $_POST['value_discount'];
//            $update_discount = new \Application\models\Discount();
//            $update_discount->update_discount_value($id,$value_discount);
//            echo 1;
//        }
//    }
//    public function actionUpdateDiscountEndDateValue()
//    {
//        if(isset($_POST['end_date']))
//        {
//            $id = $_POST['product_id'];
//            $end_date = $_POST['end_date'];
//            $newDate = date("Y-m-d H:i:s", strtotime($end_date));
//            $update_discount = new \Application\models\Discount();
//            $update_discount->update_discount_end_date_value($id,trim($newDate));
//            echo $newDate;
//        }
//    }
//    public function actionUpdatePromotionEndDateValue()
//    {
//        if(isset($_POST['end_date']))
//        {
//            $id = $_POST['product_id'];
//            $end_date = $_POST['end_date'];
//            $newDate = date("Y-m-d H:i:s", strtotime($end_date));
//            $update_promotion = new \Application\models\Promotion();
//            $update_promotion->update_promotion_end_date_value($id,trim($newDate));
//            echo 1;
//        }
//    }
//    public function actionUpdateSpecialOfferEndDateValue()
//    {
//        if(isset($_POST['end_date']))
//        {
//            $id = $_POST['product_id'];
//            $end_date = $_POST['end_date'];
//            $newDate = date("Y-m-d H:i:s", strtotime($end_date));
//            $update_special_offer = new \Application\models\SpecialOffer();
//            $update_special_offer->update_special_offer_end_date_value($id,trim($newDate));
//            echo 1;
//        }
//    }

//    public function actionUpdatePromotionValue()
//    {
//        if(isset($_POST['description']))
//        {
//            $id = $_POST['id'];
//            $description = $_POST['description'];
//            $left_block = $_POST['left_block'];
//            $title = $_POST['title'];
//            $type = $_POST['type'];
//            $end_date = $_POST['end_date'];
//            $update_promotion = new \Application\models\Promotion();
//            $update_promotion->update_promotion_value($id,$description,$left_block,$title,$type,$end_date);
//            echo 1;
//        }
//    }

//    public function actionUpdateSpecialOfferValue()
//    {
//        if(isset($_POST['value_special_offer']))
//        {
//            $id = $_POST['product_id'];
//            $value_special_offer = $_POST['value_special_offer'];
//            $update_special_offer = new \Application\models\SpecialOffer();
//            $update_special_offer->update_special_offer_value($id,$value_special_offer);
//            echo 1;
//        }
//    }

//    public function actionDeleteSmImgPreview()
//    {
//        if(isset($_POST['id']))
//        {
//            $id = trim($_POST['id']);
//            $delete_photo = new \Application\models\SmallImages();
//            $delete_photo->delete_small_images_preview($id);
//            echo 1;
//        }
//    }

    public function actionInsertRating()
    {
        if(isset($_POST['product_id']) && isset($_POST['rate'])) {
            $product_id = $_POST['product_id'];
            $rate = $_POST['rate'];
            $ip_address = $_POST['ip_address'];
            $new_rating = new \Application\models\Rating();
            $new_rating->insert_new_rating($product_id,$rate,$ip_address);
            echo 1;
        }
    }
    public function actionFetch()
    {
        if(isset($_POST['product_id'])) {
            $product_id = $_POST['product_id'];
            $all_products = new \Application\models\Rating();
            $res_all_products = $all_products->get_rating_by_product_id($product_id);
            $res_all_products->execute(array($product_id));
            foreach ($res_all_products as $row) {}
                $total_ratings = new \Application\models\Rating();
                $res_total_ratings = $total_ratings->get_total_rating($product_id);
                $res_total_ratings->execute(array($product_id));
                foreach ($res_total_ratings as $res_total_rating) {}
                    $rating = $res_total_rating['total'];
                    echo $rating;
        }
    }
//    public function actionDeleteSmImgAdded()
//    {
//        if(isset($_POST['id']))
//        {
//            $id = trim($_POST['id']);
//            $delete_photo = new \Application\models\SmallImages();
//            $delete_photo->delete_small_images_added($id);
//            echo 1;
//        }
//    }
    public function actionInsertNewUser()
    {
        if(NULL!=($_POST['name']))
        {
            $name = $_POST['name'];
            $password =$_POST['password'];
            $lastname = $_POST['lastname'];
            $patronymic = $_POST['patronymic'];
            $birth_day = $_POST['bday'];
            $email = $_POST['email'];
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $users = new \Application\models\Users();
            $users->insert_register_user($name,$password,$lastname,$patronymic,$birth_day,$email,$ip_address);
            echo 1;
        }

    }
}

