<?php

use components\pages\controllers\MainPageController;
use components\pages\controllers\PageControllersFactory;
use components\pages\controllers\PageNotFoundController;
use Den\HTTP\Request;
use Den\HTTP\Response;
use Den\MVC\Router;

require dirname(__FILE__) . "/../../../bootstrap.php";

$router = new Router();
$controllersFactory = new PageControllersFactory();

echo "\nDen\\MVC\\Router test\n\n";

/**
 * Check for load routes list from ini-file
 */
$routesList = "{$root}/tests/components/routes/routesListTest.ini";
$router->loadRoutes($routesList);
$routes = $router->getRoutes();
$result = ($routes["MainPage"]["index"] == "/") ? "ok" : "fail";
echo "Test 1 \"Load routes list\" .. {$result}\n";
exitOnFail($result);

/**
 * Check for create route
 */
$router->createRoute("/", $controllersFactory);
$route = $router->getRoute();
$result = (
    $route->getController() instanceof MainPageController &&
    $route->getActionName() == "indexAction"
) ? "ok" : "fail";

echo "Test 2 \"Create route for main page\" .. {$result}\n";
exitOnFail($result);

$router->createRoute("/any/wronge/url", $controllersFactory);
$route = $router->getRoute();
$result = (
    $route->getController() instanceof PageNotFoundController &&
    $route->getActionName() == "indexAction"
) ? "ok" : "fail";

echo "Test 3 \"Create wronge route \" .. {$result}\n";
exitOnFail($result);

/**
 * Check navigation
 */
$router->createRoute("/", $controllersFactory);
ob_start();
$router->processRequest(new Request(), new Response());
$output = ob_get_clean();

$result = (substr_count($output, "MainPageController")) ? "ok" : "fail";
echo "Test 4 \"Check navigation\" .. {$result}\n";
exitOnFail($result);

echo "\nTest complete!\n\n";


function exitOnFail($result) {
    if ($result == "fail") {
        exit("\nTest fail!\n\n");
    }
}
