<?php

namespace flowcode\mvc\kernel;

class HttpRequest {

    private $requestedUrl;
    private $controller;
    private $action;
    private $params;

    public function __construct($requestedUrl) {
        $this->requestedUrl = $requestedUrl;
        $array = explode('/', $requestedUrl);

        // controller
        $c = "home";
        if (!empty($array[1])) {
            $c = $array[1];
            // primero intento buscar una ruta definida
            $routedController = Router::get(strtolower($array[1]), "controller");
            if ($routedController != NULL) {
                $c = $routedController;
            }
        }
        $this->controller = $c;


        // action
        $a = "index";
        if (!empty($array[2])) {
            $a = $array[2];
            // primero intento buscar una ruta definida
            $actions = Router::get(strtolower($array[1]), "actions");
            if ($actions != NULL && isset($actions[$a])) {
                $a = $actions[$a];
            }
        } else {

            if (isset($array[1])) {
                $actions = Router::get(strtolower($array[1]), "actions");
                if ($actions != NULL) {
                    $a = (isset($actions["default"])) ? $actions["default"] : "index";
                }
            }
        }
        $this->action = $a;
        $this->params = array();
        foreach ($array as $key => $value) {
            if ($key > 2)
                $this->params[] = $value;
        }
    }

    /**
     * 
     * @return type 
     */
    public function getControllerClass() {
        return ucwords($this->controller) . "Controller";
    }

    public function getControllerName() {
        return $this->controller;
    }

    public function getAction() {
        return $this->action;
    }

    public function setControllerName($controllerName) {
        $this->controller = $controllerName;
    }

    public function setAction($actionName) {
        $this->action = $actionName;
    }

    /**
     * Retorna los parametros del request.
     * @return type 
     */
    public function getParams() {
        return $this->params;
    }

    /**
     * Retorna el valor del parametro.
     * Si no existe retorna NULL.
     * 
     * @param String $parameter
     * @return String value. 
     */
    public function getParameter($parameter) {
        $value = NULL;
        if ($parameter != NULL) {
            for ($index = 0; $index < (count($this->params) - 1); $index++) {
                if ($this->params[$index] == $parameter) {
                    $value = $this->params[$index + 1];
                    break;
                }
            }
        }
        if(is_null($value)){
            if(isset($_POST[$parameter])){
                $value = $_POST[$parameter];
            }
        }
        if(is_null($value)){
            if(isset($_GET[$parameter])){
                $value = $_GET[$parameter];
            }
        }
        if(is_string($value)){
            $value = urldecode($value);
        }
        return $value;
    }
    
    public function getRequestedUrl() {
        return $this->requestedUrl;
    }

}

?>
