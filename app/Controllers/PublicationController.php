<?php


namespace App\Controllers;
use Enaylal\Controller;

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
        $friends = DB::table('Publication')->where('user_id', $id);
        echo json_encode($friends);
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
            "success" => "The user has been successfully created"
        ];

        echo json_encode($message);


    }

}