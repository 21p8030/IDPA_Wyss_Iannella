<?php

namespace M151;

use M151\Http\Request;
use M151\View\View;
use Smarty;

class Person{
    public function hello(){
        echo "<h1>Hello World</h1>";
    }

    public function list(){
        header('X-My-Fancy-Header: mooo');

        echo "Hier hast du die Liste";
    }

    public function smartyView(/*Request $req*/){
            $view = new Smarty();
            $view->setTemplateDir(__DIR__.'/View/');
            // $view->assign('route', $req->urlRoute);
            // $view->assign('params', $req->getParams());
            $view->display('smarty-demo.html');
    }
}
