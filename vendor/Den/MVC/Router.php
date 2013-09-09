<?php


namespace Den\MVC;


use Den\HTTP\Request;
use Den\HTTP\Response;

class Router {

    private $routes;

    /**
     * @var Route
     */
    private $route;

    /**
     * Загружает настроки путей
     *
     * @param $fileName Полное имя файла с настройками путей
     * @todo проверить валидность файла
     */
    public function loadRoutes($fileName) {
        $this->routes = parse_ini_file($fileName, true);
    }

    /**
     * @param $uri
     */
    public function createRoute($uri, ControllersFactory $controllersFactory) {
        $routeParts = $this->parseURI($uri);
        $this->route = new Route(
            $controllersFactory->createController($routeParts["controllerName"]),
            $routeParts["actionName"]
        );
    }

    public function processRequest(Request $request, Response $response) {
        $this->route->process($request, $response);
    }

    /**
     * @return mixed
     */
    public function getRoutes() {
        return $this->routes;
    }

    /**
     * @return Route
     */
    public function getRoute() {
        return $this->route;
    }

    /**
     * @todo перенести магические цифры/слова в константы
     */
    private function parseURI($uri) {
        $routeParts = explode('/', $uri);
        $controllerName = (!empty($routeParts[0])) ? $routeParts[0] : 'MainPage';
        $actionName = (!empty($routeParts[1])) ? $routeParts[1] : 'index';

        if (!$this->isProperURI($controllerName, $actionName)) {
            $controllerName = "PageNotFound";
            $actionName = "index";
        }

        return array(
            "controllerName" => $controllerName,
            "actionName" => $actionName
        );
    }

    private function isProperURI($controller, $action) {
        return (
            array_key_exists($controller, $this->routes) &&
            array_key_exists($action, $this->routes[$controller])
        );
    }

}
