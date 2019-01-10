<?php 
namespace Application\models; 
use Application\core\App;

class Post
{
    public $conn;

    public function get_posts_by_parent_id($post_id)
    {
        $conn = App::$app->get_db();
        $stmt =$conn->prepare("SELECT * FROM posts WHERE post_id = ?");
        $stmt->bindParam(1, $post_id);
        return $stmt;
    }

    public function get_post($post_id)
    {
        $conn = App::$app->get_db();
        $stmt =$conn->prepare("SELECT  posts.post, posts.post_id FROM posts 
            LEFT JOIN workers ON posts.id=workers.post_id
            WHERE workers.post_id = ?
           ");
        $stmt->bindParam(1, $post_id);
        return $stmt;
    }
}  
?>  
