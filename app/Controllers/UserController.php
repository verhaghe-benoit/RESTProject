<?php


namespace App\Controllers;
use Enaylal\Controller;
use \DB;
use Enaylal\Form;

/**
 * Class UserController
 * @package App\Controllers
 */
class UserController extends Controller
{

    /**
     * Index de la page d'accueil
     */
    public function index()
    {
        $users = DB::table('user')->get();
        if(!empty($users)){
            echo json_encode($users);
        } else {
            echo json_encode(['error'=> 'sorry no user exist']);
        }

    }

    public function single($id){
        $user = DB::table('user')->where('id', $id)->first();
        // pense a faire une jointure pour recup tous les amies du gars + balcancer json
        echo json_encode($user);
    }

    public function edit($id)
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $data = [];
        $data = json_decode(file_get_contents("php://input"), true);
        $test =  DB::table('user')->where('id', $id)->update($data);

        $message = [
            "success" => "User successfully edited"
         ];
        echo json_encode($message);

    }

    public function delete($id){

        $method = strtolower($_SERVER['REQUEST_METHOD']);

        if($method == "delete"){
            DB::table('user')->where('id', $id)->delete();

            $data = [
                "success" => "User successfully deleted"
            ];

            echo json_encode($data);
        }


    }

    public function create(){
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $data = [];
        $data = json_decode(file_get_contents("php://input"), true);
        DB::table('user')->insert($data);

        $message = [
            "success" => "The user has been successfully created"
        ];

        echo json_encode($message);


    }


}