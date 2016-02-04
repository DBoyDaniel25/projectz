<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/4/16
     * Time: 1:21 PM
     */

    namespace Backend\Database\Tables;


    use Backend\Database\Database;
    use Backend\Database\Schemas\Reassure;

    class Reassurance extends Database {
        const TABLE_NAME = "reassurance";
        const ROW_ID     = "id";
        const REASSURE   = "reassure";
        const JSON_NAME  = "reassure.json";

        private $id;
        private $reassure;
        private $synced;
        private $toUpdate;

        private $callback;

        public function __construct() {
            parent::__construct();
            // create prepared statements
            $this->c = $this->connection->prepare("INSERT INTO reassurance (reassure, synced, to_update) VALUES (?, ?, ?);");
            $this->r = $this->connection->prepare("SELECT * FROM reassurance alias WHERE id = ?;");
            $this->u = $this->connection->prepare("UPDATE reassurance SET reassure = ?, synced = ?, to_update = ? WHERE id = ?;");
            $this->d = $this->connection->prepare("DELETE FROM reassurance  WHERE id = ?;");

            // bind params
            $this->c->bind_param("sss", $this->reassure, $this->synced, $this->toUpdate);
            $this->r->bind_param("i", $this->id);
            $this->u->bind_param("sssi", $this->reassure, $this->synced, $this->toUpdate, $this->id);
            $this->d->bind_param("i", $this->id);

            $this->callback = function ($tableObj) {
                $reassure = new Reassure($tableObj->id, $tableObj->reassure, $tableObj->synced, $tableObj->to_update);
                return $reassure;
            };
        }

        /**
         * Creates a new row in database table
         *
         * @param Reassure $obj
         *
         * @return bool True on success, false otherwise
         */
        public function create($obj) {
            if (is_object($obj)) {
                $this->reassure = $this->clean($obj->getReassure());
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

        /**
         * @param bool $decode
         *
         * @return \Backend\Database\Schemas\Reassure[]|bool
         */
        public function readAll($decode = false) {
            return parent::readAll($decode, self::TABLE_NAME, $this->callback);
        }


        /**
         * @return bool|Reassure[]
         */
        public function readUnsynced() {
            return parent::readUnsynced(self::TABLE_NAME, $this->callback);
        }


        /**
         * Fetch one row
         *
         * @param          $id
         *
         * @param callable $callback
         *
         * @return Reassure|bool
         */
        public function read($id, $callback) {
            if (is_numeric($id)) {
                $this->id = (int)$id;
                if ($this->r->execute()) {
                    $result = $this->r->get_result();
                    if ($result->num_rows > 0) {
                        $obj = $result->fetch_object();
                        $this->strip($obj);
                        $poem = $callback($obj);

                        return $poem;
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
         * @param Reassure $obj
         *
         * @return bool True on success, false on failure
         */
        public function update($obj) {
            if ( is_object($obj) && is_numeric($obj->getId())) {
                $this->id = (int)$obj->getId();

                $oldData = $this->read($this->id, $this->callback);

                if ($oldData !== false) {
                    $this->reassure = (is_null($obj->getReassure())) ? $oldData->getReassure() : $this->clean($obj->getReassure());
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