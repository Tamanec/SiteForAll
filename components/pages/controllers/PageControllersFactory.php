<?php


namespace components\pages\controllers;


use Den\MVC\ControllersFactory;

class PageControllersFactory implements ControllersFactory {

    /**
     * @param $controllerName
     * @return Controller
     */
    public function createController($controllerName) {
        $fullControllerName = "\\" . __NAMESPACE__ . "\\" . $controllerName . "Controller";
        return new $fullControllerName();
    }

}