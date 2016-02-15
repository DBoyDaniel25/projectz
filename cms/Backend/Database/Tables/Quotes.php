<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/5/16
     * Time: 5:46 PM
     */

    namespace Backend\Database\Tables;


    use Backend\Database\Database;
    use Backend\Database\Schemas\Quote;

    class Quotes extends Database {
        const JSON_NAME  = "quote.json";
        const QUOTE      = "quote";
        const ROW_ID     = "id";
        const TABLE_NAME = "quotes";

        private $id;
        private $quote;
        private $synced;
        private $toUpdate;

        private $callback;

        public function __construct($database = false) {
            parent::__construct($database);
            // create prepared statements
            $this->c = $this->connection->prepare("INSERT INTO quotes (quote, synced, to_update) VALUES (?, ?, ?);");
            $this->r = $this->connection->prepare("SELECT * FROM quotes WHERE id = ?;");
            $this->u = $this->connection->prepare("UPDATE quotes SET quote = ?, synced = ?, to_update = ?  WHERE id  = ?;");
            $this->d = $this->connection->prepare("DELETE FROM quotes  WHERE id = ?;");

            // bind params
            $this->c->bind_param("sss", $this->quote, $this->synced, $this->toUpdate);
            $this->r->bind_param("i", $this->id);
            $this->u->bind_param("sssi", $this->quote, $this->synced, $this->toUpdate, $this->id);
            $this->d->bind_param("i", $this->id);


            $this->callback = function ($tableObj) {
                $quote = new Quote($tableObj->id, $tableObj->quote, $tableObj->synced, $tableObj->to_update);

                return $quote;
            };
        }


        /**
         * @param \Backend\Database\Schemas\Quote $obj
         *
         * @return bool
         */
        public function create($obj) {
            if (is_object($obj)) {
                $this->quote    = $this->clean($obj->getQuote());
                $this->synced   = $this->clean($obj->getSynced());
                $this->toUpdate = $this->clean($obj->getToUpdate());
                if ($this->c->execute()) {
                    return true;
                }
            }

            return false;
        }

        public function totalRows() {
            $query  = "SELECT count(*) AS total FROM quotes;";
            $result = mysqli_query($this->connection, $query);
            $data   = "";
            while ($row = mysqli_fetch_assoc($result)) {
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
         * @return \Backend\Database\Schemas\Quote[]|bool
         */
        public function readUnsynced() {
            return parent::readUnsyncedRows(self::TABLE_NAME, $this->callback);
        }

        /**
         * @param bool $decode
         *
         * @return \Backend\Database\Schemas\Quote[]|bool
         */
        public function readAll($decode = false) {
            return parent::readAllRows($decode, self::TABLE_NAME, $this->callback);
        }


        /**
         * @param          $id
         *
         * @param callable $callback
         *
         * @return \Backend\Database\Schemas\Quote|bool
         */
        public function read($id, $callback) {
            if (is_numeric($id)) {
                $this->id = (int)$id;
                if ($this->r->execute()) {
                    $result = $this->r->get_result();
                    if ($result->num_rows > 0) {
                        $obj = $result->fetch_object();
                        $this->strip($obj);
                        $quote = $callback($obj);

                        return $quote;
                    }
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
                $oldData  = $this->read($obj->id, $this->callback);
                if ($oldData !== false) {
                    $this->quote    = (is_null($obj->getQuote())) ? $oldData->getQuote() : $obj->getQuote();
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