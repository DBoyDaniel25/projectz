<?php
    /**
     * Created by PhpStorm.
     * User: prince
     * Date: 12/17/15
     * Time: 4:29 PM
     */

    namespace Backend\Database;


    class Database {
        const ENV = "local";
        private $host, $user, $pass, $db;
        protected $jsonLocation;
        protected $connection, $c, $r, $u, $d;
        /**
         * Database constructor.
         */
        public function __construct() {
            if (self::ENV !== "local") {
                // for production
                $this->host = "mysql.hostinger.in";
                $this->user = "u288716392_dp";
                $this->pass = "starboi25";
                $this->db   = "u288716392_love";
                $this->jsonLocation = $_SERVER["DOCUMENT_ROOT"] . "/cms/Backend/api/json/";
            } else {
                // for local development
                $this->host = "localhost";
                $this->user = "root";
                $this->pass = "prince";
                $this->db   = "projectz";
                $this->jsonLocation = $_SERVER["DOCUMENT_ROOT"] . "/versatile/projectz/cms/Backend/api/json/";
            }

            $this->connection = mysqli_connect($this->host, $this->user, $this->pass, $this->db);

            if (!$this->connection) {
                die("Could not connect to database: " . mysqli_error($this->connection));
            }

        }


        public function create($obj) {

        }

        public function read($id) {

        }

        public function update($obj) {

        }

        public function delete($id) {

        }


        /**
         * Strip slashes added my mysqli_escape_query no return value as objects are passed by reference
         *
         * @param $obj
         */
        protected function strip($obj) {
            foreach ($obj as $key => $value) {
                $obj->$key = stripcslashes($value);
            }
        }


        /**
         * Decodes encoded html from htmlentities() method no return value as objects are passed by reference
         *
         * @param $obj
         */
        public function htmlDecode($obj) {
            foreach ($obj as $key => $value) {
                $obj->$key = html_entity_decode($value);
            }
        }

        /**
         * Cleans user input and returns clean data
         *
         * @param string $str
         *
         * @return string cleaned data
         */
        protected function clean($str) {
            return htmlentities(trim(mysqli_real_escape_string($this->connection, $str)));
        }

        protected function createJson($name, $data){
            if(is_array($data)){
                $json = json_encode($data);
                $handle = fopen($this->jsonLocation . $name, "w");
                fwrite($handle, $json);
                fclose($handle);
            }else {
                $handle = fopen($this->jsonLocation . $name, "w");
                fwrite($handle, "");
                fclose($handle);
            }
        }

    }