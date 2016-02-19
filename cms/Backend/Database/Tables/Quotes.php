<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/5/16
     * Time: 5:46 PM
     */

    namespace Backend\Database\Tables;


    use Backend\Database\Database;
    use Backend\Database\Schemas\Notification;
    use Backend\Database\Schemas\Quote;

    class Quotes extends Database {
        const JSON_NAME  = "quote.json";
        const QUOTE      = "quote";
        const ROW_ID     = "id";
        const TABLE_NAME = "quotes";

        private $quote;
        private $synced;
        private $toUpdate;

        public function __construct($database = false) {
            parent::__construct($database);
            // create prepared statements
            $table = self::TABLE_NAME;
            $this->createPreparedStatement($table, [
                "quote",
                "synced",
                "to_update"
            ]);
            $this->readPreparedStatement($table);
            $this->updatePreparedStatement($table, [
                "quote",
                "synced",
                "to_update"
            ]);

            $this->deletePreparedStatement($table);
            // bind params
            $this->c->bind_param("sss", $this->quote, $this->synced, $this->toUpdate);
            $this->r->bind_param("i", $this->id);
            $this->u->bind_param("sssi", $this->quote, $this->synced, $this->toUpdate, $this->id);
            $this->d->bind_param("i", $this->id);


        }


        /**
         * @param \Backend\Database\Schemas\Quote $obj
         *
         * @return bool
         */
        public function create($obj) {
            if (is_object($obj)) {
                $this->clean($obj);
                $this->quote    = $obj->getQuote();
                $this->synced   = $obj->getSynced();
                $this->toUpdate = $obj->getToUpdate();
                if ($this->c->execute()) {
                    $notification = new Notifications($this->getConnection());
                    $obj  = new Notification(null, "New Quote");
                    $notification->create($obj);
                    return true;
                }
            }

            return false;
        }

        /**
         * @param \Backend\Database\Schemas\Quote $obj
         *
         * @return bool
         */
        public function update($obj) {
            if (is_object($obj) && is_numeric($obj->getId())) {
                $this->id = (int)$obj->getId();
                $oldData  = $this->read($obj->id);
                if ($oldData !== false && $oldData instanceof Quote) {
                    $this->clean($obj);
                    $this->quote    = $this->isNull($obj->getQuote(), $oldData->getQuote());
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
            $quote = new Quote($row->id, $row->quote, $row->synced, $row->to_update);

            return $quote;
        }

        /**
         * @return Quote[]|bool
         */
        public function readAll() {
            return parent::readAllRows(self::TABLE_NAME);
        }

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