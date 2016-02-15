<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/4/16
     * Time: 7:32 PM
     */

    namespace Backend\Database\Tables;


    use Backend\Database\Database;

    class Memory extends Database{

        const TABLE_NAME = "memory";
        const JSON_NAME = "memory.json";
        const ROW_ID = "id";
        const MEMORY = "memory";

        private $id;
        private $memory;
        private $synced;
        private $toUpdate;
        private $callback;

        public function __construct($database = false) {
            parent::__construct($database);

            // create prepared statements
            $this->c = $this->connection->prepare("insert into memory (memory, synced, to_update) values (?, ?, ?);");
            $this->r = $this->connection->prepare("select * from memory where id = ?;");
            $this->u = $this->connection->prepare("update memory set memory = ?, synced = ?, to_update = ? where id = ?;");
            $this->d = $this->connection->prepare("delete from memory  where id = ?;");

            // bind params
            $this->c->bind_param("sss", $this->memory, $this->synced, $this->toUpdate);
            $this->r->bind_param("i", $this->id);
            $this->u->bind_param("sssi", $this->memory, $this->synced, $this->toUpdate, $this->id);
            $this->d->bind_param("i", $this->id);

            $this->callback = function($tableObj) {
                $memory = new \Backend\Database\Schemas\Memory($tableObj->id, $tableObj->memory, $tableObj->synced, $tableObj->to_update);
                return $memory;
            };
        }




        /**
         * @param  \Backend\Database\Schemas\Memory $obj
         *
         * @return bool
         */
        public function create($obj) {
            if (is_object($obj)) {
                $this->memory   = $this->clean($obj->getMemory());
                $this->synced = $this->clean($obj->getSynced());
                $this->toUpdate = $this->clean($obj->getToUpdate());
                if ($this->c->execute()) {
                    return true;
                }
            }

            return false;
        }

        public function totalRows(){
            $query = "select count(*) AS total from memory;";
            $result = mysqli_query($this->connection, $query);
            $data = "";
            while($row = mysqli_fetch_assoc($result)){
                $data = $row["total"];
            }
            return $data;
        }

        public function createJson($name, $data) {
            parent::createJson($name, $data);
        }

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
         * @return  \Backend\Database\Schemas\Memory[]|bool
         */
        public function readUnsynced() {
            return parent::readUnsyncedRows(self::TABLE_NAME, $this->callback);
        }

        /**
         * @param bool $decode
         * @return  \Backend\Database\Schemas\Memory[]|bool
         */
        public function readAll($decode = false) {
            return parent::readAllRows($decode, self::TABLE_NAME, $this->callback);
        }


        /**
         * @param $id
         *
         * @param callable $callback
         * @return  \Backend\Database\Schemas\Memory|bool
         */
        public function read($id, $callback) {
            if (is_numeric($id)) {
                $this->id = (int)$id;
                if ($this->r->execute()) {
                    $result = $this->r->get_result();
                    if ($result->num_rows > 0) {
                        $obj = $result->fetch_object();
                        $this->strip($obj);
                        $memory = $callback($obj);

                        return $memory;
                    }
                }
            }

            return false;
        }


        /**
         * @param  \Backend\Database\Schemas\Memory $obj
         *
         * @return bool
         */
        public function update($obj) {
            if (is_object($obj) && is_numeric($obj->getId())) {
                $this->id = (int)$obj->getId();
                $oldData  = $this->read($obj->id, $this->callback);
                if ($oldData !== false) {
                    $this->memory = (is_null($obj->getMemory())) ? $oldData->getMemory() : $obj->getMemory();
                    $this->synced = (is_null($obj->getSynced())) ? $oldData->getSynced() : $obj->getSynced();
                    $this->toUpdate = (is_null($obj->getToUpdate())) ? $oldData->getToUpdate() : $obj->getToUpdate();
                    if ($this->u->execute()) {
                        return true;
                    }
                }
            }

            return false;
        }


    }