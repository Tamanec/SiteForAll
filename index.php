<?php

use components\pages\controllers\PageControllersFactory;
use Den\Autoloader;
use Den\HTTP\Request;
use Den\HTTP\Response;
use Den\MVC\Router;

require "vendor/autoload";
require "vendor/Den/Autoloader.php";

$root = dirname(__FILE__) . DIRECTORY_SEPARATOR;
new Autoloader(
    array(
        $root . "/",
        $root . "vendor",
    )
);

$router = new Router();
$router->loadRoutes("{$root}/components/routes/routesList.ini");
$router->createRoute($_SERVER['REQUEST_URI'], new PageControllersFactory());
$router->processRequest(new Request(), new Response());
