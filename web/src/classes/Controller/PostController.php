<?php
namespace M151\Controller;

use M151\Http\Request;
use M151\Model\Benutzer;
use M151\Model\Category;
use M151\Model\Post;
use M151\Model\Thread;
use Smarty;

class PostController extends Controller {
    //Ich lösche hier der einfacherheits halber gleich alle Posts welche hirarchisch unter dem zu löschenden Post stehen auch wenn
    // der User diese nicht selber verfasst hat, eine alternative wäre gewesen einfach dem Post alle Daten zu entfernen also den Body 
    //und wer den geschrieben hat und dann einfach anzuzeigen dieser Beitrag wurde durch den user gelöscht
    // jedoch habe ich mich hier dagegen entschieden da sonst die Datenbank immer gerösser wird.
    public function delPost(Request $req){
        $PostId = null;
        if ($req->getParam('id')) {
            $PostId = $req->getParam('id');
        } else {
            header("Location:/allThreads");
            return;
        }

        $AnswerIDs = [];

        $Post = new Post();
        $postData = $Post->getByPostId($PostId);
        $this->getAllAnswers($Post, $postData[0], $AnswerIDs);
        //var_dump($AnswerIDs);
        foreach(array_reverse($AnswerIDs) as $ID) {
            var_dump($ID);
            $Post->deletePost($ID);
        }
    }

    public function getAllAnswers($Post, $Answer, &$AnswerIDs){
        array_push($AnswerIDs, $Answer->PostId);
        $Answers = $Post->getAnswersByPostId($Answer->PostId);
        foreach ($Answers as $DeeperAnswer) {
            $this->getAllAnswers($Post, $DeeperAnswer, $AnswerIDs);
        }
    }
}