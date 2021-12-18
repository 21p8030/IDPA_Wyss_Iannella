<?php

namespace M151\Model;

use Exception;
use M151\DBH;
use PDO;

/**
 * Die Parent-Model-Klasse: Sie stellt die Basis für unser ActiveRecord-Pattern dar:
 * Sie stellt generische resp. konfigurierbare Methoden zur Verfügung, welche von
 * den Kindklassen genutzt werden, um konkrete Modelle umzusetzen.
 * 
 * Sie stellt sowohl statische Methoden zum Erstellen / Finden von Records zur Verfügung,
 * wie auch Instanz-Methoden, um auf konkreten Instanzen Operationen auszuführen.
 */
abstract class Model {

    protected $conn = null;

    public function __construct() {
        // Hier holen wir die PHP PDO-Connection: DBH im Beispiel ist eine Singleton-Klasse,
        // welche die Connection einmal erstellt und dann zurückliefert: Bei mehrfachem Aufruf
        // wird somit immer dieselbe PDO-Instanz ausgeliefert:
        $this->conn = DBH::getInstance()->getConnection();
    }

    // Statische Attribute:
    /**
     * Definiert den SQL-Tabellenname als String (z.B. 'person').
     * Muss von Kindklassen entsprechend überschrieben werden.
     */
    public const DB_TABLE = null;

    /**
     * Liefert die Spaltennamen der Tabelle (z.B. ['id','name',...])
     * Muss von Kindklassen überschrieben werden.
     */
    public const DB_COLS = [];

    // Instanz-Attribute:
    // alle Models sollten ein id-Attribut haben:
    public $id = null;

    /**
     * Stellt ein komplettes SELECT-Query zusammen.
     * Achtung, es erfolgen KEINE Sichherheits-Massnahmen (SQL-Injection-anfällig)!
     * 
     * @return string ein fertiger SQL-String für SELECT
     */
    protected static function createSelectQuery($where = null, $orderBy = null, $limit = null, $offset = null) {
        // konfigurierte Spalten formen:
        $cols = join(',', static::DB_COLS);

        $table = static::DB_TABLE;
        // Select zusammenbauen:
        $sql = "SELECT {$cols} FROM {$table}";
        if ($where) {
            $sql .= " WHERE {$where}";
        }
        if ($orderBy) {
            $sql .= " ORDER BY {$orderBy}";
        }
        if ($limit) {
            $sql .= " LIMIT {$limit}";
        }
        if ($offset) {
            $sql .= " OFFSET {$offset}";
        }
        //var_dump($sql);
        return $sql;
    }

    /**
     * Dies wird verwendet um die Anzahl einträge in einer Tabelle anzuzeigen für die Statistiken auf der Startseite
     * 
     * @return int Die Anzahl Einträge welche es in einer Tabelle hat
     */
    public static function countQuery(){
        $table = static::DB_TABLE;
        $sql = "SELECT COUNT(*) FROM {$table}";
        $res = static::executeQuery($sql);
        return $res[0]['COUNT(*)'];
    }


    public static function selectTagsByThreadId($ThreadId){
        $table = static::DB_TABLE;
        $sql = "SELECT name FROM {$table}
            INNER JOIN ThreadTags ON ThreadTags.tagId = tags.id
            INNER JOIN threads ON threads.ThreadId = ThreadTags.IdThread
        WHERE threads.ThreadId = {$ThreadId};";
        $res = static::executeQuery($sql);
        return $res;
    }

    /**
     * Führt ein fertiges SQL-Query aus, und liefert das rohe Datenbank-Resultat.
     * Achtung, es erfolgen KEINE Sichherheits-Massnahmen (SQL-Injection-anfällig)!
     * 
     * @return array Ein Array mit den Datenbank-Rohdaten (Record als assoziativer Array)
     */
    protected static function executeQuery($query, $params = null) {
        // Wir holen uns eine DB-Connection vom DB-Singleton:
        $conn = DBH::getInstance()->getConnection();
        $stm = $conn->prepare($query);
        $valueNr = null;
        if ($params != null) {
            foreach ($params as $param) {
                $stm->bindValue($valueNr, $param);
                $valueNr++;
            }
        }
        $stm->execute();
        if ($stm) {
            $test = $stm->fetchAll(PDO::FETCH_ASSOC);
            //var_dump($test);
            return $test;
        } else {
            throw new Exception('DB Exception');
        }
    }

    /**
     * Erzeugt aus Datenbank-Rohdaten (einem Record) eine konkrete
     * Instanz einer Model-Klasse (z.B. Person), und füllt alle 
     * Instanz-Attribute ab.
     * 
     * @return Model eine konkrete Model-Instanz
     */
    public static function createModel($data) {
        // Konkrete Instanz wird erzeugt: static ist hier die aktuell benutzte Klasse.
        // Bsp: Benutzer::createModel erzeugt eine Instanz der Benutzer-Klasse:
        $model = new static();
        // Abfüllen der DB-Rohwerte:
        foreach ($data as $key => $value) {
            if (in_array($key, static::DB_COLS)) {
                $model->$key = $value;
            }
        }
        return $model;
    }


    /**
     * Ausführen eines Queries und Erzeugen der konkreten Model-Instanzen aus dem Resultat:
     * 
     * @param string $where der WHERE-Filter (z.B. "name like '%max%'")
     * @param string $orderBy die ORDER BY-Anweisung, z.B. "name ASC, datum DESC"
     * @return Model[] Ein Array mit Objektinstanzen
     */
    public static function query($where = null, $orderBy = null, $limit = null, $offset = null) {
        $sql = static::createSelectQuery($where, $orderBy, $limit, $offset);
        $res = static::executeQuery($sql);
        $retArr = [];
        if (!empty($res)) {
            // Für jeden Roh-DB-Record wird eine konkrete Model-Instanz erstellt:
            foreach ($res as $data) {
                $retArr[] = static::createModel($data);
            }
        }
        return $retArr;
    }

    /**
     * Sucht einen Record nach Wert einer Spalte (z.B. login = foo), und
     * gibt ein (das erste gefundene) konkretes Model zurück
     * 
     * @return Model das erste gefundene Model
     */
    public static function findByProperty($prop, $value) {
        $value = DBH::getInstance()->getConnection()->quote($value);
        $where = "{$prop} = {$value}";
        $res = static::query($where, null, 1);
        if (!empty($res)) {
            return $res[0];
        }
    }

    /**
     * Sucht einen Record nach id-Spalten-Wert, und
     * gibt ein konkretes Model zurück
     * 
     * @return Model das erste gefundene Model
     */
    public static function findById($id) {
        return static::findByProperty('id', $id);
    }

    /**
     * Instanz-Methode save(): speichert ein vorhandenes (oder neues?) Model
     */
    public function save() {
        // Müssen wir ein UPDATE oder INSERT-Query machen?
        if ($this->id > 0) {
            // Objekt ist schon in DB, da bereits eine ID vorhanden, also UPDATE:
            $this->update();
        } else {
            // Objekt ist noch nicht in DB, da noch keine ID vorhanden, also INSERT:
            $this->insert();
        }
    }

    // Instanz-Methode delete(): löscht das aktuelle Model aus der DB
    public function delete($value) {
        $conn = DBH::getInstance()->getConnection();

        // Hinweis: PDO::lastInsertId() liefert Ihnen die ID des zuletzt eingefügten Datensatzes.
        $table = static::DB_TABLE;
        switch ($table) {
            case 'threads':
                $delId = 'ThreadId';
                break;
            
            case 'posts':
                $delId = 'PostId';
                break;
            case 'categorys':
                $delId = 'name';
                break;
            default:
                $delId = 'id';
                break;
        }

        
        $query = "DELETE FROM {$table} WHERE {$delId} = {$value} ";

        $res = $conn->exec($query);
        if ($res === false) {
            throw new Exception('DB-Fehler: ' . print_r($conn->errorInfo(), true));
        }
    }

    protected function update() {
        $conn = DBH::getInstance()->getConnection();
        $table = static::DB_TABLE;
        $query = "UPDATE {$table} SET ";
        $id = (int) $this->id;
        $values = [];
        foreach (static::DB_COLS as $col) {
            $value = $conn->quote($this->$col);
            $values[] = "{$col} = {$value}";
        }
        $values = join(',', $values);
        $query .= " {$values} WHERE id = {$id}";
        $res = $conn->exec($query);
        if ($res === false) {
            throw new Exception('DB-Fehler: ' . print_r($conn->errorInfo(), true));
        }
    }

    // ich mache hier eine zweite Update funktion da ich bei den Kategorien die Namen als Primary Key verwende.
    protected function updateCatecories($name, $kind) {
        $conn = DBH::getInstance()->getConnection();
        $table = static::DB_TABLE;
        $query = "UPDATE {$table} SET ";
        $name = $name;
        $values = [];
        foreach (static::DB_COLS as $col) {
            $value = $conn->quote($this->$col);
            if($col !== "name"){
                if($col !== "numberOfThreads"){
                    $values[] = "{$col} = {$value}";
                } else {
                    if($kind){
                        $values[] = "{$col} = {$col} - 1";
                    }else {
                    $values[] = "{$col} = {$col} + 1"; 
                    }  
                }
            }
        }
        $values = join(',', $values);
        $query .= " {$values} WHERE name = {$conn->quote($name)}";
        $res = $conn->exec($query);
        if ($res === false) {
            throw new Exception('DB-Fehler: ' . print_r($conn->errorInfo(), true));
        }
    }

    protected function insert() {
        $conn = DBH::getInstance()->getConnection();

        // Hinweis: PDO::lastInsertId() liefert Ihnen die ID des zuletzt eingefügten Datensatzes.
        $table = static::DB_TABLE;

        //
        // Spalten ausser id holen. id können wir nicht einfügen, da noch nicht bekannt
        $cols = array_filter(static::DB_COLS, function ($col) {
            if($col === 'ThreadId' && static::DB_TABLE === 'posts'){
                return $col;
            }
            return $col !== 'PostId' && $col !== 'ThreadId' && $col !== 'id';
        });

        $colStr = join(',', $cols);
        $query = "INSERT INTO {$table} ($colStr) VALUES ";
        $values = [];
        foreach ($cols as $col) {
            $value = ($col !== "AnswerId") ? $conn->quote($this->$col) : $this->$col;
            $values[] = $value;
        }
        $values = join(',', $values);
        $query .= " ($values)";
        //var_dump($query);
        $res = $conn->exec($query);
        if ($res === false) {
            throw new Exception('DB-Fehler: ' . print_r($conn->errorInfo(), true));
        }
        // von DB eingefügte ID holen und setzen:
        $this->id = $conn->lastInsertId();
    }
}
