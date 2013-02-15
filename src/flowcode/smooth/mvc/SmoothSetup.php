<?php

namespace flowcode\smooth\mvc;

/**
 * Description of SmoothSetup}
 *
 * @author juanma
 */
class SmoothSetup {

    protected $scanneableControllers;
    protected $dirs;
    protected $defaultController;
    protected $defaultMethod;

    function __construct() {
        $this->scanneableControllers = array();
        $this->dirs = array();
        $this->defaultController = array();
        $this->defaultMethod = array();
    }

    public function getScanneableControllers() {
        return $this->scanneableControllers;
    }

    public function setScanneableControllers($scanneableControllers) {
        $this->scanneableControllers = $scanneableControllers;
    }

    public function getDefaultController() {
        return $this->defaultController;
    }

    public function getDefaultMethod() {
        return $this->defaultMethod;
    }

}

?>
