<?php
namespace M151\Controller;

use M151\Http\Request;
use M151\View\View;
use PDO;

class DefaultController extends Controller {
    public function index(Request $req) {
        header('Content-Type: text/plain');
        echo "Route: {$req->urlRoute}\n";
        foreach($req->getParams() as $key=>$value) {
            echo "Param: {$key} => {$value}\n";
        }
    }

    public function demo(Request $req) {
        $view = new View('default-demo.html');
        $view->assign('route',$req->urlRoute);
        $view->assign('params',$req->getParams());
        $view->render();
    }

    public function dbtest(Request $req){
        // DB Parameter definieren:
        $dsn = 'mysql:host=db;port=3306;dbname=m151';
        $username = 'm151';
        $password = 'm151';
        $options = array(
            // Wichtig: damit die Daten als utf-8 codierte Strings geliefert werden
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );

        // Datenbankverbindung aufbauen:
        $dbh = new PDO($dsn, $username, $password, $options);
        // $dbh ist eine Referenz auf das PDO-Objekt, also unseren Datenbank-Handler
        if ($dbh) {
        echo "Erfolg! Datenbankverbindung hergestellt";
        } else {
        echo "Oops! Da ging was schief!";
        }



        $stm = $dbh->query("SELECT * FROM benutzer");
        if($stm !== false){
            $resultat = $stm->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($resultat as $line){
                echo "Username: {$line['login']}<br>";
            }
            //var_dump($resultat);
        }

        $res = $dbh->exec("UPDATE benutzer SET email = 'neue@email.com' WHERE id = 1");

        $res = $dbh->exec("INSERT INTO benutzer (login, passwort, name) VALUES ('test', 'test', 'test')");

        return $dbh;
    }
}
