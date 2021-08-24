<?php
namespace M151\Entity;

class Benutzer {
    public $login;
    private $passwort;

    public function setPassword($plaintextPW) {
        $passwort = $plaintextPW;
        echo "\n\n".$passwort;
    }
}
