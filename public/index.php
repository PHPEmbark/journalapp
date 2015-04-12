<?php
// determine our base path
$base_path = dirname(__DIR__);

// include our configuration file
$config = include $base_path . '/config/config.php';

// register our autoloaders
foreach($config['autoloader']['classes'] as $path => $name) {
    require_once $path;
    $loader = new $name($config['autoloader']['class_path']);
    $loader->register();
}

// find our route
$route = null;
if (isset($_SERVER['PATH_INFO'])) {
    $route = $_SERVER['PATH_INFO'];
}

// our dependencies
$db = new \Journal\Db($config['db']['db_path'], $config['db']['db_name']);
$template = new \Journal\Template($config['template']['tpl_path'], $config['template']['base_tpl']);


// start the router
$router = new \Journal\Router($config['router']['default'], $config['router']['routes'], $config['router']['errors']);
$router->start($route, $db, $template);