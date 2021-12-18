<?php
namespace M151\Controller;

use M151\Http\Request;
use M151\Model\Benutzer;
use Smarty;

class LoginController extends Controller {

    public function __construct() {
        session_start();
        if (!empty($_SESSION['username'])) {
            //der User ist ja schon eingeloggt also können wir ihn auf die Userseite weiterleiten
            header("Location:/");
        }
    }

    public function loginForm(Request $req) {
        //var_dump($_SESSION['username']);
        $error = false;
        // Wurden wir ev. von einem felhgeschlagenen Login hierher geleitet?
        if ($req->getParam('failed')) {
            $error = 'Login-Fehler!';
        }
        
        // View (Login-Form) instanzieren, ausgeben:
        $view = new Smarty();
        $view->setTemplateDir(__DIR__.'/../../views/');
        $view->assign('error', $error);
        $view->display('login-form.smarty');
    }

    public function login_try() {
        $username = $_POST['login'];
        $password = $_POST['passwort'];

        $login = new Benutzer();
        $check = $login->Login($username, $password);

        if($check){
            $_SESSION['username'] = $username;
            $_SESSION['login_time'] = date('Y-m-d H:i:s');
            header("Location:/");
        } else {
            header("Location:/login?failed=true");
        }
    }
}
