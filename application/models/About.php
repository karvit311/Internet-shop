<?php 
namespace Application\models;  
use Application\core\App;
use Application\models\Region;
use Application\models\Curier;

class About
{
    public $conn;

    public function get_about()
    {
        $conn = App::$app->get_db();
        return $conn->query("SELECT * FROM about ")->fetchAll();
    }

    public function update_about_company($title, $content)
    {
        $conn = App::$app->get_db();
        $stmt = $conn->prepare("UPDATE about SET title=:title, content=:content WHERE id=1");
        $stmt->bindParam(":title", $title, \PDO::PARAM_STR);
        $stmt->bindParam(":content", $content, \PDO::PARAM_STR);
        $update = $stmt->execute();
        return $update;
    }
}

