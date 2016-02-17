<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/17/16
     * Time: 12:31 PM
     */

    namespace Backend\Database\Tables;


    use Backend\Database\Database;
    use Backend\Database\Schemas\Notification;

    class Notifications extends Database {
        const TABLE_NAME = "notifications";
        const JSON_NAME  = "notification.json";

        private $text, $synced;

        public function __construct($mysqli = false) {
            parent::__construct($mysqli);
            $table = self::TABLE_NAME;
            $this->createPreparedStatement($table, [
                "text",
                "synced"
            ]);
            $this->readPreparedStatement($table);
            $this->updatePreparedStatement($table, [
                "text",
                "synced"
            ]);
            $this->deletePreparedStatement($table);

            // bind params
            $this->c->bind_param("ss", $this->text, $this->synced);
            $this->r->bind_param("i", $this->id);
            $this->u->bind_param("ssi", $this->text, $this->synced, $this->id);
            $this->d->bind_param("i", $this->id);
        }


        /**
         * @param Notification $obj
         *
         * @return bool
         */
        public function create($obj) {
            if (is_object($obj)) {
                $this->clean($obj);
                $this->text   = $obj->getText();
                $this->synced = $obj->getSynced();

                if ($this->c->execute()) {
                    return true;
                }
            }

            return false;
        }

        protected function createObjFromRow($row) {
            $obj = new Notification($row->id, $row->text, $row->synced);

            return $obj;
        }

        public function readAll() {
            return parent::readAllRows(self::TABLE_NAME);
        }

        public function readAllUnsynced() {
            return parent::readAllUnsyncedRows(self::TABLE_NAME, "select * FROM notifications WHERE synced = 'false' GROUP BY text;");
        }

        public function createJSON() {
            return parent::createJsonFile(self::JSON_NAME, $this->readAllUnsynced());
        }

        /**
         * @param Notification $obj
         *
         * @return bool
         */
        public function update($obj) {
            if (is_object($obj) && is_numeric($obj->getId())) {
                $this->id = (int)$obj->getId();
                $oldData  = $this->read($this->id);
                if (!is_bool($oldData) && $oldData instanceof Notification) {
                    $this->text   = $this->isNull($obj->getText(), $oldData->getText());
                    $this->synced = $this->isNull($obj->getSynced(), $oldData->getSynced());
                    if ($this->u->execute()) {
                        return true;
                    }
                }
            }

            return false;
        }

        public function totalRows() {
            return parent::totalRowsInTable(self::TABLE_NAME);
        }
    }