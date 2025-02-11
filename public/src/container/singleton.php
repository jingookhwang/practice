<?php
require_once __DIR__ . '/Util.php';
require_once __DIR__ . '/DB.php';

use App\util;

class singleton{

        private function __construct() {

        }

        public function getUtil(): Util {
            static $instance;
            if ($instance === null) {
                $instance = new util();
            }
            return $instance;
        }

        public function getDB(): DB {
            static $instance;
            if ($instance === null) {
                $instance = new DB();
            }
            return $instance;
        }
    }
?>