<?php
    /**
     * Created by PhpStorm.
     * User: prince
     * Date: 1/27/16
     * Time: 10:53 AM
     */

    namespace Backend\Database\Tables;


    use Backend\Database\Database;

    class ILove extends Database {
        const JSON_NAME = "ilove.json";
        const LOVE = "ilove";
        const ROW_ID = "id";
        private $id;
        private $love;
        private $synced;

        public function __construct() {
            parent::__construct();
            // create prepared statements
            $this->c = $this->connection->prepare("INSERT INTO loveabout (ilove, synced) VALUES (?, ?);");
            $this->r = $this->connection->prepare("SELECT * FROM loveabout WHERE id = ?;");
            $this->u = $this->connection->prepare("UPDATE loveabout SET ilove = ? WHERE id = ?;");
            $this->d = $this->connection->prepare("DELETE FROM loveabout  WHERE id = ?;");

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
                $this->love   = $this->clean($obj->getLove());
                $this->synced = $this->clean($obj->getSynced());
                if ($this->c->execute()) {
                    return true;
                }
            }

            return false;
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
         * @param bool $decode
         *
         * @return \Backend\Database\Schemas\ILove[]|bool
         */
        public function readAll($decode = false) {
            $query  = "SELECT * FROM loveabout ORDER BY id DESC;";
            $result = mysqli_query($this->connection, $query);

            if (mysqli_num_rows($result) > 0) {
                $data = [];
                while ($row = mysqli_fetch_object($result)) {
                    $this->strip($row);
                    if ($decode) {
                        $this->htmlDecode($row);
                    }

                    $obj    = new \Backend\Database\Schemas\ILove($row->id, $row->ilove, $row->synced);
                    $data[] = $obj;
                }

                return $data;
            }

            return false;
        }

        public function readUnsynced() {
            $query  = "SELECT * FROM loveabout WHERE synced = 'false' ORDER BY id DESC;";
            $result = mysqli_query($this->connection, $query);

            if (mysqli_num_rows($result) > 0) {
                $data = [];
                while ($row = mysqli_fetch_object($result)) {
                    $this->strip($row);
                    $this->htmlDecode($row);
                    $obj    = new \Backend\Database\Schemas\ILove($row->id, $row->ilove, $row->synced);
                    $data[] = $obj;
                }
                $this->updateUnSyncedToSynced();

                return $data;
            }

            return false;
        }

        private function updateUnSyncedToSynced() {
            $query = "UPDATE loveabout SET synced = 'true' WHERE synced = 'false';";
            mysqli_query($this->connection, $query);
        }

        /**
         * @param $id
         *
         * @return \Backend\Database\Schemas\ILove|bool
         */
        public function read($id) {
            if (is_numeric($id)) {
                $this->id = (int)$id;
                if ($this->r->execute()) {
                    $result = $this->r->get_result();
                    if ($result->num_rows > 0) {
                        $obj = $result->fetch_object();
                        $this->strip($obj);
                        $ilove = new \Backend\Database\Schemas\ILove($obj->id, $obj->ilove, $obj->synced);
                        return $ilove;
                    }
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
                $this->id = (int)$obj->getId();
                $oldData  = $this->read($obj->id);

                if ($oldData !== false) {
                    $this->love = (is_null($obj->getLove())) ? $oldData->getLove() : $obj->getLove();

                    if ($this->u->execute()) {
                        return true;
                    }
                }
            }

            return false;
        }


    }
