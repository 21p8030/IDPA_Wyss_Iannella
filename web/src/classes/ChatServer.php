<?php

namespace M151;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class ChatServer implements MessageComponentInterface {

    private $conns = [];

    public function __construct() {
        echo "Server started.\n";
    }
    public function onOpen(ConnectionInterface $conn) {
        $this->conns[$conn->resourceId] = [
            'conn' => $conn,
            'username' => null
        
        ];
        //echo "Connection opened\n";
        echo "Connection opened: ID: {$conn->resourceId}\n";
    }
    public function onMessage(ConnectionInterface $from, $msg) {
        $msgObj = json_decode($msg);
        var_dump($msgObj);

        switch($msgObj->type){
            case 'login':
                $login = $msgObj->data;
                $this->conns[$from->resourceId]['username'] = $login;
                break;

            case 'message':

                break;
        }



        echo "Message received: $msg\n";
        //$from->send('Hello, Back!');
        foreach($this->conns as $c){
            $c->send("Client with Id {$from->resourceId} : {$msg}");
        }
    }
    public function onClose(ConnectionInterface $conn) {
        unset($this->clients[$conn->resourceId]);
        //echo "Connection closed\n";
        echo "Connection closed: {$conn->resourceId}\n";
    }
    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Connection error: {$e->getMessage()}\n";
    }
}