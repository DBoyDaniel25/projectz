<?php
    /**
     * Created by PhpStorm.
     * User: prince
     * Date: 1/27/16
     * Time: 10:53 AM
     */

    namespace Backend\Database\Tables;


    use Backend\Database\Database;
    use Backend\Database\Schemas\Notification;

    class ILove extends Database {
        const JSON_NAME  = "ilove.json";
        const LOVE       = "ilove";
        const ROW_ID     = "id";
        const TABLE_NAME = "loveabout";

        private $love;
        private $synced;


        public function __construct($database = false) {
            parent::__construct($database);            // create prepared statements
            $table = self::TABLE_NAME;
            $this->createPreparedStatement($table, [
                "ilove",
                "synced"
            ]);
            $this->readPreparedStatement($table);
            $this->updatePreparedStatement($table, [
                "ilove"
            ]);

            $this->deletePreparedStatement($table);
            // bind params
            $this->c->bind_param("ss", $this->love, $this->synced);
            $this->r->bind_param("i", $this->id);
            $this->u->bind_param("si", $this->love, $this->id);
            $this->d->bind_param("i", $this->id);
        }

        /**
         * @param \Backend\Database\Schemas\ILove $obj
         *
         * @return bool
         */
        public function create($obj) {
            if (is_object($obj)) {
                $this->clean($obj);
                $this->love   = $obj->getLove();
                $this->synced = $obj->getSynced();
                if ($this->c->execute()) {
                    $notification = new Notifications($this->getConnection());
                    $obj  = new Notification(null, "New ILove");
                    $notification->create($obj);
                    return true;
                }
            }

            return false;
        }

        /**
         * @param \Backend\Database\Schemas\ILove $obj
         *
         * @return bool
         */
        public function update($obj) {
            if (is_object($obj) && is_numeric($obj->getId())) {
                $oldData = $this->read($obj->getId());
                if (!is_bool($oldData) && $oldData instanceof \Backend\Database\Schemas\ILove) {
                    $this->clean($obj);
                    $this->id   = (int) $obj->getId();
                    $this->love = $this->isNull($obj->getLove(), $oldData->getLove());

                    if($this->u->execute()){
                       return true;
                    }
                }
            }
            return false;
        }

        protected function createObjFromRow($row) {
            $love = new \Backend\Database\Schemas\ILove($row->id,
                $row->ilove, $row->synced);

            return $love;
        }

        /**
         * @return \Backend\Database\Schemas\ILove[]|bool
         */
        public function readAll() {
            return parent::readAllRows(self::TABLE_NAME);
        }

        /**
         * @return \Backend\Database\Schemas\ILove[]|bool
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
