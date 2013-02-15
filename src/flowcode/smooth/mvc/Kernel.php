<?php

namespace flowcode\smooth\mvc;

use flowcode\smooth\config\Setup;
use flowcode\smooth\mvc\HttpRequest;
use flowcode\smooth\mvc\HttpRequestBuilder;

class Kernel {

    public function __construct() {
        
    }

    public function init($mode) {
        session_start();

        if ('prod' == $mode) {
            register_shutdown_function(array($this, 'shutdown'));
        }
    }

    public function handleRequest($requestedUrl) {

        require_once (__DIR__ . '/Autoloader.php');

        $setup = new Setup();
        $controllersToScan = $setup->getScanneableControllers();

        $request = $this->getRequest($requestedUrl);

        // scan controller
        $enabledController = FALSE;
        foreach ($controllersToScan as $controllerNamespace) {
            $class = $controllerNamespace . $request->getControllerClass();

            if ($this->validClass($class)) {
                $enabledController = TRUE;
                break;
            }
        }

        if ($enabledController) {
            $controller = new $class();
        } else {

            $class = $setup->getDefaultController();
            $request->setAction($setup->getDefaultMethod());
            $controller = new $class();
        }

        // seguridad a nivel controller
//        if ($controller->isSecure()) {
//
//            if (!isset($_SESSION['user']['username'])) {
//
//                // Si no esta atenticado, lo llevo a la pantalla de autenticacion.
//                $request = new HttpRequest("");
//                $request->setAction("index");
//                $request->setControllerName("adminLogin");
//                $class = "\\flowcode\\inter\\controller\\" . $request->getControllerClass();
//                $controller = new $class();
//            } else {
//
//                // Si esta atenticado, verifico que tenga un rol valido para el controller.
//                if (!$controller->canAccess($_SESSION['user']['role'])) {
//                    $request = new HttpRequest("");
//                    $request->setAction("restringido");
//                    $request->setControllerName("usuario");
//                    $class = "\\flowcode\\inter\\controller\\" . $request->getControllerClass();
//                    $controller = new $class();
//                }
//            }
//        }

        $method = $request->getAction();
        $controller->$method($request);
    }

    public function getRequest($requestedUrl) {
        $request = HttpRequestBuilder::buildFromRequestUrl($requestedUrl);
        return $request;
    }

    public function shutdown() {
        if (($error = error_get_last())) {
            ob_clean();
            header("Location: /lo-sentimos");
        }
    }

    private function validClass($classname) {
        $params = explode('\\', $classname);
        $filename = __DIR__ . '/../../..';

        $count = (count($params) - 1);
        for ($i = 1; $i <= $count; $i++) {
            $filename .= '/' . $params[$i];
        }
        $filename .= '.php';
        return file_exists($filename);
    }

}

?>