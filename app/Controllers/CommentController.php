<?php


namespace App\Controllers;
use Enaylal\Controller;

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

    public function single($id)
    {
        $comments = DB::table('Comment')->where('user_id', $id);
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

}