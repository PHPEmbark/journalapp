<?php
namespace Journal\Controller;

use Journal\Controller;
use Journal\Db;
use Journal\Template;
use Journal\Model\Users as UsersModel;
use Journal\Model\User;

class Users extends Controller {

    protected $model;
    
    public function __construct(Db $db, Template $template)
    {
        parent::__construct($db, $template);
        $this->model = new UsersModel($this->db);
    }

    public function loginAction($options)
    {
        // already logged in
        if($this->checkAuth(false)) {
            header('Location: /');
            exit;
        }

        $errors = [];

        if($this->isPost()) {
            
            if(!isset($_POST['name']) || empty($_POST['name'])) {
                $errors['name'] = 'Name cannot be empty';
            } else {
                $name = $_POST['name'];
            }

            if(!isset($_POST['password']) || empty($_POST['password'])) {
                $errors['password'] = 'Password cannot be empty';
            } else {
                $password = $_POST['password'];
            }
            
            if(isset($name) && isset($password)) {
                $user_id = $this->model->verifyPassword($name, $password);
                
                if($user_id) {
                    $_SESSION['user_id'] = intval($user_id);
                    session_write_close();
                    
                    header('Location: /');
                    exit;
                } else {
                    $errors['submit'] = 'Could not login, check username and password';
                }
            }
        }

        $vars = [
            'title' => 'Login to Journal',
            'errors' => $errors,
        ];
        $this->render('users/login.html', $vars, 'login.html');
    }

    public function logoutAction($options)
    {
        $this->checkAuth();
        
        unset($_SESSION['user_id']);
        session_write_close();
        
        header('Location: /users/login');
        exit;
    }

    public function profileAction($options)
    {
        $this->checkAuth();

        $errors = [];

        $user_id = $_SESSION['user_id'];
        $user = $this->model->getUser($user_id);

        if($this->isPost()) {
            $user = new User($_POST);
            $user->user_id = $user_id;
            if($user->validateEdit($errors)){
                $this->model->update($user);
            }
        }

        $vars = [
            'title' => 'Edit Your Profile',
            'errors' => $errors,
            'user' => $user,
        ];
        $this->render('users/profile.html', $vars);
    }
}