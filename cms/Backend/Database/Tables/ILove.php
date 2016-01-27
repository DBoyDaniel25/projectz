<?php
    /**
     * Created by PhpStorm.
     * User: prince
     * Date: 1/27/16
     * Time: 10:53 AM
     */

    namespace Backend\Database\Tables;


    use Backend\Database\Database;

    class ILove extends Database {
        private $id;
        private $love;
        private $synced;

        public function __construct() {
            parent::__construct();
            // create prepared statements
            $this->c = $this->connection->prepare("INSERT INTO loveabout (ilove, synced) VALUES (?, ?);");

        }

        public function create($obj) {
            parent::create($obj);
        }

        public function delete($id) {
            parent::delete($id);
        }

        public function read($id) {
            parent::read($id);
        }

        public function update($obj) {
            parent::update($obj);
        }


    }