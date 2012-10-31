<?php

/**
 * Autoloader para cargar clases. 
 */
class ClassAutoloader {

    public function __construct() {
        spl_autoload_register(array($this, 'loader'));
    }

    private function loader($className) {
        $params = explode('\\', $className);
        $filename = __DIR__ . '/../../' . $params[1] . '/' . $params[2] . '/' . $params[3] . '.class.php';
        include $filename;
    }

}

$autoloader = new ClassAutoloader();
?>
