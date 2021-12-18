<?php
namespace M151\Controller;

class Controller {
    /*  Hier wird beim Base Controller im Konstruktor die Methode session_start aufgerufen
    *   um die Session nicht in jedem Controller aufs neue starten zu müssen
    */
    public function __construct() {
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
    }

}
