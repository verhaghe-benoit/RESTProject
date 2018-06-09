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

        $user = DB::query("SELECT * FROM user 
        WHERE user.id = $id")->get();

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

        $form = new Form();
        $email = $form->post('email');
        $login = $form->post('login');
        $password = $form->post('password');
        $gender = $form->post('gender');
        $lastname = $form->post('lastname');
        $firstname = $form->post('firstname');
        $birthday = $form->post('birthday');
        $token = $form->generateRandomString(60);

        $data = [
            'email' => $email,
            'password' => $password,
            'login' => $login,
            'gender' => $gender,
            'lastname' => $lastname,
            'firstname' => $firstname,
            'birthday' => $birthday,
            'token' => $token
        ];

        DB::table('user')->insert($data);
        $message = [
            "success" => "The user has been successfully created"
        ];

        echo json_encode($message);
    }

    public function postLogin(){


        $form = new Form();
        $username = $form->post('login');
         $password = $form->post('password');

        $found = DB::table('user')->select('*')->where('login', '=', $username)->get();

        if(!empty($found)){

           if($password == $found[0]->password){
               $status = 200;
               array_push($found, $status);
               return json_encode($found);
           }else{
               return json_encode([ "didntMatch" => "les mots de passe sont different"]);
           }
        } else {
            return json_encode(["dontExist" => "L'utilisateur n'existe pas"]);
        }
    }

}