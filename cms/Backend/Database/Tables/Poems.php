<?php
    /**
     * Created by PhpStorm.
     * User: prince
     * Date: 12/17/15
     * Time: 4:40 PM
     */
    namespace Backend\Database\Tables;


    use Backend\Database\Database;
    use Backend\Database\Schemas\Poem;

    class Poems extends Database {

        const ROW_ID     = "id";
        const POEM       = "poem";
        const NAME       = "name";
        const AUTHOR     = "author";
        const JSON_NAME  = "poems.json";
        const TABLE_NAME = "poems";

        private $author;
        private $date;
        private $name;
        private $poem;
        private $favourite;
        private $synced;
        private $toUpdate;

        public function __construct($mysqli = false) {
            parent::__construct($mysqli);
            $table = self::TABLE_NAME;

            // prepared statements
            $this->createPreparedStatement($table, [
                "author",
                "date",
                "poemname",
                "poem",
                "favourite",
                "synced",
                "to_update"
            ]);
            $this->readPreparedStatement($table);
            $this->updatePreparedStatement($table, [
                "author",
                "poemname",
                "poem",
                "favourite",
                "synced",
                "to_update"
            ]);
            $this->deletePreparedStatement($table);

            // bind parameters
            $this->c->bind_param("sssssss", $this->author, $this->date, $this->name, $this->poem, $this->favourite, $this->synced, $this->toUpdate);
            $this->r->bind_param("i", $this->id);
            $this->u->bind_param("ssssssi", $this->author, $this->name, $this->poem, $this->favourite, $this->synced, $this->toUpdate, $this->id);
            $this->d->bind_param("i", $this->id);
        }

        /**
         * @param Poem $obj
         *
         * @return bool
         */
        public function create($obj) {
            if (is_object($obj)) {
                $this->clean($obj);
                $this->author    = $obj->getAuthor();
                $this->date      = $obj->getDate();
                $this->name      = $obj->getName();
                $this->poem      = $obj->getPoem();
                $this->favourite = $obj->getFavourite();
                $this->synced    = $obj->getSynced();
                $this->toUpdate  = $obj->getToUpdate();
                if ($this->c->execute()) {
                    return true;
                }
            }

            return false;
        }


        /**
         * @param Poem $obj
         *
         * @return bool
         */
        public function update($obj) {
            if (is_object($obj) && is_numeric($obj->getId())) {
                $this->id = (int)$obj->getId();
                $oldData  = $this->read($this->id);

                if (!is_bool($oldData) && $oldData instanceof Poem) {
                    $this->author    = $this->isNull($obj->getAuthor(), $oldData->getAuthor());
                    $this->name      = $this->isNull($obj->getName(), $oldData->getName());
                    $this->poem      = $this->isNull($obj->getPoem(), $oldData->getPoem());
                    $this->favourite = $this->isNull($obj->getFavourite(), $oldData->getFavourite());
                    $this->synced    = $this->isNull($obj->getSynced(), $oldData->getSynced());
                    $this->toUpdate  = $this->isNull($obj->getToUpdate(), $oldData->getToUpdate());

                    if ($this->u->execute()) {
                        return true;
                    }
                }

            }

            return false;
        }

        protected function createObjFromRow($row) {
            $poem = new Poem($row->id, $row->author, $row->poemname, $row->poem, $row->date, $row->favourite,
                $row->synced, $row->to_update);

            return $poem;
        }


        /**
         * @return Poem[]|bool
         */
        public function readAll() {
            return parent::readAllRows(self::TABLE_NAME);
        }

        /**
         * @return Poem[]|bool
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