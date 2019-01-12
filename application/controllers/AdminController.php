<?php
namespace Application\controllers;
use Application\models\Workers;
use Application\models\Schedule;
use Application\models\Region;
use Application\models\Uploader;

class AdminController
{
	public function actionIndex()
	{
        session_start();
        require_once(ROOT . '/application/views/admin/head.php');
    	require_once(ROOT . '/application/views/admin/index.php');
        require_once(ROOT . '/application/views/admin/footer.php');
	}

    public function actionAbout()
    {
        session_start();
        require_once(ROOT . '/application/views/admin/head.php');
        require_once(ROOT . '/application/views/admin/about.php');
        require_once(ROOT . '/application/views/admin/footer.php');
    }

    public function actionOrders()
    {
        session_start();
        require_once(ROOT . '/application/views/admin/head.php');
        require_once(ROOT . '/application/views/admin/orders.php');
        require_once(ROOT . '/application/views/admin/footer.php');
    }

    public function actionviewOrder()
    {
        session_start();
        require_once(ROOT . '/application/views/admin/head.php');
        require_once(ROOT . '/application/views/admin/viewOrder.php');
        require_once(ROOT . '/application/views/admin/footer.php');
    }

    public function actionclients()
    {
        session_start();
        require_once(ROOT . '/application/views/admin/head.php');
        require_once(ROOT . '/application/views/admin/clients.php');
        require_once(ROOT . '/application/views/admin/footer.php');
    }

    public function actionNewsOfCompany()
    {
        session_start();
        require_once(ROOT . '/application/views/admin/head.php');
        require_once(ROOT . '/application/views/admin/news_of_company.php');
        require_once(ROOT . '/application/views/admin/footer.php');
    }

    public function actionallDepartments()
    {
        session_start();
        require_once(ROOT . '/application/views/admin/head.php');
        require_once(ROOT . '/application/views/admin/all_departments.php');
        require_once(ROOT . '/application/views/admin/footer.php');
    }

    public function actionReviews()
    {
        session_start();
        require_once(ROOT . '/application/views/admin/head.php');
        require_once(ROOT . '/application/views/admin/reviews.php');
        require_once(ROOT . '/application/views/admin/footer.php');
    }

    public function actionDelivery()
    {
        session_start();
        require_once(ROOT . '/application/views/admin/head.php');
        require_once(ROOT . '/application/views/admin/delivery.php');
        require_once(ROOT . '/application/views/admin/footer.php');
    }

    public function actionNews()
    {
        session_start();
        require_once(ROOT . '/application/views/admin/head.php');
        require_once(ROOT . '/application/views/admin/news.php');
        require_once(ROOT . '/application/views/admin/footer.php');
    }

    public function actionPopular()
    {
        session_start();
        require_once(ROOT . '/application/views/admin/head.php');
        require_once(ROOT . '/application/views/admin/popular.php');
        require_once(ROOT . '/application/views/admin/footer.php');
    }

    public function actionBeOver()
    {
        session_start();
        require_once(ROOT . '/application/views/admin/head.php');
        require_once(ROOT . '/application/views/admin/be_over.php');
        require_once(ROOT . '/application/views/admin/footer.php');
    }

    public function actionadminka()
    {
        session_start();
        require_once(ROOT . '/application/views/admin/head.php');
        require_once(ROOT . '/application/views/admin/adminka.php');
        require_once(ROOT . '/application/views/admin/footer.php');
    }

    public function actionAdministrators()
    {
        session_start();
        require_once(ROOT . '/application/views/admin/head.php');
        require_once(ROOT . '/application/views/admin/administrators.php');
        require_once(ROOT . '/application/views/admin/footer.php');
    }

    public function actionAddAdministrators()
    {
        session_start();
        if (isset($_POST["submit_add"]))
        {
            if(isset($_POST['view_orders'])){
                $view_orders = '1';
            }else{
                $view_orders = '0';
            }
            if(isset($_POST['accept_orders'])){
                $accept_orders = '1';
            }else{
                $accept_orders = '0';
            }
            if(isset($_POST['delete_orders'])){
                $delete_orders = '1';
            }else{
                $delete_orders = '0';
            }
            if(isset($_POST['add_tovar'])){
                $add_tovar = '1';
            }else{
                $add_tovar = '0';
            }
            if(isset($_POST['edit_tovar'])){
                $edit_tovar = '1';
            }else{
                $edit_tovar = '0';
            }
            if(isset($_POST['delete_tovar'])){
                $delete_tovar = '1';
            }else{
                $delete_tovar = '0';
            }
            if(isset($_POST['accept_reviews'])){
                $accept_reviews = '1';
            }else{
                $accept_reviews = '0';
            }
            if(isset($_POST['delete_reviews'])){
                $delete_reviews = '1';
            }else{
                $delete_reviews = '0';
            }
            if(isset($_POST['view_clients'])){
                $view_clients = '1';
            }else{
                $view_clients = '0';
            }
            if(isset($_POST['delete_clients'])){
                $delete_clients = '1';
            }else{
                $delete_clients = '0';
            }
            if(isset($_POST['add_news'])){
                $add_news = '1';
            }else{
                $add_news = '0';
            }
            if(isset($_POST['delete_news'])){
                $delete_news = '1';
            }else{
                $delete_news = '0';
            }
            if(isset($_POST['add_category'])){
                $add_category = '1';
            }else{
                $add_category = '0';
            }
            if(isset($_POST['delete_category'])){
                $delete_category = '1';
            }else{
                $delete_category = '0';
            }
            if(isset($_POST['add_worker'])){
                $add_worker = '1';
            }else{
                $add_worker = '0';
            }
            if(isset($_POST['edit_worker'])){
                $edit_worker = '1';
            }else{
                $edit_worker = '0';
            }
            if(isset($_POST['delete_worker'])){
                $delete_worker = '1';
            }else{
                $delete_worker = '0';
            }
            if(isset($_POST['add_delivery'])){
                $add_delivery = '1';
            }else{
                $add_delivery = '0';
            }
            if(isset($_POST['edit_delivery'])){
                $edit_delivery = '1';
            }else{
                $edit_delivery = '0';
            }
            if(isset($_POST['delete_delivery'])){
                $delete_delivery = '1';
            }else{
                $delete_delivery = '0';
            }
            if(isset($_POST['view_admin'])){
                $view_admin = '1';
            }else{
                $view_admin = '0';
            }
            if(isset($_POST['admin_login'])){
                $admin_login = $_POST['admin_login'];
            }else{
                $admin_login = '';
            }
            if(isset($_POST['admin_pass'])){
                $admin_pass = $_POST['admin_pass'];
            }else{
                $admin_pass = '';
            }
            if(isset($_POST['admin_fio'])){
                $admin_fio = $_POST['admin_fio'];
            }else{
                $admin_fio = '';
            }
            if(isset($_POST['admin_role'])){
                $admin_role = $_POST['admin_role'];
            }else{
                $admin_role = '';
            }
            if(isset($_POST['admin_email'])){
                $admin_email = $_POST['admin_email'];
            }else{
                $admin_email = '';
            }
            if(isset($_POST['admin_phone'])){
                $admin_phone = $_POST['admin_phone'];
            }else{
                $admin_phone = '';
            }
            $insert_new_administrator = new \Application\models\Administrators();
            $insert_new_administrator->insert_new_administrator($view_orders,$accept_orders,$delete_orders,$add_tovar,$edit_tovar,$delete_tovar,$accept_reviews,$delete_reviews,$view_clients,$delete_clients,$add_news,$delete_news,$add_category,$delete_category,$add_worker,$edit_worker,$delete_worker,$add_delivery,$edit_delivery,$delete_delivery,$view_admin,$admin_login,$admin_pass,$admin_fio,$admin_role,$admin_email,$admin_phone);
            echo 1;
        }
        require_once(ROOT . '/application/views/admin/head.php');
        require_once(ROOT . '/application/views/admin/add-administrators.php');
        require_once(ROOT . '/application/views/admin/footer.php');
    }

    public function actionLogout()
    {
        session_start();
        session_unset();
        $_SESSION = array();
        session_destroy();
        header('Location: /admin/index');
    }

    public function actiondeleteClient()
    {
        if (NULL !=($_POST['client_id'])) {
            $client_id = ($_POST['client_id']);
            $del_client = new \Application\models\Users();
            $del_client->del_of_client($client_id);
            echo 1;
        }
    }

    public function actionDeleteReview()
    {
        if (NULL !=($_POST['review_id'])) {
            $review_id = ($_POST['review_id']);
            $del_review = new \Application\models\Review();
            $del_review->del_of_review($review_id);
            echo 1;
        }
    }

    public function actionDeleteDepartmentAdmin()
    {
        if (NULL !=($_POST['iid'])) {
            $iid = ($_POST['iid']);
            $del_department = new \Application\models\Department();
            $del_department->del_of_department($iid);
            echo 1;
        }
    }

    public function actiondeleteOrderAdmin()
    {
        if (NULL !=($_POST['order_id'])) {
            $order_id= ($_POST['order_id']);
            $del_order = new \Application\models\Orders();
            $del_order->del_of_order($order_id);
            echo 1;
        }
    }

    public function actionacceptOrderAdmin()
    {
        if (NULL !=($_POST['order_id'])) {
            $order_id = $_POST['order_id'];
            $accept_order = new \Application\models\Orders();
            $check_accept_order = $accept_order->accept_order($order_id);
            echo 1;
        }
    }

    public function actionacceptReview()
    {
        if (NULL !=($_POST['review_id'])) {
            $review_id = ($_POST['review_id']);
            $accept_review = new \Application\models\Review();
            $check_accept_review = $accept_review->accept_review($review_id);
            $check_accept_review->execute(array($review_id));
            echo 1;
        }
    }

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
        if (isset($_POST['login']) && isset($_POST['password'])) {
            session_unset();
            $login = trim($_POST['login']);
            $password = trim($_POST['password']);
            $check_correct_admin_data = new \Application\models\Administrators();
            $res_check_correct_admin_data = $check_correct_admin_data->check_admin($login,$password);
            $res_check_correct_admin_data->execute(array($login,$password));
            $count = $res_check_correct_admin_data->fetchColumn();
            if ($count > 0) {
                $get_admin = new \Application\models\Administrators();
                $res_get_admin = $get_admin->check_admin_data($login);
                $res_get_admin->execute(array($login));
                foreach($res_get_admin as $result_get_admin) {
                    $id = $result_get_admin['id'];
                    $login = $result_get_admin['admin_login'];
                    $role = $result_get_admin['admin_role'];
                    session_start();
                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION['admin'] = 'admin';
                    $_SESSION["admin_login"] = $login;
                    $_SESSION["admin_role"] = $role;
                    $_SESSION["name"] = $role;
                }
                echo 1;
            }else{
                echo '2';
            }
        }
    }

    public function actionSpecialOffers()
    {
        session_start();
        require_once(ROOT . '/application/views/admin/head.php');
        require_once(ROOT . '/application/views/admin/special_offers.php');
        require_once(ROOT . '/application/views/admin/footer.php');

    }
    public function actionDiscount()
    {
        session_start();
        require_once(ROOT . '/application/views/admin/head.php');
        require_once(ROOT . '/application/views/admin/discount.php');
        require_once(ROOT . '/application/views/admin/footer.php');

    }
    public function actionPromotion()
    {
        session_start();
        require_once(ROOT . '/application/views/admin/head.php');
        require_once(ROOT . '/application/views/admin/promotion.php');
        require_once(ROOT . '/application/views/admin/footer.php');

    }
    public function actionProducts()
    {
        session_start();
        require_once(ROOT . '/application/views/admin/head.php');
        require_once(ROOT . '/application/views/admin/products.php');
        require_once(ROOT . '/application/views/admin/footer.php');

    }

    public function actionGetDelivery()
    {
        $get_deliveries = new \Application\models\Delivery();
        $deliveries  = $get_deliveries->get_deliveres();
        foreach ($deliveries as $delivery) {
            $sub_data['address'] = $delivery['address'];
            $date = $delivery['date'];
            $change_format_date = date_create($date);
            $change_format_date = date_format($change_format_date, 'm/d/Y');
            $sub_data['date'] = $change_format_date;
            $sub_data['time'] = $delivery['time'];
            $data[] = $sub_data;
        }
        echo json_encode($data);
    }

    public function actionAddNewReview()
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

    public function actionUpdateAboutCompany()
    {
        if (isset($_POST['title']) && isset($_POST['content'])) {
            $title = ($_POST['title']);
            $content = ($_POST['content']);
            $about_company = new \Application\models\About();
            $res_about_company= $about_company->update_about_company($title,$content);
            echo 1;
        }
    }
    public function actionUpdateSelectedPromotionsCheckboxes()
    {
        if (NULL !=($_POST['selected_checkboxes'])) {
            $selected_checkboxes = $_POST['selected_checkboxes'];
            $promotion_id = $_POST['promotion_id'];
            $products = new \Application\models\Product();
            $res_products= $products->update_checkboxes_promotions($selected_checkboxes,$promotion_id);
        }
    }
    public function actionGetProductsByDepartmentId()
    {
        if (NULL !=($_POST['department_id'])) {
            $department_id = $_POST['department_id'];
            $products = new \Application\models\Product();
            $res_products= $products->get_products_by_department_id($department_id);
            $res_products->execute(array($department_id));
            foreach ($res_products as $res) {
                $sub_data['id'] = $res['id'];
                $sub_data['name'] = $res['name'];
                $sub_data['department_id'] = $res['department_id'];
                $sub_data['price'] = $res['price'];
                $sub_data['photo'] = $res['photo'];
                $sub_data['quantity'] = $res['quantity'];
                $sub_data['brand'] = $res['brand'];
                $sub_data['colour'] = $res['colour'];
                $sub_data['promotion'] = $res['promotion'];
                $data[] = $sub_data;
            }
            echo json_encode($data);
        }
    }

    public function actionGetAllPromotions()
    {
        $info_promotion= new \Application\models\Promotion();
        $res_info_promotion= $info_promotion->get_promotions();
        foreach ($res_info_promotion as $res) {
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

    public function actionGetDepartmentName()
    {
        if (NULL !=($_POST['department_id'])) {
            $department_id = $_POST['department_id'];
            $department_by_id = new \Application\models\Department();
            $res_department_by_id= $department_by_id->get_deparment_by_id($department_id);
            $res_department_by_id->execute(array($department_id));
            foreach ($res_department_by_id as $res) {
                $sub_data['id'] = $res['id'];
                $sub_data['department'] = $res['department'];
                $sub_data['parent_id'] = $res['parent_id'];
                $data[] = $sub_data;
            }
            echo json_encode($data);
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
    public function actionGetSmallImagesEditAdmin()
    {
        if (NULL !=($_POST['product_id'])) {
            $id = $_POST['product_id'];
            $small_images_by_id = new \Application\models\SmallImages();
            $res_small_images_by_id= $small_images_by_id->get_small_image_by_id($id);
            $res_small_images_by_id->execute(array($id));
            foreach ($res_small_images_by_id as $res) {
                $sub_data['small_images']= $res['name'];
                $sub_data['small_id']= $res['id'];
                $sub_data['product_id'] = $res['product_id'];
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
                $sub_data['id'] = $res_info_product['productId'];
                $sub_data['name'] = $res_info_product['name'];
                $sub_data['photo'] = $res_info_product['photo'];
                $sub_data['brand'] = $res_info_product['brand'];
                $sub_data['department_id'] = $res_info_product['department_id'];
                $sub_data['colour'] = $res_info_product['colour'];
                $sub_data['price'] = $res_info_product['price'];
                $sub_data['big_description'] = $res_info_product['big_description'];
                $sub_data['adding_info'] = $res_info_product['adding_info'];
                $sub_data['quantity'] = $res_info_product['quantity'];
                $sub_data['discount'] = $res_info_product['discount'];
                $sub_data['new_product'] = $res_info_product['new_product'];
                $sub_data['popular'] = $res_info_product['popular'];
                $sub_data['promotion'] = $res_info_product['promotion'];
                $sub_data['special_offer'] = $res_info_product['special_offer'];
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

    public function actionInsertNewProduct()
    {
        if (NULL!=($_POST['name'])) {
            $name = $_POST['name'];
            $discount = $_POST['discount'];
            $new_product = $_POST['new_product'];
            $promotion = $_POST['value_promotion'];
            $special_offer = $_POST['special_offer'];
            $colour = $_POST['colour'];
            $brand = $_POST['brand'];
            $popular = $_POST['popular'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $big_description = ($_POST['big_description']);
            $adding_info = ($_POST['adding_info']);
            $department_id = $_POST['department_id'];
            $photo = trim($_POST['photo']);
            $update_products = new \Application\models\Product();
            $res = $update_products->insert_new_product($name,$department_id,$price,$discount,$popular,$new_product,$special_offer,$promotion,$photo,$quantity,$big_description,$adding_info,$brand,$colour);
            $lastInsertedId=\Application\core\App::$app->lastInsertId();
            if($discount == 1){
                $value_discount = $_POST['value_discount'];
                $end_date_discount = $_POST['end_date_discount'];
                $newDate = date("Y-m-d H:s:i", strtotime($end_date_discount));
                $insert_new_discount = new \Application\models\Discount();
                $res_insert_new_discount = $insert_new_discount->insert_discount_value($lastInsertedId,$value_discount,trim($newDate));
            }
            if($special_offer == 1){
                $end_date_special_offer = $_POST['end_date_special_offer'];
                $newDate = date("Y-m-d H:s:i", strtotime($end_date_special_offer));
                $insert_new_special_offer = new \Application\models\SpecialOffer();
                $res_insert_new_special_offer = $insert_new_special_offer->insert_special_offer_value($lastInsertedId,trim($newDate));
            }
            echo 1;
        }

    }

    public function actionUpSmImg()
    {
        if(isset($_GET['department_id_from_url'])) {
            /* Getting file name */
            $filename = $_FILES['file']['name'];
            /* Location */
            $location = "C:/OpenServer/domains/localhost/application/photo/small_images/".$_GET['department_id_from_url']."/" . $filename;
            $uploadOk = 1;
            $imageFileType = pathinfo($location, PATHINFO_EXTENSION);

            /* Valid Extensions */
            $valid_extensions = array("jpg", "jpeg", "png");
            /* Check file extension */
            if (!in_array(strtolower($imageFileType), $valid_extensions)) {
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                echo 0;
            } else {
                /* Upload file */
                if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                    echo $filename;

                } else {
                    echo 0;
                }
            }
        }
    }

    public function actionUploadImageNews()
    {
        /* Getting file name */
        $filename = $_FILES['file']['name'];
        /* Location */
        $location = "C:/OpenServer/domains/localhost/application/photo/news/".$filename;
        $uploadOk = 1;
        $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
        /* Valid Extensions */
        $valid_extensions = array("jpg","jpeg","png");
        /* Check file extension */
        if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
            $uploadOk = 0;
        }
        if($uploadOk == 0){
            echo 0;
        }else{
            /* Upload file */
            if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                echo $filename;

            }else{
                // echo 0;
            }
        }
    }

    public function actionUploadImageDepartment()
    {
        /* Getting file name */
        $filename = $_FILES['file']['name'];
        /* Location */
        $location = "C:/OpenServer/domains/localhost/application/photo/department/" . $filename;
        $uploadOk = 1;
        $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
        /* Valid Extensions */
        $valid_extensions = array("jpg", "jpeg", "png");
        /* Check file extension */
        if (!in_array(strtolower($imageFileType), $valid_extensions)) {
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo 0;
        } else {
            /* Upload file */
            if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                echo $filename;
            } else {
                // echo 0;
            }
        }
    }

    public function actionUploadSmallImages()
    {
        /* Getting file name */
        $filename = $_FILES['file']['name'];
        /* Location */
        $location = "C:/OpenServer/domains/localhost/application/photo/phone/small_images/".$filename;
        $uploadOk = 1;
        $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
        /* Valid Extensions */
        $valid_extensions = array("jpg","jpeg","png");
        /* Check file extension */
        if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
            $uploadOk = 0;
        }
        if($uploadOk == 0){
            echo 0;
        }else{
            /* Upload file */
            if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                echo $filename;
            }else{
               // echo 0;
            }
        }
    }

    public function actionUpload()
    {
        /* Getting file name */
        if (isset($_GET['department_id_from_url'])) {
            $filename = $_FILES['file']['name'];
            /* Location */
            $location = "C:/OpenServer/domains/localhost/application/photo/".$_GET['department_id_from_url']."/" . $filename;
            $uploadOk = 1;
            $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
            /* Valid Extensions */
            $valid_extensions = array("jpg", "jpeg", "png");
            /* Check file extension */
            if (!in_array(strtolower($imageFileType), $valid_extensions)) {
                $uploadOk = 0;
                echo 0;
            }
            if ($uploadOk == 0) {
                echo 0;
            } else {
                /* Upload file */
                if (move_uploaded_file($_FILES['file']['tmp_name'], $location)) {
                    echo $filename;
                } else {
                    echo 0;
                }
            }
        }
    }

    public function actionInsertPhotoDepartmentAdmin()
    {
        if (NULL !=($_POST['photo'])) {
            $photo = $_POST['photo'];
            $insert_main_photo = new \Application\models\Department();
            $res  = $insert_main_photo->insert_photo($photo);
            $stmt=\Application\core\App::$app->lastInsertId();
            echo $stmt;
        }
    }

    public function actionInsertPhotoNewsAdmin()
    {
        if (NULL !=($_POST['photo'])) {
            $photo = $_POST['photo'];
            $insert_main_photo = new \Application\models\News();
            $res  = $insert_main_photo->insert_photo($photo);
            $stmt=\Application\core\App::$app->lastInsertId();
            echo $stmt;
        }
    }

    public function actionInsertDepartmentAdminWithoutPhoto()
    {
        if (NULL !=($_POST['department']) && NULL != ($_POST['department_id'])) {
            $department = $_POST['department'];
            $parent_id = $_POST['department_id'];
            $insert_department_new = new \Application\models\Product();
            $res  = $insert_department_new->insert_department($department,$parent_id);
            echo 1;
        }
    }

    public function actionUpdateNewsAdminWithoutPhoto()
    {
        if (NULL !=($_POST['title']) && NULL != ($_POST['content'])&& NULL != ($_POST['new_id'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $new_id = $_POST['new_id'];
            $insert_new = new \Application\models\News();
            $insert_new->update_new($title,$new_id,$content);
            echo trim(1);
        }
    }

    public function actionUpdateDepartmentAdmin()
    {
        if (NULL !=($_POST['department']) && NULL !=($_POST['department_id'])) {
            $department = $_POST['department'];
            $id = $_POST['department_id'];
            $parent_id = $_POST['parent_id'];
            $update_department_name = new \Application\models\Department();
            $res  = $update_department_name->update_department_name($department,$id,$parent_id);
            echo 1;
        }
    }

    public function actionUpdateNewsAdmin()
    {
        if (NULL !=($_POST['title']) && NULL !=($_POST['new_id'])&& NULL !=($_POST['content'])) {
            $title= $_POST['title'];
            $id = $_POST['new_id'];
            $content = $_POST['content'];
            $update_new = new \Application\models\News();
            $res  = $update_new->update_new($title,$id,$content);
            echo 1;
        }
    }

    public function actionUpdatePhotoNewsAdmin()
    {
        if (NULL !=($_POST['photo']) && NULL !=($_POST['new_id'])) {
            $photo = $_POST['photo'];
            $id = $_POST['new_id'];
            $update_main_photo = new \Application\models\News();
            $res  = $update_main_photo->update_photo($photo,$id);
            echo 1;
        }
    }

    public function actionUpdatePhotoDepartmentAdmin()
    {
        if (NULL !=($_POST['photo']) && NULL !=($_POST['department_id'])) {
            $photo = $_POST['photo'];
            $id = $_POST['department_id'];
            $update_main_photo = new \Application\models\Department();
            $res  = $update_main_photo->update_photo($photo,$id);
            echo 1;
        }
    }

    public function actionCheckIfExistThisProduct()
    {
        if (NULL !=($_POST['product_name'])) {
            $product_name = trim($_POST['product_name']);
            $check_if_exist = new \Application\models\Product();
            $res  = $check_if_exist->check_if_exist_product($product_name);
            $res->execute(array($product_name));
            $count = $res->rowCount();
                echo trim($count);
        }
    }

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

    public function actionUpdateProduct()
    {
        if (isset($_POST['name']) ) {
            $name = ($_POST['name']);
            $discount = $_POST['discount'];
            $new_product = $_POST['new_product'];
            $promotion = $_POST['promotion'];
            $popular = $_POST['popular'];
            $special_offer = $_POST['special_offer'];
            $colour = $_POST['colour'];
            $brand = $_POST['brand'];
            $iid = $_POST['iid'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $description = $_POST['big_description'];
            $adding_info = $_POST['adding_info'];
             $update_products = new \Application\models\Product();
            $res_update_products = $update_products->update_product($iid,$name,$price,$colour,$brand,$quantity,$description,$adding_info,$discount,$new_product,$promotion,$special_offer,$popular);
            echo 1;
        }
    }

    public function actionInsertSmallPhoto()
    {
        if (isset($_POST['photo'])) {
            $photo = $_POST['photo'];
            $product_id = $_POST['product_id'];
            $insert_small_photo = new \Application\models\SmallImages();
            $res  = $insert_small_photo->insert_photo($photo,$product_id);
            $stmt=\Application\core\App::$app->lastInsertId();
            echo trim($stmt);
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

    public function actionGetDepartmentId()
    {
        if (NULL !=($_POST['department'])) {
            $department = $_POST['department'];
            $search_department = new \Application\models\Department();
            $departments  = $search_department->get_department_id($department);
            echo 1;
        }
    }

    public function actionAddNewDelivery()
    {
        if (NULL !=($_POST['city_id'])) {
            $address = $_POST['address'];
            $date = strip_tags($_POST['date']);
            $date = date_create($date);
            $date = date_format($date, 'Y-m-d H:s:i');
            $time = $_POST['time'];
            $city_id = $_POST['city_id'];
            $supplier_id = $_POST['supplier_id'];
            $new_delivery = new \Application\models\Delivery();
            $new_delivery->insert_delivery($address,$date,$time,$city_id,$supplier_id);
            echo 1;
        }
    }

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

    public function actionUpdateDelivery()
    {
        if(isset($_POST['supplier_id']) && isset($_POST['city_id']) && isset($_POST['address']) && isset($_POST['date'])&& isset($_POST['time'])&& isset($_POST['info'])&& isset($_POST['department'])) {
            $supplier_id = $_POST['supplier_id'];
            $supplier = $_POST['supplier'];
            $city_id = $_POST['city_id'];
            $address = $_POST['address'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            $delivery = new \Application\models\Delivery();
            $search_delivery = $delivery->get_deliveres_conditionals_supplier($supplier);
            $search_delivery->execute(array($supplier));
            $count = $search_delivery->rowCount();
            if ($count > 0) {
                echo 'count';
            } else {
            $deliveries = new \Application\models\Delivery();
            $update_delivery = $deliveries->update_worker($supplier_id, $city_id, $address, $date, $time);
            echo 1;
            }
        }
    }

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

    public function actionGetInfoAboutDelivery()
    {
        if(isset($_POST['date']) && isset($_POST['time']) && isset($_POST['city_id']) )
        {
            $date = $_POST['date'];
            $time = $_POST['time'];
            $city_id = $_POST['city_id'];
            $change_format_date = date_create($date);
            $change_format_date = date_format($change_format_date, 'Y-m-d');
            $get_deliveries = new \Application\models\Delivery();
            $deliveries  = $get_deliveries->get_deliveres_date_city_id_time($time,$change_format_date,$city_id);
            $deliveries->execute(array($time,$change_format_date,$city_id));
            foreach ($deliveries as $delivery) {
                $get_suppliers= new \Application\models\Supplier();
                $suppliers = $get_suppliers->get_supplier_conditionals_supplier_id($delivery['supplier_id']);
                $suppliers->execute(array($delivery['supplier_id']));
                foreach ($suppliers as $supplier) {
                    $sub_data['address'] = $delivery['address'];
                    $sub_data['date'] = $delivery['date'];
                    $sub_data['time'] = $delivery['time'];
                    $sub_data['supplier_id'] = $delivery['supplier_id'];
                    $sub_data['supplier'] = $supplier['supplier'];
                    $sub_data['info'] = $supplier['info'];
                    $get_departments= new \Application\models\Department();
                    $departments = $get_departments->get_department_conditionals_id($supplier['department']);
                    $departments->execute(array($supplier['department']));
                    foreach ($departments as $department) {
                        $sub_data['department'] = $department['department'];
                    }
                    $data[] = $sub_data;
                }
            }
            echo json_encode($data);
        }
    }

    public function actionGetDeliveryByDate()
    {
        if(isset($_POST['date']))
        {
            $date = $_POST['date'];
            $change_format_date = date_create($date);
            $change_format_date = date_format($change_format_date, 'Y-m-d');
            $get_deliveries = new \Application\models\Delivery();
            $deliveries  = $get_deliveries->get_deliveres_conditionals($change_format_date);
            $deliveries->execute(array($change_format_date));
            foreach ($deliveries as $delivery) {
                $sub_data['address'][] = $delivery['address'];
                $sub_data['date'][] = $delivery['date'];
                $sub_data['time'][] = $delivery['time'];
                $data[] = $sub_data;
            }
        echo json_encode($data);
        }
    }

    public function actionGetAllDeliveriesForThisSupplier()
    {
        if(isset($_POST['supplier_id'])) {
            $supplier_id = $_POST['supplier_id'];
            $get_deliveries = new \Application\models\Delivery();
            $deliveries = $get_deliveries->get_deliveres_conditionals_supplier_id($supplier_id);
            $deliveries->execute(array($supplier_id));
            foreach ($deliveries as $delivery) {
                $get_suppliers= new \Application\models\Supplier();
                $suppliers = $get_suppliers->get_supplier_conditionals_supplier_id($delivery['supplier_id']);
                $suppliers->execute(array($delivery['supplier_id']));
                foreach ($suppliers as $supplier) {
                    $sub_data['supplier_id'] = $delivery['supplier_id'];
                    $sub_data['supplier'] = $supplier['supplier'];
                    $sub_data['info'] = $supplier['info'];
                    $sub_data['address'] = $delivery['address'];
                    $sub_data['city_id'] = $delivery['city_id'];
                    $sub_data['date'] = $delivery['date'];
                    $sub_data['time'] = $delivery['time'];
                    $get_departments= new \Application\models\Department();
                    $departments = $get_departments->get_department_conditionals_id($supplier['department']);
                    $departments->execute(array($supplier['department']));
                    foreach ($departments as $department) {
                        $sub_data['department'] = $department['department'];
                    }
                    $ou[] = $sub_data;
                }
            }
            $output[] = $ou;
        }
        echo json_encode($output);
    }

    public function actionGetAllDeliveriesForThisCity()
    {
        if(isset($_POST['city_id'])) {
            $city_id = $_POST['city_id'];
            $get_deliveries = new \Application\models\Delivery();
            $deliveries = $get_deliveries->get_array_deliveres_conditionals_city_id($city_id);
            $deliveries->execute(array($city_id));
            foreach ($deliveries as $delivery) {
                $get_suppliers= new \Application\models\Supplier();
                $suppliers = $get_suppliers->get_supplier_conditionals_supplier_id($delivery['supplier_id']);
                $suppliers->execute(array($delivery['supplier_id']));
                foreach ($suppliers as $supplier) {
                    $sub_data['supplier_id'] = $delivery['supplier_id'];
                    $sub_data['supplier'] = $supplier['supplier'];
                    $sub_data['info'] = $supplier['info'];
                    $sub_data['address'] = $delivery['address'];
                    $sub_data['city_id'] = $delivery['city_id'];
                    $sub_data['date'] = $delivery['date'];
                    $sub_data['time'] = $delivery['time'];
                    $get_departments= new \Application\models\Department();
                    $departments = $get_departments->get_department_conditionals_id($supplier['department']);
                    $departments->execute(array($supplier['department']));
                    foreach ($departments as $department) {
                        $sub_data['department'] = $department['department'];
                    }
                    $ou[] = $sub_data;
                }
            }
            $output[] = $ou;
        }
        echo json_encode($output);
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
                $sub_data['address'][] = $delivery['address'];
                $sub_data['city_id'] = $delivery['city_id'];
                $sub_data['date'][] = $delivery['date'];
                $sub_data['time'][] = $delivery['time'];
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

    public function actionDeleteNewAdmin()
    {
        if(isset($_POST['iid']))
        {
            $id = $_POST['iid'];
            $delete_new = new \Application\models\News();
            $delete_new->delete_new($id);
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

    public function actionDeleteProductFromDiscount()
    {
        if(isset($_POST['iid']))
        {
            $id = $_POST['iid'];
            $delete_discount = new \Application\models\Product();
            $delete_discount->remove_discount($id);
            $delete_pr_from_discount = new \Application\models\Discount();
            $delete_pr_from_discount->delete_product_from_discount($id);
            echo 1;
        }
    }

    public function actionInsertDiscountValue()
    {
        if(isset($_POST['value_discount']))
        {
            $id = $_POST['product_id'];
            $value_discount = $_POST['value_discount'];
            $end_date = $_POST['end_date'];
            $newDate = date("Y-m-d H:s:i", strtotime($end_date));
            $insert_discount = new \Application\models\Discount();
            $insert_discount->insert_discount_value($id,$value_discount,trim($newDate));
            echo 1;
        }
    }

    public function actionInsertPromotionValue()
    {
        if(isset($_POST['value_promotion']))
        {
            $id = $_POST['product_id'];
            $value_promotion = $_POST['value_promotion'];
            $end_date = $_POST['end_date'];
            $insert_promotion = new \Application\models\Promotion();
            $insert_promotion->insert_promotion_value($id,$value_promotion,$end_date);
            echo 1;
        }
    }

    public function actionInsertSpecialOfferValue()
    {
        if(isset($_POST['value_special_offer']))
        {
            $id = $_POST['product_id'];
            $value_special_offer = $_POST['value_special_offer'];
            $end_date = $_POST['end_date'];
            $insert_special_offer = new \Application\models\SpecialOffer();
            $insert_special_offer->insert_special_offer_value($id,$value_special_offer,$end_date);
            echo 1;
        }
    }

    public function actionUpdateDiscountValue()
    {
        if(isset($_POST['value_discount']))
        {
            $id = $_POST['product_id'];
            $value_discount = $_POST['value_discount'];
            $check_if_exist = new \Application\models\Discount();
            $res =$check_if_exist->get_discounts_by_product_id($id);
            $res->execute(array($id));
            $count = $res->rowCount();
             if ($count > 0) {
                 $update_discount = new \Application\models\Discount();
                 $update_discount->update_discount_value($id, $value_discount);
                 echo 1;
             }else{
                 $insert_discount = new \Application\models\Discount();
                 $insert_discount->insert_only_discount_value($id, $value_discount);
                 echo '2';
             }
        }
    }

    public function actionUpdateDiscountEndDateValue()
    {
        if(isset($_POST['end_date']))
        {
            $id = $_POST['product_id'];
            $end_date = $_POST['end_date'];
            $newDate = date("Y-m-d H:s:i", strtotime($end_date));
            $check_if_exist = new \Application\models\Discount();
            $res =$check_if_exist->get_discounts_by_product_id($id);
            $res->execute(array($id));
            $count = $res->rowCount();
            if ($count > 0) {
                $update_discount = new \Application\models\Discount();
                $update_discount->update_discount_end_date_value($id, trim($newDate));
                echo $newDate;
            }else{
                $insert_discount = new \Application\models\Discount();
                $insert_discount->insert_only_end_date($id, $newDate);
                echo '2';
            }
        }
    }

    public function actionUpdatePromotionEndDateValue()
    {
        if(isset($_POST['end_date']))
        {
            $id = $_POST['product_id'];
            $end_date = $_POST['end_date'];
            $newDate = date("Y-m-d H:s:i", strtotime($end_date));
            $check_if_exist = new \Application\models\Promotion();
            $res =$check_if_exist->get_promotion_by_id($id);
            $res->execute(array($id));
            $count = $res->rowCount();
            if ($count > 0) {
                $update_promotion = new \Application\models\Promotion();
                $update_promotion->update_promotion_end_date_value($id, trim($newDate));
                echo 1;
            }else{
                $insert_promotion = new \Application\models\Promotion();
                $insert_promotion->insert_only_end_date($id, $newDate);
                echo '2';
            }
        }
    }

    public function actionUpdateSmallPhoto()
    {
        if(isset($_POST['arr_ids']))
        {
            $arr_ids = $_POST['arr_ids'];
            $product_id = $_POST['product_id'];
            $update_small_photo= new \Application\models\SmallImages();
            $update_small_photo->update_small_photos($arr_ids,$product_id);
            echo 1;
        }
    }

    public function actionUpdateSpecialOfferEndDateValue()
    {
        if(isset($_POST['end_date']))
        {
            $id = $_POST['product_id'];
            $end_date = $_POST['end_date'];
            $newDate = date("Y-m-d H:s:i", strtotime($end_date));
            $check_if_exist = new \Application\models\SpecialOffer();
            $res =$check_if_exist->get_special_offer_by_id($id);
            $res->execute(array($id));
            $count = $res->rowCount();
            if ($count > 0) {
                $update_special_offer = new \Application\models\SpecialOffer();
                $update_special_offer->update_special_offer_end_date_value($id, trim($newDate));
                echo 1;
            }else{
                $insert_special_offer = new \Application\models\SpecialOffer();
                $insert_special_offer->insert_only_end_date($id, $newDate);
                echo '2';
            }
        }
    }

    public function actionDeleteSmImgPreview()
    {
        if(isset($_POST['id']))
        {
            $id = trim($_POST['id']);
            $delete_photo = new \Application\models\SmallImages();
            $delete_photo->delete_small_images_preview($id);
            echo 1;
        }
    }

    public function actionDeleteSmImgAdded()
    {
        if(isset($_POST['id']))
        {
            $id = trim($_POST['id']);
            $delete_photo = new \Application\models\SmallImages();
            $delete_photo->delete_small_images_added($id);
            echo 1;
        }
    }

    public function actionDeleteWorker()
    {
        if(isset($_POST['iid']))
        {
            $iid = $_POST['iid'];
            $workers = new \Application\models\Workers();
            $workers->delete_worker($iid);
            echo 1;
        }
    }

    public function actionAddWorker()
    {
        if (NULL !=($_POST['post_id'])) {
            $lastname = $_POST['last_name'];
            $name = strip_tags($_POST['name']);
            $patronymic = strip_tags($_POST['patronymic']);
            $birth_day = strip_tags($_POST['bday']);
            $birth_day = date("Y-m-d H:i:s", strtotime($birth_day));
            $start_day = strip_tags($_POST['start_day']);
            $start_day = date("Y-m-d H:i:s", strtotime($start_day));
            $email = strip_tags($_POST['email']);
            $salary = strip_tags($_POST['salary']);
            $post_id = strip_tags($_POST['post_id']);
            $new_worker = new \Application\models\Workers();
            $new_worker->insert_worker($lastname,$name,$patronymic,$birth_day,$salary,$email,$post_id,$start_day);
            echo 1;
        }
    }

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

    public function actionUpdateWorker()
    {
        if(isset($_POST['iid']))
        {
            $iid = $_POST['iid'];
            $lastname = $_POST['lastname'];
            $name = $_POST['name'];
            $patronymic = $_POST['patronymic'];
            $birth_day = $_POST['bday'];
            $salary = $_POST['salary'];
            $email = $_POST['email'];
            $post_id = $_POST['post_id'];
            $workers = new \Application\models\Workers();
            $update_worker = $workers->update_worker($iid,$lastname,$name,$patronymic,$birth_day,$salary,$email,$post_id);
            echo 1;
        }
    }

    public function actionGetByIdDepartment()
    {
        if(isset($_POST['iid'])){
            $iid = $_POST['iid'];
            $new_department = new \Application\models\Department();
            $departments = $new_department->get_deparment_by_id($iid);
            $departments->execute(array($iid));
            foreach ($departments as $department) {
                $sub_data["id"] = $department['id'];
                $sub_data["department"] = $department['department'];
                $sub_data["parent_id"] = $department['parent_id'];
                $sub_data["photo"] = $department['photo'];
            }
            $data[] = $sub_data;
            echo json_encode($data);
        }
    }

    public function actionGetPostByParent()
    {
        if(isset($_POST['post_id'])){
            $post_id = $_POST['post_id'];
            $posts = new \Application\models\Post();
            $res_posts = $posts->get_posts_by_parent_id($post_id);
            $res_posts->execute(array($post_id));
            foreach ($res_posts as $post) {
                $sub_data["id"][] = $post['id'];
                $sub_data["post"][] = $post['post'];
                $sub_data["post_id"][] = $post['post_id'];
            }
            $data[] = $sub_data;
            echo json_encode($data);
        }
    }

    public function actionGetId()
    {
        if(isset($_POST['iid'])){
            $iid = $_POST['iid'];
            $new_worker = new Workers();
            $workers = $new_worker->get_workers_by_id($iid);
            $workers->execute(array($iid));
            foreach ($workers as $worker) {
                $sub_data["id"] = $worker['id'];
                $sub_data["lastname"] = $worker['lastname'];
                $sub_data["name"] = $worker['name'];
                $sub_data["patronymic"] = $worker['patronymic'];
                $date = date_create($worker['birth_day']);
                $birth_day = date_format($date, 'm/d/Y 12:00 A');
                $sub_data["birth_day"] = $birth_day;
                $sub_data["salary"] = $worker['salary'];
                $sub_data["email"] = $worker['email'];
                $post = $new_worker->get_post($worker['post_id']);
                $post->execute(array($worker['post_id']));
                foreach ($post as $post_name) {
                    $sub_data["post"] = $post_name['post'];
                }
            }
            $data[] = $sub_data;
            echo json_encode($data);
        }
    }

    public function actionWorker()
    {
        session_start();
        require_once(ROOT . '/application/views/admin/head.php');
        require_once(ROOT . '/application/views/admin/worker.php');
        require_once(ROOT . '/application/views/admin/footer.php');
    }

    public function actionnewsAdmin()
    {
        session_start();
        require_once(ROOT . '/application/views/admin/head.php');
        require_once(ROOT . '/application/views/admin/newsAdmin.php');
        require_once(ROOT . '/application/views/admin/footer.php');
    }

    public function actionGetTreeviewDepartmentEdition()
    {
        $all_departments = new \Application\models\Department();
        $departments = $all_departments->get_departments();
        foreach($departments as $department) {
                $sub_data["id"] = $department["id"];
                $res = $department['department'] .'
                    <button type="button"  title="удалить" style="float: right;" class="btn btn-default btn-sm" data-iid="' . $department['id'] . '">
                    <span class="glyphicon glyphicon-trash" data-iid="' . $department['id'] . '"></span>
                    </button>
                    <button type="button" data-iid="' . $department['id'] . '" id="update_department_button" title="редактировать" data-toggle="modal" data-target="#updateModal"  style="float: right;" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-pencil" data-iid="' . $department['id'] . '"></span>
                    </button>
                    <button type="button"  title="добавить новую категорию" style="float: right;" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal" data-department="'.$department['department'].'"  data-iid="' . $department['id'] . '"></span>
                    </button>
                ';
                $sub_data["name"] = $res;
                $sub_data["text"] = $res;
                $sub_data["parent_id"] = $department["parent_id"];
            $data[] = $sub_data;
       }
        foreach($data as $key => &$value)
        {
            $output[$value["id"]] = &$value;
        }
        foreach($data as $key => &$value)
        {
            if($value["parent_id"] && isset($output[$value["parent_id"]]))
            {
                $output[$value["parent_id"]]["nodes"][] = &$value;
            }
        }
        foreach($data as $key => &$value)
        {
            if($value["parent_id"] && isset($output[$value["parent_id"]]))
            {
                unset($data[$key]);
            }
        }
        echo json_encode($data);
    }

    public function actionResponse()
    {
        $all_workers = new \Application\models\Workers();
        $workers = $all_workers->get_workers();
        foreach($workers as $worker) {
             $new_posts = new \Application\models\Workers();
             $posts_res = $new_posts->get_post($worker['post_id']);
             $posts_res->execute(array($worker['post_id']));
             foreach ($posts_res as $post) {
                 $initial_lastname = utf8_encode($worker['lastname']);
                 $initial_lastname = utf8_decode($initial_lastname);
                 $initial_name = utf8_encode($worker['name']);
                 $initial_name = mb_substr($initial_name,0,2);
                 $initial_name = utf8_decode($initial_name);
                 $initial_patronymic = utf8_encode($worker['patronymic']);
                 $initial_patronymic = mb_substr($initial_patronymic,0,2);
                 $initial_patronymic = utf8_decode($initial_patronymic);
                 $initial = $initial_lastname.'. '.$initial_name.'. '.$initial_patronymic;
                 $sub_data["id"] = $worker["id"];
                 $res = $initial.' "'.$post['post'].'" ('.$worker['salary'].' $)
                    <button type="button"  title="удалить" style="float: right;" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-trash" data-iid="'.$worker['id'].'"></span>
                    </button>
                    <button type="button" data-iid="'.$worker['id'].'" id="update_worker_button" title="редактировать" data-toggle="modal" data-target="#updateModal"  style="float: right;" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-pencil" data-iid="'.$worker['id'].'"></span>
                    </button>
                    <button type="button"  title="добавить нового работника" style="float: right;" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal-admin-worker-add-new-worker" data-post="'.$post['post'].'" data-post_id="'.$worker['post_id'].'"  data-iid="'.$worker['id'].'"></span>
                    </button>
                 ';
                 $sub_data["name"] = $res;
                 $sub_data["text"] = $res;
                 $sub_data["parent_id"] = $post["post_id"];
             }
             $data[] = $sub_data;
        }
        foreach($data as $key => &$value)
        {
            $output[$value["id"]] = &$value;
        }
        foreach($data as $key => &$value)
        {
            if($value["parent_id"] && isset($output[$value["parent_id"]]))
            {
                $output[$value["parent_id"]]["nodes"][] = &$value;
            }
        }
        foreach($data as $key => &$value)
        {
            if($value["parent_id"] && isset($output[$value["parent_id"]]))
            {
                unset($data[$key]);
            }
        }
        echo json_encode($data);
    }
}

