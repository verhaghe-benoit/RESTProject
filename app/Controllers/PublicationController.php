<?php


namespace App\Controllers;
use DateTime;
use Enaylal\Controller;
use \DB;
use Enaylal\Form;

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
        $publication = DB::table('Publication')->where('publication_user_id', $id)->get();
        echo json_encode($publication);
    }

    public function user_publication($id){

        $publications = DB::query("SELECT * FROM Publication 
        INNER JOIN user ON user.id = Publication.publication_user_id
        WHERE user.id = $id
    ")->get();

        if(!empty($publications)) {
            echo json_encode($publications);
        } else {
            echo json_encode(['error'=> 'sorry that user has no publication']);
        }
    }

    public function delete($id){

        $method = strtolower($_SERVER['REQUEST_METHOD']);

        if($method == "delete"){
            DB::table('Publication')->where('publication_id', $id)->delete();
            DB::table('Comment')->where('comment_publication_id',$id)->delete();

            $data = [
                "success" => "Publication and Comments of the publication successfully deleted"
            ];

            echo json_encode($data);
        }
    }

    /**
     *
     */
    public function create(){

        $dt = new DateTime();
        $form = new Form();

        $publication_content = $form->post('publication_content');

        $publication_user_id = $form->post('publication_user_id') ;


        $data = [
            'publication_content' => $publication_content,
            'publication_date' => $dt->format('Y-m-d H:i:s'),
            'publication_user_id' => $publication_user_id
        ];


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