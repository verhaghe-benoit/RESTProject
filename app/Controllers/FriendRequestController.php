<?php


namespace App\Controllers;
use Enaylal\Controller;
use \DB;
use DateTime;
use Enaylal\Form;
use Pixie\Exception;

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
        $form = new Form();
        $dt = new DateTime();


        $user1 = $form->post('user_IdRequester');
        $user2 = $form->post('user_IdRequestee');
        $data = [
            'request_date' => $dt->format('Y-m-d H:i:s'),
            'user_IdRequester' => $user1,
            'user_IdRequestee' => $user2
        ];
       $found = DB::query('SELECT * FROM FriendsRequest
                            WHERE (user_IdRequestee = ? AND user_IdRequester = ?) OR (user_IdRequestee = ? AND user_IdRequester = ?)',array($user1,$user2,$user2,$user1));
       if(empty($found->get())){
              DB::table('FriendsRequest')->insert($data);



       } else {
           echo "ça marche pas";

       }


    }

    public function requested($id)
    {
        $POTOS = DB::query("SELECT * FROM FriendsRequest
        INNER JOIN user ON user.id = FriendsRequest.user_IdRequester
        WHERE FriendsRequest.user_IdRequestee = $id
        ")->get();

        if(!empty($POTOS)) {
            echo json_encode($POTOS);
        } else {
            echo json_encode(['error'=> 'TA PAS DAMI AHAH']);
        }

    }
}