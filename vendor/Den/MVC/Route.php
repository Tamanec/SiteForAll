<?php

namespace Den\MVC;

use Den\HTTP\Request;
use Den\HTTP\Response;

class Route {

    /**
     * @var Controller
     */
    private $controller;

    /**
     * @var string
     */
    private $actionName;

    function __construct(Controller $controller, $actionName) {
        $this->controller = $controller;
        $this->actionName = $actionName . "Action";
    }

    /**
     * Вызывает метод контроллера
     *
     * @param Request $request
     * @param Response $response
     */
    public function process(Request $request, Response $response) {
        call_user_func(
            array(
                $this->controller,
                $this->actionName
            ),
            $request,
            $response
        );
    }

    /**
     * @return string
     */
    public function getActionName() {
        return $this->actionName;
    }

    /**
     * @return \Den\MVC\Controller
     */
    public function getController() {
        return $this->controller;
    }

}