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

        const ROW_ID = "id";
        const POEM = "poem";
        const NAME = "name";
        const AUTHOR = "author";
        const JSON_NAME = "poems.json";

        private $id;
        private $author;
        private $date;
        private $name;
        private $poem;
        private $favourite;
        private $synced;
        private $toUpdate;

        /**
         * Poems constructor.
         */
        public function __construct() {
            parent::__construct();

            // prepared statements
            $this->c = $this->connection->prepare("INSERT INTO poems (author, date, poemname, poem, favourite, synced, to_update) VALUES (?, ?, ?, ?, ?, ?, ?);");
            $this->r = $this->connection->prepare("SELECT * FROM poems WHERE id = ?;");
            $this->u = $this->connection->prepare("UPDATE poems SET author = ?, poemname = ?, poem = ?, favourite = ?, synced = ?, to_update = ? WHERE id = ?;");
            $this->d = $this->connection->prepare("DELETE FROM poems  WHERE id = ?;");


            // bind parameters
            $this->c->bind_param("sssssss", $this->author, $this->date, $this->name, $this->poem, $this->favourite, $this->synced, $this->toUpdate);
            $this->r->bind_param("i", $this->id);
            $this->u->bind_param("ssssssi", $this->author, $this->name, $this->poem, $this->favourite, $this->synced, $this->toUpdate, $this->id);
            $this->d->bind_param("i", $this->id);
        }

        /**
         * Creates a new row in database table
         *
         * @param Poem $obj
         *
         * @return bool True on success, false otherwise
         */
        public function create($obj) {
            if (is_object($obj)) {
                $this->name      = $this->clean($obj->getName());
                $this->author    = $this->clean($obj->getAuthor());
                $this->poem      = $this->clean($obj->getPoem());
                $this->favourite = $this->clean($obj->getFavourite());
                $this->date      = $this->clean($obj->getDate());
                $this->synced    = $this->clean($obj->getSynced());
                $this->toUpdate  = $this->clean($obj->getToUpdate());
                if ($this->c->execute()) {
                    return true;
                }
            }

            return false;
        }

        public function createJson($name, $data) {
            parent::createJson($name, $data);
        }

        /**
         * Retrieve all rows
         *
         *
         * @param bool $decode Decode Data before receiving it
         *
         * @return \Backend\Database\Schemas\Poem[]|bool Array of poem objects, false on failure
         */
        public function readAll($decode = false) {
            $query  = "SELECT * FROM poems ORDER BY id DESC;";
            $result = mysqli_query($this->connection, $query);

            if (mysqli_num_rows($result) > 0) {
                $data = [];
                while ($row = mysqli_fetch_object($result)) {
                    $this->strip($row);
                    if ($decode) {
                        $this->htmlDecode($row);
                    }

                    $obj    = new Poem($row->id, $row->author, $row->poemname,
                        $row->poem, $row->date, $row->favourite, $row->synced, $row->to_update);
                    $data[] = $obj;
                }

                return $data;
            }

            return false;
        }

        /**
         * Fetch one row
         *
         * @param $id
         *
         * @return \Backend\Database\Schemas\Poem|bool
         */
        public function read($id) {
            if (is_numeric($id)) {
                $this->id = (int)$id;
                if ($this->r->execute()) {
                    $result = $this->r->get_result();
                    if ($result->num_rows > 0) {
                        $obj = $result->fetch_object();
                        $this->strip($obj);
                        $poem = new Poem($obj->id, $obj->author, $obj->poemname,
                            $obj->poem, $obj->date, $obj->favourite, $obj->synced, $obj->to_update);

                        return $poem;
                    }
                }
            }

            return false;
        }

        /**
         * Retrieve all unsynced rows
         *
         *
         *
         * @return \Backend\Database\Schemas\Poem[]|bool Array of poem objects, false on failure
         */
        public function readUnsynced() {
            $query  = "SELECT * FROM poems WHERE synced = 'false' ORDER BY id DESC;";
            $result = mysqli_query($this->connection, $query);

            if (mysqli_num_rows($result) > 0) {
                $data = [];
                while ($row = mysqli_fetch_object($result)) {
                    $this->strip($row);
                    $this->htmlDecode($row);
                    $obj    = new Poem($row->id, $row->author, $row->poemname,
                        $row->poem, $row->date, $row->favourite, $row->synced, $row->to_update);
                    $data[] = $obj;
                }
                $this->updateUnSyncedToSynced();
                return $data;
            }
            return false;
        }

        /**
         * Deletes a row in database table
         *
         * @param $id
         *
         * @return bool True on success, false on failure
         */
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
         * Updates all unsynced rows to synced
         */
        private function updateUnSyncedToSynced() {
            $query = "UPDATE poems SET synced = 'true' WHERE synced = 'false';";
            mysqli_query($this->connection, $query);
        }


        /**
         * Updates a row in database table
         *
         * @param Poem $obj
         *
         * @return bool True on success, false on failure
         */
        public function update($obj) {
            if (is_numeric($obj->getId()) && is_object($obj)) {
                $this->id = (int)$obj->getId();

                $oldData = $this->read($this->id);

                if ($oldData !== false) {

                    $this->author    = (is_null($obj->getAuthor())) ? $oldData->getAuthor() : $this->clean($obj->getAuthor());
                    $this->poem      = (is_null($obj->getPoem())) ? $oldData->getPoem() : $this->clean($obj->getPoem());
                    $this->name      = (is_null($obj->getName())) ? $oldData->getName() : $this->clean($obj->getName());
                    $this->favourite = (is_null($obj->getFavourite())) ? $oldData->getFavourite() : $obj->getFavourite();
                    $this->synced    = (is_null($obj->getSynced())) ? $oldData->getSynced() : $obj->getSynced();
                    $this->toUpdate  = (is_null($obj->getToUpdate())) ? $oldData->getToUpdate() : $obj->getToUpdate();
                    if ($this->u->execute()) {
                        return true;
                    }
                }
            }

            return false;
        }


    }