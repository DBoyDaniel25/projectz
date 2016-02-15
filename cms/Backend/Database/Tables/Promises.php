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

        private $promise;
        private $synced;
        private $toUpdate;

        public function __construct($database = false) {
            parent::__construct($database);
            $table = self::TABLE_NAME;
            // create prepared statements
            $this->createPreparedStatement($table, [
                "promise",
                "synced",
                "to_update"
            ]);
            $this->readPreparedStatement($table);
            $this->updatePreparedStatement($table, [
                "promise",
                "synced",
                "to_update"
            ]);
            $this->deletePreparedStatement($table);

            // bind params
            $this->c->bind_param("sss", $this->promise, $this->synced, $this->toUpdate);
            $this->r->bind_param("i", $this->id);
            $this->u->bind_param("sssi", $this->promise, $this->synced, $this->toUpdate, $this->id);
            $this->d->bind_param("i", $this->id);
        }


        /**
         * @param Promise $obj
         *
         * @return bool
         */
        public function create($obj) {
            if (is_object($obj)) {
                $this->clean($obj);
                $this->promise  = $obj->getPromise();
                $this->synced   = $obj->getSynced();
                $this->toUpdate = $obj->getToUpdate();
                if ($this->c->execute()) {
                    return true;
                }
            }

            return false;
        }


        /**
         * @param Promise $obj
         *
         * @return bool
         */
        public function update($obj) {
            if (is_object($obj) && is_numeric($obj->getId())) {
                $this->id = (int)$obj->getId();
                $oldData  = $this->read($this->id);
                if (!is_bool($oldData) && $oldData instanceof Promise) {
                    $this->promise  = $this->isNull($obj->getPromise(), $oldData->getPromise());
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
            $promise = new Promise($row->id, $row->promise, $row->synced, $row->to_update);

            return $promise;
        }

        /**
         * @return Promise[]|bool
         */
        public function readAll() {
            return parent::readAllRows(self::TABLE_NAME);
        }

        /**
         * @return Promise[]|bool
         */
        public function readAllUnsynced() {
            return parent::readAllUnsyncedRows(self::TABLE_NAME);
        }

        public function totalRows() {
            return parent::totalRowsInTable(self::TABLE_NAME);
        }
    }