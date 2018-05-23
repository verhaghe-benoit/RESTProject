<?php


namespace App\Controllers;
use Enaylal\Controller;
use \DB;

/**
 * Class FriendController
 * @package App\Controllers
 */
class FriendController extends Controller
{

    public function friends()
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

    public function user_friend($id){

        $friends = DB::table('Friends')
            ->join('user', 'user.id', '=', 'Friends.user_id1')
            ->where('user.id', $id)
            ->get();
        if(!empty($friends)) {
            echo json_encode($friends);
        } else {
            echo json_encode(['error'=> 'sorry that user has no friend']);
        }
    }

    public function delete($id1,$id2){

        $method = strtolower($_SERVER['REQUEST_METHOD']);

        if($method == "delete"){
            DB::table('Friends')->where('user_id1', $id1)
                                ->where('user_id2',$id2)
                                ->delete();

            $data = [
                "success" => "The friend has been successfully deleted"
            ];

            echo json_encode($data);
        }
    }

    public function create(){
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $data = [];
        $data = json_decode(file_get_contents("php://input"), true);
        DB::table('Friends')->insert($data);

        $message = [
            "success" => "Your friendship has been successfully created"
        ];

        echo json_encode($message);


    }

}