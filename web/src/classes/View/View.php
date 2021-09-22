<?php
namespace M151\View;

use M151\Application;

class View {
    protected $_data = [];
    protected $_viewFile = null;

    public $contentType = 'text/html';

    /**
     * Der Konstruktur übernimmt den Pfad zu einem Template-File: Dieses
     * wird später (in render()) ausgefüllt und ausgegeben.
     */
    public function __construct($viewFile) {
        $this->_viewFile = $viewFile;
    }

    /**
     * assign() dient zum Definieren von Daten für die View ("Model").
     * Der Key definiert den Variablennamen, den wir im View-Template verwenden können.
     */
    public function assign($key, $value) {
        $this->_data[$key] = $value;
    }

    /**
     * render() füllt das Template aus (mittels fetch()), und gibt das fertige HTML
     * direkt aus.
     */
    public function render() {
        header('Content-Type: '.$this->contentType);
        echo $this->fetch();
    }

    /**
     * fetch() erzeugt das HTML aus der Vorlage, und gibt das HTML via Rückgabewert zurück.
     */
    public function fetch() {
        // Einlesen des Template-Files:
        $path = realpath(__DIR__.'/../../views');
        $file = realpath($path.'/'.$this->_viewFile);
        if (!file_exists($file)) {
            throw new \Exception('View file not found: '.$file.' in '.$path);
        }

        // extract macht die zugewiesenen Model-Variablen im Template zugänglich:
        // es erzeugt aus dem Dictionnary $this->_data alles lokale Variablen mit dem namen des key.
        // So hat das Template Zugang zu allen Variablen, welche man mit assign() definiert hat.
        extract($this->_data);

        // ob_start startet das "Output-Buffering": Alle Ausgaben, welche sonst an den Browser
        // geschickt werden, werden so vorerst zurückgehalten, und wir können sie später auslesen
        ob_start();
        // wir laden das Template-File als PHP-Include: Somit wird das File als PHP-Script interpretiert,
        // und wir können alle mit extract() definierten Variablen darin benutzen.
        // Das inkludierte PHP-File wird direkt interpretiert / ausgeführt:
        include($file);

        // include hat bereits HTML-Code erzeugt. Dieser wird aber dank ob_start() nicht ausgegeben,
        // sondern gepuffert. Mit ob_get_contents() können wir nun diesen Puffer auslesen.
        $out = ob_get_contents();

        // wir verwerfen den Puffer, wir wollen keine direkte Ausgabe:
        ob_end_clean();

        // wir geben das ausgelesene HTML zurück.
        return $out;
    }
}

