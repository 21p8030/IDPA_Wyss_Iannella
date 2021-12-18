<?php
namespace M151\Controller;

use M151\Http\Request;
use M151\Model\Category;
use M151\Model\Thread;
use Smarty;

class CategoriesController extends Controller {
    public function showCategories (Request $req){

        $categorys = new Category();
        $CategorysData = $categorys->getAllCategorys();

        $view = new Smarty();
        $view->setTemplateDir(__DIR__.'/../../views/');
        $view->assign('CategorysData', $CategorysData);
        $view->display('categories.smarty');
    }

    public function ByCategoryName(Request $req){
        if ($req->getParam('name')) {
            $CategoryName = $req->getParam('name');
            $Threads = new Thread();
            $ThreadData = $Threads->getByCategory($CategoryName);
            $view = new Smarty();
            $view->setTemplateDir(__DIR__.'/../../views/');
            $view->assign('threadData', $ThreadData);
            $view->assign('Name', $CategoryName);
            $view->display('allthreads.smarty');
        } else {
            header("Location:/categories");
            return;
        }
    }
}