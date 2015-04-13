<?php
namespace Journal;
use PDO;

class Db extends PDO {

    protected $dsn = null;

    public function __construct($db_path, $db_name) {
        $this->dsn = 'sqlite:' . $db_path . '/' . $db_name . '.sqlite';
        parent::__construct($this->dsn);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}