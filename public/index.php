<?php
// determine our base path
$base_path = dirname(__DIR__);
// include our configuration file
$config = include $base_path . '/config/config.php';

// include our autoloader class
include $base_path . '/src/Journal/Autoloader.php';
$loader = new \Journal\Autoloader($config['class_path']);
$loader->register();

// our dependencies
$db = new \Journal\Db($config['db']['db_path'], $config['db']['db_name']);
