<?php


namespace App\Controllers;
use Enaylal\Controller;
use \DB;

/**
 * Class FriendRequestController
 * @package App\Controllers
 */
class FriendRequestController extends Controller
{

    public function friendRequest()
    {
        $friends = DB::table('FriendsRequest')->get();
        if(!empty($friends)){
            echo json_encode($friends);
        } else {
            echo json_encode(['error'=> 'sorry no friend request exist']);
        }
    }

    public function single($id)
    {
        $friends = DB::table('FriendsRequest')->where('user_IdRequester', $id)->get();
        echo json_encode($friends);
    }

    public function delete($id1,$id2){

        $method = strtolower($_SERVER['REQUEST_METHOD']);

        if($method == "delete"){
            DB::table('FriendsRequest')->where('user_IdRequester', $id1)
                                ->where('user_IdRequestee',$id2)
                                ->delete();

            $data = [
                "success" => "Friend Request successfully deleted"
            ];

            echo json_encode($data);
        }
    }

    public function create(){
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $data = [];
        $data = json_decode(file_get_contents("php://input"), true);
        DB::table('FriendsRequest')->insert($data);

        $message = [
            "success" => "Your friend request has been successfully created"
        ];

        echo json_encode($message);


    }
    

}