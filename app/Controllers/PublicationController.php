<?php


namespace App\Controllers;
use Enaylal\Controller;
use \DB;

/**
 * Class PublicationController
 * @package App\Controllers
 */
class PublicationController extends Controller
{

    public function publication()
    {
        $publications = DB::table('Publication')->get();
        if(!empty($publications)){
            echo json_encode($publications);
        } else {
            echo json_encode(['error'=> 'sorry no no publications exist']);
        }
    }

    public function single($id)
    {
        $publication = DB::table('Publication')->where('user_id', $id)->get();
        echo json_encode($publication);
    }

    public function user_publication($id){


        /*

       $publications = DB::table('Publication')
            ->join('user', 'user.id', '=', 'Publication.user_id')
            ->join('Comment', 'Comment.publication_id', '=', 'Publication.id')
            ->where('user.id', $id);


       */

        $publications = DB::query('SELECT * FROM Publication 
        INNER JOIN user ON user.id = Publication.publication_user_id
        WHERE user.id = 15
    ')->get();

        if(!empty($publications)) {
            echo json_encode($publications);
        } else {
            echo json_encode(['error'=> 'sorry that user has no publication']);
        }
    }

    public function delete($id){

        $method = strtolower($_SERVER['REQUEST_METHOD']);

        if($method == "delete"){
            DB::table('Publication')->where('id', $id)->delete();
            DB::table('Comment')->where('publication_id',$id)->delete();

            $data = [
                "success" => "Publication and Comments of the publication successfully deleted"
            ];

            echo json_encode($data);
        }
    }

    public function create(){
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $data = [];
        $data = json_decode(file_get_contents("php://input"), true);
        DB::table('Publication')->insert($data);

        $message = [
            "success" => "The publication has been successfully created"
        ];

        echo json_encode($message);


    }

    public function edit($id)
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $data = [];
        $data = json_decode(file_get_contents("php://input"), true);
        $test =  DB::table('Publication')->where('id', $id)->update($data);

        $message = [
            "success" => "Publication successfully edited"
        ];
        echo json_encode($message);

    }

}