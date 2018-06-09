<?php


namespace App\Controllers;
use DateTime;
use Enaylal\Controller;
use \DB;
use Enaylal\Form;

/**
 * Class CommentController
 * @package App\Controllers
 */
class CommentController extends Controller
{

    public function comments()
    {
        $comments = DB::query('SELECT * FROM Comment
        INNER JOIN user ON user.id = Comment.comment_user_id 
        INNER JOIN Publication ON Publication.publication_id = Comment.comment_publication_id')->get();
        if(!empty($comments)){
            echo json_encode($comments);
        } else {
            echo json_encode(['error'=> 'sorry no comments exist']);
        }
    }

    public function getCommentPublication($id){
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
        $comments = DB::table('Comment')->where('comment_user_id', $id)->get();
        echo json_encode($comments);
    }

    public function delete($id){

        $method = strtolower($_SERVER['REQUEST_METHOD']);

        if($method == "delete"){
            DB::table('Comment')->where('comment_id',$id)->delete();

            $data = [
                "success" => "Comment successfully deleted"
            ];

            echo json_encode($data);
        }
    }

    public function create(){

        $dt = new DateTime();
        $form = new Form();

        $comment_content = $form->post('comment_content');
        $comment_user_id = $form->post('comment_user_id') ;
        $comment_publication_id = $form->post('comment_publication_id') ;


        $data = [
            'comment_content' => $comment_content,
            'comment_date' => $dt->format('Y-m-d H:i:s'),
            'comment_user_id' => $comment_user_id,
            'comment_publication_id' => $comment_publication_id
        ];


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
        $test =  DB::table('Comment')->where('comment_id', $id)->update($data);

        $message = [
            "success" => "Comment successfully edited"
        ];
        echo json_encode($message);

    }


}