<?php

namespace M151\Controller;

use M151\Http\Request;
use M151\Model\Benutzer;
use M151\Model\Category;
use M151\Model\Thread;
use M151\Model\Post;
use Smarty;

class UserController extends Controller{
    public function index (){
        $categorys = new Category();
        $CategorysData = $categorys->getAllCategorys();

        $statsCounter = [0, 0, 0];

        //mehrere Models werden hier verwendet um die Statistiken zusammenzubauen
        $threads = new Thread();
        $statsCounter[0] = $threads->getThreadsCount();

        $posts = new Post();
        $statsCounter[1] = $posts->getPostsCount();

        $users = new Benutzer();
        $statsCounter[2] = $users->getUserCount();


        $view = new Smarty();
        $view->setTemplateDir(__DIR__.'/../../views/');
        $view->assign('CategorysData', $CategorysData);
        $view->assign('stats', $statsCounter);
        $view->display('index.smarty');
    }

    public function userpage() {

    }

    public function myThreads() {
        $user = new Benutzer();
        $userId = $user->getCurrentUserId();

        $threads = new Thread();
        $threadData = $threads->getByUserId($userId);
        $view = new Smarty();
        $view->setTemplateDir(__DIR__.'/../../views/');
        $view->assign('threads', $threadData);
        $view->display('myThreads.smarty');
    }

    public function logout(){
        unset($_SESSION['username']);
        header("Location:/");
    }
}