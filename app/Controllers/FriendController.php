<?php


namespace App\Controllers;
use Enaylal\Controller;
use \DB;
use Enaylal\Form;

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


        $friends = DB::query("SELECT * FROM Friends
        INNER JOIN user as u1 ON u1.id = Friends.friend_user_id1
        INNER JOIN user as u2 ON u2.id = Friends.friend_user_id2
        WHERE u1.id = $id
    ")->get();

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

            DB::table('Friends')->where('user_id2', $id2)
                                ->where('user_id1',$id1)
                                ->delete();

            $data = [
                "success" => "The friend has been successfully deleted"
            ];

            echo json_encode($data);
        }
    }

    public function create(){
        $form = new Form();
        $date = $form->post('friend_date');
        $user1 = $form->post('friend_user_id1');
        $user2 = $form->post('friend_user_id2');
        $data = [
            'friend_date' => $date,
            'friend_user_id1' => $user1,
            'friend_user_id2' => $user2
        ];

        DB::table('Friends')->insert($data);
        $message = [
            "success" => "The user has been successfully created"
        ];

        echo json_encode($message);


    }

}