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

$router->any('/login', LoginController::class, 'loginForm');
$router->any('/login_try', LoginController::class, 'login_try');

$router->any('/', UserController::class, 'index');
$router->any('/index', UserController::class, 'index');

$router->any('/myThreads', UserController::class, 'myThreads');
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