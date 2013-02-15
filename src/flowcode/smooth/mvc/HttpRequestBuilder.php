<?php

namespace flowcode\smooth\mvc;

use flowcode\smooth\mvc\HttpRequest;
use flowcode\smooth\mvc\Router;

/**
 * Description of HttpRequestBuilder
 *
 * @author juanma
 */
class HttpRequestBuilder {

    public function buildFromRequestUrl($requestedUrl) {
        $instance = new HttpRequest();
        $instance->setRequestedUrl($requestedUrl);

        $array = explode('/', $requestedUrl);

        // controller
        $controllerName = "home";
        if (!empty($array[1])) {
            $controllerName = $array[1];

            // primero intento buscar una ruta definida
            $routedController = Router::get(strtolower($array[1]), "controller");
            if ($routedController != NULL) {
                $controllerName = $routedController;
            }
        }
        $instance->setControllerName($controllerName);


        // action
        $actionName = "index";
        if (!empty($array[2])) {
            $actionName = $array[2];
            // primero intento buscar una ruta definida
            $actions = Router::get(strtolower($array[1]), "actions");
            if ($actions != NULL && isset($actions[$actionName])) {
                $actionName = $actions[$actionName];
            }
        } else {

            if (isset($array[1])) {
                $actions = Router::get(strtolower($array[1]), "actions");
                if ($actions != NULL) {
                    $actionName = (isset($actions["default"])) ? $actions["default"] : "index";
                }
            }
        }
        $instance->setAction($actionName);

        $params = array();
        foreach ($array as $key => $value) {
            if ($key > 2)
                $params[] = $value;
        }

        $instance->setParams($params);

        return $instance;
    }

}

?>