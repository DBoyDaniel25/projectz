<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/19/16
     * Time: 5:21 PM
     */

    namespace Backend\Database\Tables;


    use Backend\Database\Database;
    use Backend\Database\Schemas\SpecialDay;

    class SpecialDays extends Database {
        const TABLE_NAME = "specialdays";
        const JSON_NAME  = "specialdays.json";

        const MESSAGE = "message";
        const DATE    = "date";
        const ROW_ID  = "id";

        private $date, $message, $synced, $toUpdate;

        public function __construct($mysqli = false) {
            parent::__construct($mysqli);
            $table = self::TABLE_NAME;
            $this->createPreparedStatement($table, [
                "date",
                "message",
                "synced",
                "to_update"
            ]);

            $this->readPreparedStatement($table);
            $this->updatePreparedStatement($table, [
                "date",
                "message",
                "synced",
                "to_update"
            ]);
            $this->deletePreparedStatement($table);

            // bind params
            $this->c->bind_param("ssss", $this->date, $this->message, $this->synced, $this->toUpdate);
            $this->r->bind_param("i", $this->id);
            $this->u->bind_param("ssssi", $this->date, $this->message, $this->synced, $this->toUpdate, $this->id);
            $this->d->bind_param("i", $this->id);

        }


        /**
         * @param SpecialDay $obj
         *
         * @return bool
         */
        public function create($obj) {
            if (is_object($obj)) {
                $this->clean($obj);
                $this->date     = $obj->getDate();
                $this->message  = $obj->getMessage();
                $this->synced   = $obj->getSynced();
                $this->toUpdate = $obj->getToUpdate();
                if ($this->c->execute()) {
                    return true;
                }
            }

            return false;
        }

        protected function createObjFromRow($row) {
            $specialDay = new SpecialDay($row->id, $row->date, $row->message, $row->synced, $row->to_update);

            return $specialDay;
        }

        /**
         * @return SpecialDay[]|bool
         */
        public function readAll() {
            return parent::readAllRows(self::TABLE_NAME);
        }

        public function readAllUnsynced() {
            return parent::readAllUnsyncedRows(self::TABLE_NAME);
        }

        public function createJSON() {
            return parent::createJsonFile(self::JSON_NAME, $this->readAllUnsynced());
        }

        /**
         * @param SpecialDay $obj
         *
         * @return bool
         */
        public function update($obj) {

            if (is_object($obj) && is_numeric($obj->getId())) {
                $this->id = (int)$obj->getId();
                $oldData  = $this->read($this->id);
                if (!is_bool($oldData) && $oldData instanceof SpecialDay) {
                    $this->clean($obj);

                    $this->date     = $this->isNull($obj->getDate(), $oldData->getDate());
                    $this->message  = $this->isNull($obj->getMessage(), $oldData->getMessage());
                    $this->synced   = $this->isNull($obj->getSynced(), $oldData->getSynced());
                    $this->toUpdate = $this->isNull($obj->getToUpdate(), $oldData->getToUpdate());

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