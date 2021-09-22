<?php

namespace M151;

use M151\Http\Request;

class Application {
    private $router = null;

    public $request = null;
    public $controller = null;
    public $routeInfo = null;

    public function __construct(Router $router) {
        $this->router = $router;
        // Wir verpacken den "rohen" PHP-Request in eine Request-Helper-Klasse:
        $this->request = new Request($_REQUEST, $_SERVER);
    }
    public function start() {
        try {
            // Wir beauftragen den Router mit dem Finden der route anhand des Requests:
            $routeInfo = $this->router->findRouteInfo($this->request);

            // Haben wir eine? Super, dann extrahieren wir Controller/Methoden-Namen:
            $controller = $this->router->getRouteController($routeInfo);
            $this->controller = $controller;
            $this->routeInfo = $routeInfo;
            $actionFn = $routeInfo['action'];


            // ... und rufen den Controller / die Action-Methode darin auf!
            $ret = $controller->$actionFn($this->request);
        } catch (\Exception $e) {
            http_response_code(400);
            echo 'ERROR: ' . $e->getMessage();
        }
    }
}