<?php
namespace Journal\Model;
use Exception;

class User {
    
    public $user_id;
    public $name;
    public $display;
    public $password = false;

    public function __construct($data = null)
    {
        if(isset($data['user_id'])) {
            $this->user_id = $data['user_id'];
        }
        
        if(isset($data['name'])) {
            $this->name = $data['name'];
        }

        if(isset($data['display'])) {
            $this->display = $data['display'];
        }

        if(isset($data['password'])) {
            $this->password = $data['password'];
        }
    }

    public function validateEdit(&$errors)
    {
        $return = true;

        // user_id must be an integer and must not be empty
        if(empty($this->user_id)) {
            $errors['user_id'] = 'A user id must be provided to edit a user';
            $return = false;
        } elseif(!is_int($this->user_id)) {
            $errors['user_id'] = 'User ids must be integers';
            $return = false;
        }

        // name must a string and must be not empty
        if(empty($this->name)) {
            $errors['name'] = 'A user must have a name';
            $return = false;
        } elseif(!is_string($this->name)) {
            $errors['name'] = 'Please use text for a user name';
            $return = false;
        }

        // display must be a string or empty
        if(!is_string($this->display)) {
            $errors['display'] = 'Please use text for a user display name';
            $return = false;
        }

        return $return;
    }
}