<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/4/16
     * Time: 6:46 PM
     */

    namespace Backend\Database\Tables;


    use Backend\Database\Database;
    use Backend\Database\Schemas\Promise;

    class Promises extends Database {

        const TABLE_NAME = "promises";
        const JSON_NAME  = "promises.json";
        const ROW_ID     = "id";
        const PROMISE    = "promise";

        private $id;
        private $promise;
        private $synced;
        private $toUpdate;
        private $callback;

        public function __construct($database = false) {
            parent::__construct($database);
            // create prepared statements
            $this->c = $this->connection->prepare("INSERT INTO promises (promise, synced, to_update) VALUES (?, ?, ?);");
            $this->r = $this->connection->prepare("SELECT * FROM promises WHERE id = ?;");
            $this->u = $this->connection->prepare("UPDATE promises SET promise = ?, synced = ?, to_update = ? WHERE id = ?;");
            $this->d = $this->connection->prepare("DELETE FROM promises  WHERE id = ?;");

            // bind params
            $this->c->bind_param("sss", $this->promise, $this->synced, $this->toUpdate);
            $this->r->bind_param("i", $this->id);
            $this->u->bind_param("sssi", $this->promise, $this->synced, $this->toUpdate, $this->id);
            $this->d->bind_param("i", $this->id);

            $this->callback = function ($tableObj) {
                $promise = new Promise($tableObj->id, $tableObj->promise, $tableObj->synced, $tableObj->to_update);

                return $promise;
            };
        }


        /**
         * Creates a new row in database table
         *
         * @param Promise $obj
         *
         * @return bool True on success, false otherwise
         */
        public function create($obj) {
            if (is_object($obj)) {
                $this->promise  = $this->clean($obj->getPromise());
                $this->synced   = $this->clean($obj->getSynced());
                $this->toUpdate = $this->clean($obj->getToUpdate());
                if ($this->c->execute()) {
                    return true;
                }
            }

            return false;
        }

        public function createJson($name, $data) {
            parent::createJson($name, $data);
        }

        public function totalRows() {
            $query  = "SELECT count(*) AS total FROM promises;";
            $result = mysqli_query($this->connection, $query);
            $data   = "";
            while ($row = mysqli_fetch_assoc($result)) {
                $data = $row["total"];
            }

            return $data;
        }

        /**
         * @param bool $decode
         *
         * @return \Backend\Database\Schemas\Promise[]|bool
         */
        public function readAll($decode = false) {
            return parent::readAllRows($decode, self::TABLE_NAME, $this->callback);
        }


        /**
         * @return bool|Promise[]
         */
        public function readUnsynced() {
            return parent::readUnsyncedRows(self::TABLE_NAME, $this->callback);
        }


        /**
         * Fetch one row
         *
         * @param          $id
         *
         * @param callable $callback
         *
         * @return Promise|bool
         */
        public function read($id, $callback) {
            if (is_numeric($id)) {
                $this->id = (int)$id;
                if ($this->r->execute()) {
                    $result = $this->r->get_result();
                    if ($result->num_rows > 0) {
                        $obj = $result->fetch_object();
                        $this->strip($obj);
                        $promise = $callback($obj);

                        return $promise;
                    }
                }
            }

            return false;
        }


        /**
         * Deletes a row in database table
         *
         * @param $id
         *
         * @return bool True on success, false on failure
         */
        public function delete($id) {
            if (is_numeric($id)) {
                $this->id = (int)$id;
                if ($this->d->execute()) {
                    return $this->d->affected_rows > 0;
                }
            }

            return false;
        }


        /**
         * Updates a row in database table
         *
         * @param Promise $obj
         *
         * @return bool True on success, false on failure
         */
        public function update($obj) {
            if (is_object($obj) && is_numeric($obj->getId())) {
                $this->id = (int)$obj->getId();

                $oldData = $this->read($this->id, $this->callback);

                if ($oldData !== false) {
                    $this->promise  = (is_null($obj->getPromise())) ? $oldData->getPromise() : $this->clean($obj->getPromise());
                    $this->synced   = (is_null($obj->getSynced())) ? $oldData->getSynced() : $obj->getSynced();
                    $this->toUpdate = (is_null($obj->getToUpdate())) ? $oldData->getToUpdate() : $obj->getToUpdate();
                    if ($this->u->execute()) {
                        return true;
                    }
                }
            }

            return false;
        }


    }