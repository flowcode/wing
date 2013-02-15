<?php

namespace flowcode\demo\controller;

use flowcode\demo\service\HelloService;
use flowcode\smooth\mvc\Controller;
use flowcode\smooth\mvc\HttpRequest;

/**
 * Description of HomeController
 *
 * @author juanma
 */
class DemoController extends Controller {

    public function __construct() {
        $this->setIsSecure(FALSE);
    }

    public function hello(HttpRequest $httpRequest) {
        echo "hello";
    }

    public function helloSetup(HttpRequest $httpRequest) {
        $helloSrv = new HelloService();
        echo $helloSrv->getHelloMessage();
    }

}

?>
