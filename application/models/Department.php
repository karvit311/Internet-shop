<?php 
namespace Application\models;  
use Application\core\App;
use Application\models\Region;
use Application\models\Curier;

class Department
{
    public $conn;

    public function get_departments()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM department ")->fetchAll();
    }

    public function get_departments_parent($parent)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT id,department,parent_id,photo FROM department WHERE parent_id =? ");
        $stmt->bindValue(1, $parent);
        return $stmt;
    }

    public function get_departments_parent_count($parent)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT  COUNT(p.id) as total FROM department d LEFT JOIN products p ON p.department_id=d.id WHERE d.parent_id =? ");
        $stmt->bindValue(1, $parent);
        return $stmt;
    }

    public function get_departments_only_category_count($parent)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT  d.id,COUNT(p.id) as total FROM department d LEFT JOIN products p ON p.department_id=d.id WHERE d.id =? ");
        $stmt->bindValue(1, $parent);
        return $stmt;
    }

    public function get_deparment_by_id($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT id,department,parent_id,photo FROM department WHERE id =? ");
        $stmt->bindValue(1, $id);
        return $stmt;
    }

    public function update_department_name($department,$id,$parent_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE department SET department = :department,parent_id=:parent_id WHERE id=:id");
        $stmt->bindParam(":department", $department, \PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":parent_id", $parent_id, \PDO::PARAM_INT);
        $update = $stmt->execute();
        return $update;
    }

    public function update_photo($filename,$id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE department SET photo = :photo WHERE id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->bindParam(":photo", $filename, \PDO::PARAM_STR);
        $update = $stmt->execute();
        return $update;
    }

    public function del_of_department($id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("DELETE  FROM department WHERE id=:id");
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        $stmt->execute();
    }
    public function get_department_conditionals_id($department_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM department WHERE id=? ");
        $stmt->bindValue(1, $department_id);
        return $stmt;
    }

    public function get_if_exist_added_department($department)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("SELECT * FROM department WHERE department=? ");
        $stmt->bindValue(1, $department);
        return $stmt;
    }

    public function insert_photo($photo)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare( "INSERT INTO department (photo)  VALUES(:photo)");
        $stmt->bindParam(":photo", $photo, \PDO::PARAM_STR);
        $stmt->execute();
    }

    public function insert_department($department,$parent_id)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare( "INSERT INTO department (department,parent_id)  VALUES(:department,:parent_id)");
        $stmt->bindParam(":department", $department, \PDO::PARAM_STR);
        $stmt->bindParam(":parent_id", $parent_id, \PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>  
