<?php
namespace M151\Controller;

use M151\Http\Request;
use M151\View\View;

class LoginController extends Controller {
    /**
    * Ein HTML-Formular ausliefern
    */
    public function loginForm(Request $req) {
        $error = false;
        // Wurden wir ev. von einem felhgeschlagenen Login hierher geleitet?
        if ($req->getParam('failed')) {
            $error = 'Login-Fehler!';
        }
        // View (Login-Form) instanzieren, ausgeben:
        $view = new View('login-form.html');
        $view->assign('error', $error);
        $view->render();
    }

    public function login_try() {
        // Auslesen der POST-Parameter, "the PHP Way":
        $login = $_POST['login'];
        $passwort = $_POST['passwort'];
        echo "Ihre Eingabe: {$login}, {$passwort}";
        }
        
}
