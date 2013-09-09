<?php


namespace components\pages\controllers;


use Den\HTTP\Request;
use Den\HTTP\Response;
use Den\MVC\Controller;

class MainPageController extends Controller {

    public function indexAction(Request $request, Response $response) {
        echo "MainPageController::indexAction()\n";
    }

}