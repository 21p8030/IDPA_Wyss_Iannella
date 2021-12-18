<?php

namespace M151;

class DBH {
    private static $_inst;
    private $_dbConn;

    public static function getInstance() {
        if (!static::$_inst) {
            static::$_inst = new static();
        }
        return static::$_inst;
    }

    /**
     * Im Konstruktor wird die DB-Connection einmal (Singleton) aufgebaut.
     */
    private function __construct() {
        // DB Parameter definieren: (Dies macht man normalerweise NICHT im Code, sondern in einem Config-file!)
        $dsn = 'mysql:host=db;port=3306;dbname=m151';
        $username = 'm151';
        $password = 'm151';
        $options = array(
            // Wichtig: damit die Daten als utf-8 codierte Strings geliefert werden
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );

        // Datenbankverbindung aufbauen:
        $this->_dbConn= new \PDO($dsn, $username, $password, $options);
    }

    /**
     * Hier wird immer wieder die selbe, eine Connection zurückgeliefert
     */
    public function getConnection() {
        return $this->_dbConn;
    }
}
