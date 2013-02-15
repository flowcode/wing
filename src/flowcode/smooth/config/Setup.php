<?php

namespace flowcode\smooth\config;

use flowcode\smooth\mvc\SmoothSetup;

/**
 * Description of Setup
 *
 * @author juanma
 */
class Setup extends SmoothSetup {

    function __construct() {
        parent::__construct();

        // controllers
        $this->scanneableControllers[] = "\\flowcode\\demo\\controller\\";
        $this->scanneableControllers[] = "\\flowcode\\smooth\\controller\\";

        // dirs
        $this->dirs['public'] = "/public";

        // default controller
        $this->defaultController = "\\flowcode\\smooth\\controller\\DefaultController";
        $this->defaultMethod = "hello";
    }

}

?>
