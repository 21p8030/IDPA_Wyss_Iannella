<?php

use M151\Application;
use M151\Controller\DefaultController;
use M151\Controller\DemoController;
use M151\Controller\LoginController;
use M151\Router;

# lade composer autoloader:
require_once __DIR__ . '/../vendor/autoload.php';

# Router instanzieren:
$router = new Router();

# Definiere Routen:
$router->get('/', DefaultController::class, 'index');

// View-Demo: manuell, ohne View-Klasse:
$router->any('/viewdemo/manual', DemoController::class, 'manual');
// View-Demo: eigene View-Klasse:
$router->any('/viewdemo/own-view', DemoController::class, 'ownView');
// View-Demo: Smarty Template Engine:
$router->any('/viewdemo/engine', DemoController::class, 'smartyView');
// View-Demo: JSON-View / Response:
$router->any('/viewdemo/json', DemoController::class, 'jsonView');
$router->any('/demo', DefaultController::class, 'demo');

$router->any('/dbtest', DefaultController::class, 'dbtest');

$router->any('/login', LoginController::class, 'loginForm');
$router->any('/login_try', LoginController::class, 'login_try');

# Start der Applikation!
$app = new Application($router);
$app->start();