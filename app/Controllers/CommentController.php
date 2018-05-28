<?php


namespace App\Controllers;
use Enaylal\Controller;
use \DB;

/**
 * Class CommentController
 * @package App\Controllers
 */
class CommentController extends Controller
{

    public function comments()
    {
        $comments = DB::table('Comment')->get();
        if(!empty($comments)){
            echo json_encode($comments);
        } else {
            echo json_encode(['error'=> 'sorry no comments exist']);
        }
    }

    public function getCommentPublication($id){
        // change ta requete sql, c'est plus les bon noms
        $comments = DB::query('SELECT * FROM Comment
        INNER JOIN user ON user.id = Comment.comment_user_id 
        INNER JOIN Publication ON Publication.publication_id = Comment.comment_publication_id
        WHERE Publication.publication_id = ? ',[$id])->get();
        if(!empty($comments)) {
            echo json_encode($comments);
        } else {
            echo json_encode(['error'=> 'sorry that publication has no comment']);
        }
    }

    public function single($id)
    {
        $comments = DB::table('Comment')->where('user_id', $id)->get();
        echo json_encode($comments);
    }

    public function delete($id){

        $method = strtolower($_SERVER['REQUEST_METHOD']);

        if($method == "delete"){
            DB::table('Comment')->where('id',$id)->delete();

            $data = [
                "success" => "Comment successfully deleted"
            ];

            echo json_encode($data);
        }
    }

    public function create(){
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $data = [];
        $data = json_decode(file_get_contents("php://input"), true);
        DB::table('Comment')->insert($data);

        $message = [
            "success" => "The comment has been successfully created"
        ];

        echo json_encode($message);


    }


    public function edit($id)
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $data = [];
        $data = json_decode(file_get_contents("php://input"), true);
        $test =  DB::table('Comment')->where('id', $id)->update($data);

        $message = [
            "success" => "Comment successfully edited"
        ];
        echo json_encode($message);

    }

}