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
        protected $jsonLocation;
        protected $connection, $c, $r, $u, $d;
        private   $host, $user, $pass, $db;

        /**
         * Database constructor.
         */
        public function __construct() {
            if (self::ENV !== "local") {
                // for production
                $this->host         = "mysql.hostinger.in";
                $this->user         = "u288716392_dp";
                $this->pass         = "starboi25";
                $this->db           = "u288716392_love";
                $this->jsonLocation = $_SERVER["DOCUMENT_ROOT"] . "/cms/Backend/api/json/";
            } else {
                // for local development
                $this->host         = "localhost";
                $this->user         = "root";
                $this->pass         = "prince";
                $this->db           = "mylove";
                $this->jsonLocation = $_SERVER["DOCUMENT_ROOT"] . "/web/projectz/cms/Backend/api/json/";
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
         * Retrieve all unsynced rows
         *
         *
         *
         * @param string   $tableName The table to query
         * @param callable $callback  A function which returns a database schema object of the table
         *                            passed in, in the first parameter, where a mysql object of                                          that table will be passed into it
         *
         * @return object[]|bool Array of poem objects, false on failure
         */
        public function readUnsynced($tableName, $callback) {
            $query  = "SELECT * FROM {$tableName} WHERE synced = 'false' ORDER BY id DESC;";
            $result = mysqli_query($this->connection, $query);

            if (mysqli_num_rows($result) > 0) {
                $data = [];
                while ($row = mysqli_fetch_object($result)) {
                    $this->strip($row);
                    $this->htmlDecode($row);
                    $obj    = $callback($row);
                    $data[] = $obj;
                }
                $this->updateUnSyncedToSynced($tableName);
                return $data;
            }
            return false;
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
         * Updates all unsynced rows to synced
         *
         * @param string $tableName The table name to update
         */
        private function updateUnSyncedToSynced($tableName) {
            $query = "UPDATE {$tableName} SET synced = 'true' WHERE synced = 'false';";
            mysqli_query($this->connection, $query);
        }

        /**
         * @param bool     $decode
         *
         * @param          $tableName
         * @param callable $callback
         *
         * @return object[]|bool
         */
        public function readAll($decode = false, $tableName, $callback) {
            $query  = "SELECT * FROM {$tableName} ORDER BY id DESC;";
            $result = mysqli_query($this->connection, $query);

            if (mysqli_num_rows($result) > 0) {
                $data = [];
                while ($row = mysqli_fetch_object($result)) {
                    $this->strip($row);
                    if ($decode) {
                        $this->htmlDecode($row);
                    }
                    $obj    = $callback($row);
                    $data[] = $obj;
                }

                return $data;
            }

            return false;
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

        protected function createJson($name, $data) {
            if ($data !== false && is_array($data)) {
                $json   = json_encode($data);
                $handle = fopen($this->jsonLocation . $name, "w");
                fwrite($handle, $json);
                fclose($handle);
            } else {
                $handle = fopen($this->jsonLocation . $name, "w");
                fwrite($handle, "");
                fclose($handle);
            }
        }

    }