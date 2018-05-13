<?php


namespace App\Controllers;
use Enaylal\Controller;

/**
 * Class FriendController
 * @package App\Controllers
 */
class FriendController extends Controller
{

    public function friend()
    {
        $friends = DB::table('Friends')->get();
        if(!empty($friends)){
            echo json_encode($friends);
        } else {
            echo json_encode(['error'=> 'sorry no friends exist']);
        }
    }

    public function single($id)
    {
        $friends = DB::table('Friends')->where('user_id1', $id);
        echo json_encode($friends);
    }

    public function delete($id1,$id2){

        $method = strtolower($_SERVER['REQUEST_METHOD']);

        if($method == "delete"){
            DB::table('Friends')->where('user_id1', $id1)
                                ->where('user_id2',$id2)
                                ->delete();

            $data = [
                "success" => "User successfully deleted"
            ];

            echo json_encode($data);
        }
    }
    

}