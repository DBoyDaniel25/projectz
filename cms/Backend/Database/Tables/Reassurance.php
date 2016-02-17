<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/4/16
     * Time: 1:21 PM
     */

    namespace Backend\Database\Tables;


    use Backend\Database\Database;
    use Backend\Database\Schemas\Notification;
    use Backend\Database\Schemas\Reassure;

    class Reassurance extends Database {
        const TABLE_NAME = "reassurance";
        const ROW_ID     = "id";
        const REASSURE   = "reassure";
        const JSON_NAME  = "reassure.json";

        private $reassure;
        private $synced;
        private $toUpdate;

        public function __construct($database = false) {
            parent::__construct($database);
            // create prepared statements
            $table = self::TABLE_NAME;
            $this->createPreparedStatement($table, [
                "reassure",
                "synced",
                "to_update"
            ]);
            $this->readPreparedStatement($table);
            $this->updatePreparedStatement($table, [
                "reassure",
                "synced",
                "to_update"
            ]);
            $this->deletePreparedStatement($table);

            // bind params
            $this->c->bind_param("sss", $this->reassure, $this->synced, $this->toUpdate);
            $this->r->bind_param("i", $this->id);
            $this->u->bind_param("sssi", $this->reassure, $this->synced, $this->toUpdate, $this->id);
            $this->d->bind_param("i", $this->id);
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
                $this->clean($obj);
                $this->reassure = $obj->getReassure();
                $this->synced   = $obj->getSynced();
                $this->toUpdate = $obj->getToUpdate();
                if ($this->c->execute()) {
                    $notification = new Notifications($this->getConnection());
                    $obj          = new Notification(null, "New Reassurance");
                    $notification->create($obj);

                    return true;
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
            if (is_object($obj) && is_numeric($obj->getId())) {
                $this->id = (int)$obj->getId();
                $oldData  = $this->read($this->id);
                if ($oldData !== false && $oldData instanceof Reassure) {
                    $this->reassure = $this->isNull($obj->getReassure(), $oldData->getReassure());
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
            $reassure = new Reassure($row->id, $row->reassure, $row->synced, $row->to_update);

            return $reassure;
        }

        /**
         * @return Reassure[]|bool
         */
        public function readAll() {
            return parent::readAllRows(self::TABLE_NAME);
        }


        /**
         * @return Reassure[]|bool
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