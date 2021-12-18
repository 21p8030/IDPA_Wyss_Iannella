<?php
namespace M151\Controller;

class Controller {
    /*  Hier wird beim Base Controller im Konstruktor eine
        Methode aufgerufen die überprüft ob der User bereits
        eingeloggt ist oder nicht, somit spart man sich auf
        jeder neuen Seite wieder eine neue Abfrage zu schreiben
    */
    public function __construct() {
        session_start();
        //$this->AuthMethod();
    }

    public function AuthMethod()
    {
        if (empty($_SESSION['username'])) {
            header("Location:/login");
        }
    }
}
