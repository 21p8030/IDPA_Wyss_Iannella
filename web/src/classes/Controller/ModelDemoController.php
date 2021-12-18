<?php

namespace M151\Controller;

use M151\DBH;
use M151\Http\Request;
use M151\Model\Benutzer;

class ModelDemoController extends Controller {
    public function index(Request $req) {
        header('Content-Type: text/plain');

        // ----- Einzelner Datensatz: ------
        echo "Hole einzelnen Benutzer by ID (1):\n";
        $res = Benutzer::findById(1);
        var_dump($res);
        // ----- Mehrere Datensätze: ------
        echo "\n\n\nHole mehrere Datensatz by SQL-Filter:\n";

        //                    Filter               Order
        $res = Benutzer::query("name = 'Beutlin'", 'name, vorname');
        var_dump($res);


        // Neuen Benutzer anlegen:
        $b = new Benutzer();
        $b->login = 'foo4';
        $b->letzter_login = date('Y-m-d');
        $b->save();

        var_dump($b);

        // bestehendes Objekt ändern und wieder speichern:
        $b->name = "Skywalker";
        $b->save();
        var_dump($b);
    }
}
