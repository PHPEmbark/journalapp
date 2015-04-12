<?php
namespace Journal\Controller;
use Journal\Controller;

class Error extends Controller {

    public function indexAction($options)
    {
        header('HTTP/1.0 404 Not Found');
        $this->render('/errors/index.phtml', ['message' => 'Page not found!', 'title' => 'Error'], 'login.html');
    }
}