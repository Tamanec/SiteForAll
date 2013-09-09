<?php


namespace Den\MVC;


interface ControllersFactory {

    public function createController($controllerName);

}