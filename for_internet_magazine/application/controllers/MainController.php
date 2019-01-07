<?php
namespace Application\controllers;
use Application\models\Workers;
use Application\models\Schedule;
use Application\models\Region;

class MainController 
{
	public function actionIndex()
	{
        require_once(ROOT . '/application/views/head.php');
    	require_once(ROOT . '/application/views/index.php');
	}
    public function actionDelivery()
    {
        session_start();
        require_once(ROOT . '/application/views/head.php');
        require_once(ROOT . '/application/views/delivery.php');
    }
    public function actionSignup()
    {
       // session_start();
        require_once(ROOT . '/application/views/head.php');
        require_once(ROOT . '/application/views/signup.php');
    }
    public function actionLogout()
    {
        session_unset();
//        session_destroy();
        header('Location: /main/index');
    }

    public function actionSignupData()
    {
        if(isset($_POST['name'])){
            $name = $_POST['name'];
            echo $name;
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
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $check_correct_user_data = new \Application\models\Users();
            $res_check_correct_user_data = $check_correct_user_data->login($email,$password);
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
    public function actionLogin()
    {

        require_once(ROOT . '/application/views/head.php');
        require_once(ROOT . '/application/views/login.php');
    }
    public function actionProducts()
    {
        session_start();
        require_once(ROOT . '/application/views/head.php');
        require_once(ROOT . '/application/views/products.php');

    }
    public function actionView($id)
    {
        session_start();
        $id = $_GET['id'];
        $ip_address_user = $_SERVER['REMOTE_ADDR'];
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
                $check_if_exists_ids = $ids_viewed_product->check_if_exists_viewed_id($user['id'], $id);
                $check_if_exists_ids->execute(array($user['id'], $id));
                $count_product = $check_if_exists_ids->fetchColumn();
                if ($count_product > 0) {
                } else {
                    $id_of_product = $_GET['id'];
                    $insert_viewed_product = new \Application\models\ViewedProduct();
                    $insert_viewed_product->insert_ids_viewed_products($user['id'], $id_of_product);
                }
            }
        } else {
            $id_of_product = $_GET['id'];
            $update_exists_user = new \Application\models\Users();
            $update_exists_user->insert_guest_user($ip_address_user);
            $last_insert_id = \Application\core\App::$app->lastInsertId();
            $insert_viewed_product = new \Application\models\ViewedProduct();
            $insert_viewed_product->insert_ids_viewed_products($last_insert_id,$id_of_product);
        }
        require_once(ROOT . '/application/views/head.php');
        require_once(ROOT . '/application/views/view.php');
    }
    public function actionDepartment()
    {
        require_once(ROOT . '/application/views/head.php');
        require_once(ROOT . '/application/views/department.php');
    }
    public function actionIndex2()
    {
        require_once(ROOT . '/application/views/head.php');
        require_once(ROOT . '/application/views/index2.php');
    }
    public function actionSalary()
    {
        require_once(ROOT . '/application/views/head.php');
        require_once(ROOT . '/application/views/salary.php');
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
//            echo $image_id;
//            $small_image_id = trim($_POST['small_image_id']);
            $small_image_ids = new \Application\models\SmallImages();
            $res_small_image_ids = $small_image_ids->get_small_image_by_id($image_id);
            $res_small_image_ids->execute(array($image_id));
            foreach ($res_small_image_ids as $res_small_image_id) {
                $sub_data['id'] = $res_small_image_id['id'];
                $sub_data['name'] = $res_small_image_id['name'];
//                $sub_data['photo'] = $department_child['photo'];
                $data[] = $sub_data;
            }
            echo json_encode($data);
        }
    }
    public function actionGetImage()
    {
        if (NULL !=($_POST['image_id'])) {
            $image_id = $_POST['image_id'];
//            echo $image_id;
//            $small_image_id = trim($_POST['small_image_id']);
            $small_image_ids = new \Application\models\SmallImages();
            $res_small_image_ids = $small_image_ids->get_small_image_by_id($image_id);
            $res_small_image_ids->execute(array($image_id));
            foreach ($res_small_image_ids as $res_small_image_id) {
                $sub_data['id'] = $res_small_image_id['id'];
                $sub_data['name'] = $res_small_image_id['name'];
//                $sub_data['photo'] = $department_child['photo'];
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
            $info = $_POST['info'];
            $department = $_POST['department'];
            $delivery = new \Application\models\Delivery();
            $search_delivery = $delivery->get_deliveres_conditionals_supplier($supplier);
            $search_delivery->execute(array($supplier));
            $count = $search_delivery->rowCount();
            if ($count > 0) {
                echo 'count';
            } else {

//            $sche = new Schedule();
//            $res = $sche->get_schedules_conditionals($curier_id, $region_id,$date_depart_res, $stamp_total_time_in_road,$date_depart_res, $stamp_total_time_in_road);
//            $res->execute(array($curier_id, $region_id,$date_depart_res, $stamp_total_time_in_road,$date_depart_res, $stamp_total_time_in_road));
//            $count = $res->rowCount();
//            if ( $count>0 ) {
//                echo 'count';
//            }else{
//                $schedule = new Schedule();
//                $schedule->insert($region_id, $curier_id, $date_depart_res, $time_in_road, $stamp_total_time_in_road);
//                echo '1';
//            }


            $deliveries = new \Application\models\Delivery();
            $update_delivery = $deliveries->update_worker($supplier_id, $city_id, $address, $date, $time);
            echo 1;
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
        if(isset($_POST['date']) && isset($_POST['time']) )
        {
            $date = $_POST['date'];
            $time = $_POST['time'];
            $change_format_date = date_create($date);
            $change_format_date = date_format($change_format_date, 'Y-m-d');
            $get_deliveries = new \Application\models\Delivery();
            $deliveries  = $get_deliveries->get_deliveres_date_city_id_time($time,$change_format_date);
            $deliveries->execute(array($time,$change_format_date));
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
                $sub_data['address'] = $delivery['address'];
                $sub_data['date'] = $delivery['date'];
                $sub_data['time'] = $delivery['time'];
                $data[] = $sub_data;
            }
        echo json_encode($data);
        }
    }

    public function actionGetAllDeliveriesForThisSupplier(){
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
    public function actionGetAllDeliveriesForThisCity(){
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
                $sub_data['address'] = $delivery['address'];
                $sub_data['city_id'] = $delivery['city_id'];
                $sub_data['date'] = $delivery['date'];
                $sub_data['time'] = $delivery['time'];
            }
            $data[] = $sub_data;
                echo json_encode($data);
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
            $lastname = $_POST['lastname'];
            $name = strip_tags($_POST['name']);
            $patronymic = strip_tags($_POST['patronymic']);
            $birth_day = strip_tags($_POST['bday']);
            $date = date_create($birth_day);
            $birth_day = date_format($date, 'Y-m-d H:s:i');
            $email = strip_tags($_POST['email']);
            $salary = strip_tags($_POST['salary']);
            $post_id = strip_tags($_POST['post_id']);
            $new_worker = new \Application\models\Workers();
            $new_worker->insert_worker($lastname,$name,$patronymic,$birth_day,$salary,$email,$post_id);
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
//            $check_form = $_POST['check_form'];
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
    public function actionTest()
    {
        require_once(ROOT . '/application/views/head.php');
        require_once(ROOT . '/application/views/test.php');
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
//                 $initial_lastname = mb_substr($initial_lastname,0,2);
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
                    <span class="glyphicon glyphicon-trash" iid="'.$worker['id'].'"></span>
                    </button>
                    <button type="button" data-iid="'.$worker['id'].'" id="update_worker_button" title="редактировать" data-toggle="modal" data-target="#updateModal"  style="float: right;" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-pencil" data-iid="'.$worker['id'].'"></span>
                    </button>
                    <button type="button"  title="добавить нового работника" style="float: right;" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"  iid="'.$worker['id'].'"></span>
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

    public function actionTreeviewDepartment()
    {
        $all_departments = new \Application\models\Departmnet();
        $departments = $all_departments->get_departments();
        foreach($departments as $department) {
            $suppliers = new \Application\models\Workers();
            $posts_res = $suppliers->get_post($worker['post_id']);
            $posts_res->execute(array($worker['post_id']));
            foreach ($posts_res as $post) {
                $initial_lastname = utf8_encode($worker['lastname']);
//                 $initial_lastname = mb_substr($initial_lastname,0,2);
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
                    <span class="glyphicon glyphicon-trash" iid="'.$worker['id'].'"></span>
                    </button>
                    <button type="button" data-iid="'.$worker['id'].'" id="update_worker_button" title="редактировать" data-toggle="modal" data-target="#updateModal"  style="float: right;" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-pencil" data-iid="'.$worker['id'].'"></span>
                    </button>
                    <button type="button"  title="добавить нового работника" style="float: right;" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal"  iid="'.$worker['id'].'"></span>
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
//	public function actionSelectPost()
//	{
//    	require_once(ROOT . '/application/views/select_post.php');
//	}
//	public function actionListWorkers()
//	{
//    	require_once(ROOT . '/application/views/list_workers.php');
//   	}
//    public function actionAddNewRegion()
//	{
//    	if((isset($_POST['new_region'])) ){
//    		$new_region = addslashes( $_POST['new_region']);
//    		$reg = new Region();
//    		$stmt = $reg->get_prepare($new_region);
//    		$stmt->execute(array($new_region));
//    		$count = $stmt->rowCount();
//    		if ( $count>0 ) {
//        		echo 'count<br>';
//    		}else{
//        		$curier = new Region();
//        		$curier->insert($new_region);
//        		echo '1';
//    		}
//    	}
//	}
//	public function actionAddNewCurier()
//	{
//    	if((isset($_POST['new_curier'])) ){
//    		$new_curier = addslashes( $_POST['new_curier']);
//    		$cur = new Curier();
//    		$stmt = $cur->get_prepare($new_curier);
//    		$stmt->execute(array($new_curier));
//    		$count = $stmt->rowCount();
//    		if ( $count>0 ) {
//        		echo 'count';
//    		}else{
//        		$curier = new Curier();
//        		$curier->insert($new_curier);
//        		echo '1';
//    		}
//    	}
//	}
//	public function actionAddPost()
//	{
//    	if((isset($_POST['region'])  && isset($_POST['curier'])) && isset($_POST['date_depart']) && isset($_POST['time_in_road'])) {
//            $add_post = new Schedule();
//            $add_post->add_post($_POST['region'],$_POST['curier'],$_POST['date_depart'],$_POST['time_in_road']);
//    	}
//    	if(isset($_POST['res'])){
//            $get_res = new Schedule();
//            $get_res->get_res($_POST['res']);
//    	}
//	}
}

