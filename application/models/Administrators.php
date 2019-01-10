<?php 
namespace Application\models;  
use Application\core\App;
use Application\models\Region;
use Application\models\Curier;

class Administrators
{
    public $conn;

    public function get_administrators()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM administrators ")->fetchAll();
    }

    public function check_admin($login,$password)
    {
        $login = trim($login);
        $password = trim($password);
        $conn = App::$app->get_db();
        $stmt =$conn->prepare("SELECT * FROM administrators WHERE admin_login =? AND admin_pass =?");
        $stmt->bindParam(1, $login);
        $stmt->bindParam(2, $password);
        return $stmt;
    }

    public function check_admin_data($login)
    {
        $login = trim($login);
        $conn = App::$app->get_db();
        $stmt =$conn->prepare("SELECT * FROM administrators WHERE admin_login = ? ");
        $stmt->bindParam(1, $login);
        return $stmt;
    }

    public function insert_new_administrator($view_orders,$accept_orders,$delete_orders,$add_tovar,$edit_tovar,$delete_tovar,$accept_reviews,$delete_reviews,$view_clients,$delete_clients,$add_news,$delete_news,$add_category,$delete_category,$add_worker,$edit_worker,$delete_worker,$add_delivery,$edit_delivery,$delete_delivery,$view_admin,$admin_login,$admin_pass,$admin_fio,$admin_role,$admin_email,$admin_phone)
    {
        $conn =App::$app->get_db();
        $stmt=$conn->prepare("INSERT 
        INTO administrators(view_orders,accept_orders,delete_orders,add_tovar,edit_tovar,delete_tovar,accept_reviews,delete_reviews,view_clients,delete_clients,add_news,delete_news,add_category,delete_category,add_worker,edit_worker,delete_worker,add_delivery,edit_delivery,delete_delivery,view_admin,admin_login,admin_pass,admin_fio,admin_role,admin_email,admin_phone)
        VALUES(:view_orders,:accept_orders,:delete_orders,:add_tovar,:edit_tovar,:delete_tovar,:accept_reviews,:delete_reviews,:view_clients,:delete_clients,:add_news,:delete_news,:add_category,:delete_category,:add_worker,:edit_worker,:delete_worker,:add_delivery,:edit_delivery,:delete_delivery,:view_admin,:admin_login,:admin_pass,:admin_fio,:admin_role,:admin_email,:admin_phone)");
        $stmt->bindParam(":view_orders", $view_orders, \PDO::PARAM_INT);
        $stmt->bindParam(":accept_orders", $accept_orders, \PDO::PARAM_INT);
        $stmt->bindParam(":delete_orders", $delete_orders, \PDO::PARAM_INT);
        $stmt->bindParam(":add_tovar", $add_tovar, \PDO::PARAM_INT);
        $stmt->bindParam(":edit_tovar", $edit_tovar, \PDO::PARAM_INT);
        $stmt->bindParam(":delete_tovar", $delete_tovar, \PDO::PARAM_INT);
        $stmt->bindParam(":accept_reviews", $accept_reviews, \PDO::PARAM_INT);
        $stmt->bindParam(":delete_reviews", $delete_reviews, \PDO::PARAM_INT);
        $stmt->bindParam(":view_clients", $view_clients, \PDO::PARAM_INT);
        $stmt->bindParam(":delete_clients", $delete_clients, \PDO::PARAM_INT);
        $stmt->bindParam(":add_news", $add_news, \PDO::PARAM_INT);
        $stmt->bindParam(":delete_news", $delete_news, \PDO::PARAM_INT);
        $stmt->bindParam(":add_category", $add_category, \PDO::PARAM_INT);
        $stmt->bindParam(":delete_category", $delete_category, \PDO::PARAM_INT);
        $stmt->bindParam(":add_worker", $add_worker, \PDO::PARAM_INT);
        $stmt->bindParam(":edit_worker", $edit_worker, \PDO::PARAM_INT);
        $stmt->bindParam(":delete_worker", $delete_worker, \PDO::PARAM_INT);
        $stmt->bindParam(":add_delivery", $add_delivery, \PDO::PARAM_INT);
        $stmt->bindParam(":edit_delivery", $edit_delivery, \PDO::PARAM_INT);
        $stmt->bindParam(":delete_delivery", $delete_delivery, \PDO::PARAM_INT);
        $stmt->bindParam(":view_admin", $view_admin, \PDO::PARAM_INT);
        $stmt->bindParam(":admin_login", $admin_login, \PDO::PARAM_STR);
        $stmt->bindParam(":admin_pass", $admin_pass, \PDO::PARAM_STR);
        $stmt->bindParam(":admin_fio", $admin_fio, \PDO::PARAM_STR);
        $stmt->bindParam(":admin_role", $admin_role, \PDO::PARAM_STR);
        $stmt->bindParam(":admin_email", $admin_email, \PDO::PARAM_STR);
        $stmt->bindParam(":admin_phone", $admin_phone, \PDO::PARAM_STR);
        $stmt->execute();
    }
}

