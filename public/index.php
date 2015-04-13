<?php
// determine our base path
$base_path = dirname(__DIR__);
// include our configuration file
$config = include $base_path . '/config/config.php';

// include our autoloader class
include $base_path . '/src/Journal/Autoloader.php';
$loader = new \Journal\Autoloader($base_path);
$loader->register();