<?php

$allowed = array();
$allowed[] = "127.0.0.1";
//$allowed[] = "190.244.32.27";
//$allowed[] = "83.138.253.168";
//$allowed[] = "83.52.147.74";

$ip = $_SERVER['REMOTE_ADDR'];

if (!in_array($ip, $allowed)) {
    echo die("You are not allowed.");
    exit;
}

$kernel_dir = __DIR__ . '/src/flowcode/smooth/mvc/Kernel.php';

require_once $kernel_dir;

use flowcode\smooth\mvc\Kernel;

$kernel = new Kernel();
$kernel->init("dev");

$kernel->handleRequest($_SERVER['REQUEST_URI']);
?>
