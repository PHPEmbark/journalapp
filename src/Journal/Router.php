<?php
namespace Journal;
use Exception;

class Router {

    protected $routes;
    protected $defaultRoute;
    protected $errors;

    public function __construct($default_route, $routes, $errors)
    {
        $this->routes = $routes;
        $this->defaultRoute = $default_route;
        $this->errors = $errors;
    }

    public function start($route, ...$deps)
    {
        if (empty($route) || $route == '/') {
            if (isset($this->defaultRoute)) {
                $route = $this->defaultRoute;
            } else {
                $this->error($deps);
            }
        }

        try {
            foreach ($this->routes as $path => $defaults) {

                $regex = '@' . preg_replace(
                    '@:([\w]+)@',
                    '(?P<$1>[^/]+)',
                    str_replace(')', ')?', (string) $path)
                ) . '@';
                $matches = [];

                if (preg_match($regex, $route, $matches)) {
                    $options = $defaults;

                    foreach ($matches as $key => $value) {
                        if (is_numeric($key)) {
                            continue;
                        }

                        $options[$key] = $value;
                        if (isset($defaults[$key])) {
                            if (strpos($defaults[$key], ":$key") !== false) {
                                $options[$key] = str_replace(":$key", $value, $defaults[$key]);
                            }
                        }
                    }

                    if ($this->route($options, $deps)) {
                        return;
                    } else {
                        $this->error($deps);
                    }
                }
            }
            // no match was made or another error occurred
            $this->error();
        } catch (Exception $e) {
            $this->error($deps);
        }
    }

    protected function route($options, $deps)
    {
        if (isset($options['controller']) && isset($options['action'])) {
            $class = $options['controller'];
            $method = $options['action'] . 'Action';
            unset($options['controller'], $options['action']);

            if (is_callable([$class, $method])) {
                $controller = new $class(...$deps);

                $controller->$method($options);
                return true;
            }
        }
    }

    public function error($deps)
    {
        if (isset($this->errors)) {
            $route = $this->errors;
            $this->start($route, ...$deps);
        } else {
            echo 'An unknown error occurred, please try again!';
        }

        exit;
    }
}