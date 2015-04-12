<?php
namespace Journal\Controller;

use Journal\Controller;
use Journal\Db;
use Journal\Template;
use Journal\Model\Entries as EntriesModel;
use Journal\Model\Entry;

class Entries extends Controller {

    protected $model;
    
    public function __construct(Db $db, Template $template)
    {
        parent::__construct($db, $template);
        $this->model = new EntriesModel($this->db);
    }

    public function listAction($options) {
        $this->checkAuth();

        $entries = $this->model->getAllEntries();
        
         $vars = [
            'title' => 'Journal Entries',
            'entries' => $entries,
        ];

        $this->render('entries/list.html', $vars);
    }

    public function createAction($options)
    {
        $this->checkAuth();

        $errors = [];

        $user_id = $_SESSION['user_id'];

        if($this->isPost()) {
            $entry = new Entry($_POST);
            $entry->user_id = $user_id;
            if($entry->validateCreate($errors)){
                $this->model->insert($entry);
                header('Location: /');
                exit;
            }
        } else {
            $entry = new Entry();
        }

        $vars = [
            'title' => 'Create New Entry',
            'errors' => $errors,
            'entry' => $entry,
        ];
        $this->render('entries/create.html', $vars);
    }

    public function editAction($options)
    {
        $this->checkAuth();
        
        $errors = [];

        $user_id = $_SESSION['user_id'];
        
        if($this->isPost() && isset($_POST['entry_id'])) {
            
            $entry = new Entry($_POST);
            $entry->user_id = $user_id;
            $entry->entry_id = intval($entry->entry_id);
            if($entry->validateEdit($errors)){
                $this->model->update($entry);
                header('Location: /');
                exit;
            }
        } else {

            if (!isset($options['id']) || empty($options['id'])) {
                $errors['submit'] = 'Entry not found';
                $entry = new Entry();
            } else {
                $entry = $this->model->getEntry($options['id']);
            }
    
            if ($entry === false) {
               $errors['submit'] = 'Entry not found';
               $entry = new Entry();
            }
        }

        $vars = [
            'title' => 'Edit Entry',
            'errors' => $errors,
            'entry' => $entry,
        ];
        $this->render('entries/edit.html', $vars);
    }

    public function deleteAction($options)
    {
        $this->checkAuth();
        
        if($this->isPost() && isset($_POST['entry_id'])) {
            $this->model->delete($_POST['entry_id']);
            header('Location: /');
            exit;
        }

        $errors = [];

        if (!isset($options['id']) || empty($options['id'])) {
            $errors['submit'] = 'Entry not found';
            $entry = new Entry();
        } else {
            $entry = $this->model->getEntry($options['id']);
        }

        if ($entry === false) {
           $errors['submit'] = 'Entry not found';
           $entry = new Entry();
        }

        $vars = [
            'title' => 'Delete Entry',
            'errors' => $errors,
            'entry' => $entry,
        ];
        $this->render('entries/delete.html', $vars);
    }
}
?>