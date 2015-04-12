<?php
namespace Journal;

class Controller {

    protected $template;
    protected $db;

    public function __construct(Db $db, Template $template)
    {
        $this->db = $db;
        $this->template = $template;
    }
    
    protected function checkAuth($redirect = true)
    {
        session_start();
        
        if(!isset($_SESSION['user_id']) && $redirect) {
            header('Location: /users/login');
            exit;
        }
        
        return isset($_SESSION['user_id']);
    }

    protected function render($template, $data = array(), $base_tpl = null)
    {
        $this->template->render($template, $data, $base_tpl);
    }
    
    protected function isPost()
    {
        return (isset($_POST) && sizeof($_POST) > 0);
    }
}