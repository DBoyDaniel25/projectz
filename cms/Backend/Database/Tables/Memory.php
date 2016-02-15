<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/4/16
     * Time: 7:32 PM
     */

    namespace Backend\Database\Tables;


    use Backend\Database\Database;

    class Memory extends Database {

        const TABLE_NAME = "memory";
        const JSON_NAME  = "memory.json";
        const ROW_ID     = "id";
        const MEMORY     = "memory";

        private $memory;
        private $synced;
        private $toUpdate;

        public function __construct($database = false) {
            parent::__construct($database);
            $table = self::TABLE_NAME;
            // create prepared statements
            $this->createPreparedStatement($table, [
                "memory",
                "synced",
                "to_update"
            ]);
            $this->readPreparedStatement($table);
            $this->updatePreparedStatement($table, [
                "memory",
                "synced",
                "to_update"
            ]);
            $this->deletePreparedStatement($table);

            // bind params
            $this->c->bind_param("sss", $this->memory, $this->synced, $this->toUpdate);
            $this->r->bind_param("i", $this->id);
            $this->u->bind_param("sssi", $this->memory, $this->synced, $this->toUpdate, $this->id);
            $this->d->bind_param("i", $this->id);

        }


        /**
         * @param \Backend\Database\Schemas\Memory $obj
         *
         * @return bool
         */
        public function create($obj) {
            if (is_object($obj)) {
                $this->clean($obj);
                $this->memory   = $obj->getMemory();
                $this->synced   = $obj->getSynced();
                $this->toUpdate = $obj->getToUpdate();

                if ($this->c->execute()) {
                    return true;
                }
            }

            return false;
        }


        /**
         * @param \Backend\Database\Schemas\Memory $obj
         *
         * @return bool
         */
        public function update($obj) {
            if (is_object($obj) && is_numeric($obj->getId())) {
                $this->id = (int)$obj->getId();
                $oldData  = $this->read($this->id);
                if (!is_bool($oldData) && $oldData instanceof \Backend\Database\Schemas\Memory) {
                    $this->memory   = $this->isNull($obj->getMemory(), $oldData->getMemory());
                    $this->synced   = $this->isNull($obj->getSynced(), $oldData->getSynced());
                    $this->toUpdate = $this->isNull($obj->getToUpdate(), $oldData->getToUpdate());
                    if ($this->u->execute()) {
                        return true;
                    }
                }
            }

            return false;
        }

        protected function createObjFromRow($row) {
            $memory = new \Backend\Database\Schemas\Memory($row->id, $row->memory, $row->synced, $row->to_update);

            return $memory;
        }

        /**
         * @return \Backend\Database\Schemas\Memory[]|bool
         */
        public function readAll() {
            return parent::readAllRows(self::TABLE_NAME);
        }

        /**
         * @return \Backend\Database\Schemas\Memory[]|bool
         */
        public function readAllUnsynced() {
            return parent::readAllUnsyncedRows(self::TABLE_NAME);
        }

        public function totalRows() {
            return parent::totalRowsInTable(self::TABLE_NAME);
        }


        public function createJSON() {
            return parent::createJsonFile(self::JSON_NAME, $this->readAllUnsynced());
        }
    }