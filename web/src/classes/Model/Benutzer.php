<?php

namespace M151\Model;

class Benutzer extends Model {
    public const DB_TABLE = 'benutzer';
    public const DB_COLS = ['id','login', 'passwort','name','vorname','email','letzter_login', 'register_date'];

    public $name;
    public $vorname;
    public $login;
    public $passwort;
    public $email;
    public $letzter_login;
    public $register_date;

    public function findByLogin($login) {
        return static::findByProperty('login', $login);
    }
    public function getTable() {
        return 'benutzer';
    }

    /**
     * Liefert die Spalten der Tabelle mit den Datentypen dazu
     * (array(spaltenname => typ))
     */
    public function getColumns() {
        return array(
            'id' => 'int',
            'login' => 'string',
            'passwort' => 'string',
            'name' => 'string',
            'vorname' => 'string',
            'email' => 'string',
            'letzter_login' => 'timestamp',
        );
    }
    public function getIdColumn() {
        return 'id';
    }

    public function getAktiveBenutzer() {
        return $this->query("letzter_login >= NOW() - INTERVAL 1 MONTH");
    }
    public function getUserByLogin($login) {
        $safeLogin = $this->conn->quote($login);
        $res = $this->query("login = {$safeLogin}");
        if (!empty($res)) {
            return $res[0];
        }
    }

    public function updateLoginTimestamp($userId) {
        return $this->save((int) $userId, [
            'letzter_login' => date('Y-m-d H:i:s'),
        ]);
    }

    public function Login($login, $passwort){
        $user = $this->getUserByLogin($login);
        if(password_verify($passwort, $user->passwort)){
            return true;
        } else {
            return false;
        }

    }

    public function getUserCount(){
        $data = $this->countQuery(null, null, null, null, 'count');
        return $data;
    }

    public function getCurrentUserId(){
        $user = $this->getUserByLogin($_SESSION['username']);
        return $user->id;
    }

    public function getById($UserId){
        $data = $this->query("id = {$UserId}");
        return $data;
    }
}
