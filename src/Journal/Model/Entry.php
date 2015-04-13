<?php
namespace Journal\Model;
use Exception;

class Entry {
    
    public $entry_id;
    public $user_id;
    public $title;
    public $article;
    public $name;
    
    public function __construct($data = null)
    {
        if(isset($data['entry_id'])) {
            $this->entry_id = $data['entry_id'];
        }

        if(isset($data['user_id'])) {
            $this->user_id = $data['user_id'];
        }
        
        if(isset($data['title'])) {
            $this->title = $data['title'];
        }

        if(isset($data['article'])) {
            $this->article = $data['article'];
        }
    }

    public function validateCreate(&$errors)
    {
        $return = true;

        // entry_id must be null
        if(!is_null($this->entry_id)) {
            $errors['entry_'] = 'A new entry should not be assigned an id';
            $return = false;
        }

        // user_id must be an integer and must not be empty
        if(empty($this->user_id)) {
            $errors['user_id'] = 'A user must be set for a new entry';
            $return = false;
        } elseif(!is_int($this->user_id)) {
            $errors['user_id'] = 'User ids must be integers';
            $return = false;
        }

        // title must a string and must be not empty
        if(empty($this->title)) {
            $errors['title'] = 'An entry must have a title';
            $return = false;
        } elseif(!is_string($this->title)) {
            $errors['title'] = 'Please use text for an entry title';
            $return = false;
        }

        // article must a string and must be not empty
        if(empty($this->article)) {
            $errors['article'] = 'An entry must have a article';
            $return = false;
        } elseif(!is_string($this->article)) {
            $errors['article'] = 'Please use text for an entry article';
            $return = false;
        }

        return $return;
    }

    public function validateEdit(&$errors)
    {
        $return = true;

        // entry_id must be an integer and must not be empty
        if(empty($this->entry_id)) {
            $errors['entry_id'] = 'You must provide and entry id to edit an entry';
            $return = false;
        } elseif(!is_int($this->entry_id)) {
            $errors['entry_id'] = 'Entry ids must be integers';
            $return = false;
        }

        // user_id must be an integer and must not be empty
        if(empty($this->user_id)) {
            $errors['user_id'] = 'A user must be set for a new entry';
            $return = false;
        } elseif(!is_int($this->user_id)) {
            $errors['user_id'] = 'User ids must be integers';
            $return = false;
        }

        // title must a string and must be not empty
        if(empty($this->title)) {
            $errors['title'] = 'An entry must have a title';
            $return = false;
        } elseif(!is_string($this->title)) {
            $errors['title'] = 'Please use text for an entry title';
            $return = false;
        }

        // article must a string and must be not empty
        if(empty($this->article)) {
            $errors['article'] = 'An entry must have a article';
            $return = false;
        } elseif(!is_string($this->article)) {
            $errors['article'] = 'Please use text for an entry article';
            $return = false;
        }

        return $return;
    }
}