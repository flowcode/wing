<?php

namespace flowcode\mvc\kernel;

use flowcode\mvc\kernel\HttpRequest;

class Kernel {

    public function __construct($mode) {

        session_start();
        $_SESSION['ckfinder_baseUrl'] = '/upload/';

        if ('prod' == $mode) {
            register_shutdown_function(array($this, 'shutdown'));
        }
    }

    public function handleRequest($requestedUrl) {

        require(__DIR__ . '/Autoloader.class.php');

        $request = $this->getRequest($requestedUrl);

        $class = "\\flowcode\\inter\\controller\\" . $request->getControllerClass();
        if ($this->validClass($class)) {
            $controller = new $class();
        } else {
            //$request = new HttpRequest("");
            $request->setAction("manage");
            $request->setControllerName("seccion");
            $class = "\\flowcode\\inter\\controller\\" . $request->getControllerClass();
            $controller = new $class();
        }

        // seguridad a nivel controller
        if ($controller->isSecure()) {

            if (!isset($_SESSION['user']['username'])) {

                // Si no esta atenticado, lo llevo a la pantalla de autenticacion.
                $request = new HttpRequest("");
                $request->setAction("index");
                $request->setControllerName("adminLogin");
                $class = "\\flowcode\\inter\\controller\\" . $request->getControllerClass();
                $controller = new $class();
            } else {

                // Si esta atenticado, verifico que tenga un rol valido para el controller.
                if (!$controller->canAccess($_SESSION['user']['role'])) {
                    $request = new HttpRequest("");
                    $request->setAction("restringido");
                    $request->setControllerName("usuario");
                    $class = "\\flowcode\\inter\\controller\\" . $request->getControllerClass();
                    $controller = new $class();
                }
            }
        }

        $method = $request->getAction() . "Action";
        $controller->$method($request);
    }

    public function getRequest($requestedUrl) {
        $request = new HttpRequest($requestedUrl);
        return $request;
    }

    public function shutdown() {
        if (($error = error_get_last())) {
            ob_clean();
            header("Location: /lo-sentimos");
        }
    }

    public function validClass($classname) {
        $params = explode('\\', $classname);
        $filename = __DIR__ . '/../../' . $params[2] . '/' . $params[3] . '/' . $params[4] . '.class.php';
        return file_exists($filename);
    }

}

?>
