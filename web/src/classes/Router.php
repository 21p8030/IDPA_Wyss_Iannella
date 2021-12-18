<?php

namespace M151;

use M151\Http\Request;

class Router {
    private $_routes = [];

    public function addRoute($route, $httpMethod, $controllerClass, $actionFn) {
        $this->_routes[] = [
            'method' => $httpMethod,
            'route' => $route,
            'controller' => $controllerClass,
            'action' => $actionFn,
        ];
    }

    public function get($route, $controllerClass, $actionFn) {
        $this->addRoute($route, 'GET', $controllerClass, $actionFn);
    }

    public function post($route, $controllerClass, $actionFn) {
        $this->addRoute($route, 'POST', $controllerClass, $actionFn);
    }

    public function put($route, $controllerClass, $actionFn) {
        $this->addRoute($route, 'PUT', $controllerClass, $actionFn);
    }

    public function delete($route, $controllerClass, $actionFn) {
        $this->addRoute($route, 'DELETE', $controllerClass, $actionFn);
    }

    public function any($route, $controllerClass, $actionFn) {
        $this->addRoute($route, null, $controllerClass, $actionFn);
    }

    public function findRouteInfo(Request $req) {
        $route = $req->urlRoute;
        $method = $req->method;

        foreach ($this->_routes as $routeInfo) {
            // Einfachste Variante: Wir matchen die Route 1:1: Es kommen also
            // keine dynamischen Teile vor.
            // Beispiel einer dynamischen Route wäre:
            // '/user/{:id}' --> hier wäre {:id} der dynamische Teil, welcher die Routen
            // '/user/5' oder '/user/alex' abdecken könnte.
            if ($routeInfo['route'] === $route && ($routeInfo['method'] === null || $method === $routeInfo['method'])) {
                //var_dump($routeInfo);
                return $routeInfo;
            }
        }
        throw new \Exception('No route found for ' . $method . '::' . $route);
    }

    public function getRouteController($routeInfo) {
        $ctrl = $routeInfo['controller'];
        $c = new $ctrl();
        return $c;
    }
}