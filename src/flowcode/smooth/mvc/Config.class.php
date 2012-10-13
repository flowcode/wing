<?php

namespace flowcode\mvc\kernel;

/**
 * Description of Config
 *
 * @author juanma
 */
class Config {

    public static function get($section, $param) {

        // dev
        $path = "inter/config/cdev.ini";
        
        //$framework_base = '/var/www/inter/src/flowcode/';
        $framework_base = dirname(__FILE__) . "/../../";

        // levanto la configuracion de acuerdo al modo de inicio
        // Parse with sections
        $config = parse_ini_file($framework_base . $path , true);
        if (isset($config[$section][$param])) {
            return $config[$section][$param];
        } else {
            return NULL;
        }
    }

}

