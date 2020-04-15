<?php

namespace application\core;

use application\lib\Db;

class Model
{
    /**
     * @var Db
     */
    public $db;

    public function __construct() {
		$this->db = Db::getInstance();;
	}

    public function loadModel($name) {
        $path = 'application\models\\'.ucfirst($name);
        if (class_exists($path)) {
            return new $path;
        }
    }
}
