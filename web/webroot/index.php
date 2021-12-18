<?php

use M151\Application;
use M151\Controller\DefaultController;
use M151\Controller\DemoController;
use M151\Controller\LoginController;
use M151\Controller\ModelDemoController;
use M151\Controller\UserController;
use M151\Controller\WeatherController;
use M151\Controller\ThreadController;
use M151\Controller\CategoriesController;
use M151\Controller\PostController;
use M151\Controller\TagsController;
use M151\Router;

# lade composer autoloader:
require_once __DIR__ . '/../vendor/autoload.php';

# Router instanzieren:
$router = new Router();

# Hier werden die Routen definiert
// $router->get('/', DefaultController::class, 'index');

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
$router->any('/geheim', LoginController::class, 'geheim');


$router->any('/ModelDemoController', ModelDemoController::class, 'index');

$router->any('/Weather', WeatherController::class, 'test');
$router->any('/Weather2', WeatherController::class, 'getWeather');






$router->any('/', UserController::class, 'index');
$router->any('/index', UserController::class, 'index');

$router->any('/myThreads', UserController::class, 'myThreads');
$router->any('/user', UserController::class, 'userPage');
$router->any('/logout', UserController::class, 'logout');

$router->any('/thread', ThreadController::class, 'showThread');
$router->any('/createThread', ThreadController::class, 'createThread');
$router->any('/allThreads', ThreadController::class, 'showAllThreads');
$router->any('/deleteThread', ThreadController::class, 'delThread');

$router->any('/deletePost', PostController::class, 'delPost');

$router->any('/categories', CategoriesController::class, 'showCategories');
$router->any('/category', CategoriesController::class, 'ByCategoryName');

$router->any('/tags', TagsController::class, 'showTags');
$router->any('/tag', TagsController::class, 'showThreadByTag');


# Start der Applikation!
$app = new Application($router);
$app->start();