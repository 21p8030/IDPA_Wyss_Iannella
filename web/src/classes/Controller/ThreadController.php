<?php
namespace M151\Controller;

use M151\Http\Request;
use M151\Model\Benutzer;
use M151\Model\Category;
use M151\Model\Post;
use M151\Model\Thread;
use M151\Model\Tags;
use M151\Controller\TagsController;
use Smarty;

class ThreadController extends Controller {
    public function showThread (Request $req){

        $PostsHighestData = null;
        $PostAnswers = null;
        $newPostId = null;
        $userId = null;
        $TagsData = null;

        $Posts = new Post();

        $ThreadId = null;
        if ($req->getParam('id') && preg_match("/^\d+$/", $req->getParam('id'))) {
            $ThreadId = $req->getParam('id');
        } else {
            header("Location:/allThreads");
            return;
        }

        $Threads = new Thread();
        $threadData = $Threads->getByThreadId($ThreadId);

        $User = new Benutzer();
        $userdata = $User->getById($threadData[0]->UserId);

        $view = new Smarty();
        $view->setTemplateDir(__DIR__.'/../../views/');

        $Tags = new Tags();

        $TagsDataFull = [];
        $TagsData = $Tags->getByThreadId($ThreadId);
        foreach($TagsData as $tag){
            array_push($TagsDataFull, $Tags->getByName("'".$tag['name']."'"));
        }

        if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
            $userId = $User->getUserByLogin($_SESSION['username'])->id;
            if (!empty($_POST)){
                $data["ThreadId"] = $ThreadId; 
                $data["UserId"] = $userId; 
                $data["AnswerId"] = ($_POST["AnswerId"] !== "") ? $_POST["AnswerId"] : "NULL"; 
                $data["Date"] = date('Y-m-d H:i:s'); 
                $data["Body"] = $_POST["body"]; 
                $newPostId = $Posts->storeNewPost($data);
            }

            $PostAnswers = $Posts->getAnswersByThreadId($ThreadId);

            $PostsHighestData = $Posts->getHighestByThreadId($ThreadId);

            foreach ($PostAnswers as $Answers) {
                $Answers->UserName = $User->getById($Answers->UserId)[0]->login;
                $Answers->register_date = $User->getById($Answers->UserId)[0]->register_date;
            }
            foreach ($PostsHighestData as $Answer) {
                $Answer->UserName = $User->getById($Answer->UserId)[0]->login;
                $Answer->register_date = $User->getById($Answer->UserId)[0]->register_date;
            }   
        }

        $view->assign('threadData', $threadData);
        $view->assign('tagData', $TagsDataFull);
        $view->assign('ThreadUser', $userdata);
        $view->assign('PostsData', $PostsHighestData);
        $view->assign('AnswersData', $PostAnswers);
        $view->assign('showForm', false);
        $view->assign('newPostId', $newPostId);
        $view->assign('LoggedInUserId', $userId);
        $view->display('thread.smarty');
    }

    public function createThread() {

        if(isset($_SESSION['username']) && !empty($_SESSION['username'])){

            $catsData = new Category();
            $categories = $catsData->getAllCategorys();

            $User = new Benutzer();
            $userId = $User->getUserByLogin($_SESSION['username'])->id;

            $tags = new Tags();
            $tagsData = $tags->getAllTags();

            $Thread = new Thread();
            $TC = new TagsController();

            if (!empty($_POST)){
                $data["UserId"] = $userId; 
                $data["Date"] = date('Y-m-d H:i:s'); 
                $data["Title"] =  $_POST["title"]; 
                $data["Body"] = $_POST["body"]; 
                $data["Category"] = $_POST["category"];
                $newThreadId = $Thread->storeNewThread($data);
                $catsData->UpdateThreadCount($_POST["category"]);
                $TC->TagsVerarbeitung($_POST['tags'], $newThreadId);
                header("Location:/thread?id=".$newThreadId);
            }


            $view = new Smarty();
            $view->setTemplateDir(__DIR__.'/../../views/');
            $view->assign('categories', $categories);
            $view->assign('tags', $tagsData);
            $view->display('create_thread.smarty');
        }else {
            header("Location:/");
        }
    }

    public function showAllThreads(){
        $Thread = new Thread();
        $threadData = $Thread->getAllThreads();
        $view = new Smarty();
        $view->setTemplateDir(__DIR__.'/../../views/');
        $view->assign('threadData', $threadData);
        $view->display('allthreads.smarty');
    }

    public function delThread(Request $req) {
        $ThreadId = null;
        if ($req->getParam('id')) {
            $ThreadId = $req->getParam('id');
        } else {
            header("Location:/allThreads");
            return;
        }

        $Cat = new Category();
        $Post = new Post();

        $Threads = new Thread();
        $thread = $Threads->getByThreadId($ThreadId);

        $User = new Benutzer();
        $userId = $User->getUserByLogin($_SESSION['username'])->id;

        if($thread[0]->UserId === $userId) {
            $posts = $Post->getByThreadId($ThreadId);
            if($posts) {
                foreach (array_reverse($posts) as $post) {
                    $Post->deletePost($post->PostId);
                }
            }
            $Category = $Threads->getByThreadId($ThreadId)[0]->Category;
            $Threads->deleteThread($ThreadId);
            $Cat->UpdateThreadCount($Category, true);
        }
        header("Location:/");        
    }
}