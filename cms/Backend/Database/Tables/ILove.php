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
        const JSON_NAME  = "ilove.json";
        const LOVE       = "ilove";
        const ROW_ID     = "id";
        const TABLE_NAME = "loveabout";

        private $id;
        private $love;
        private $synced;

        /**
         * @var \Closure
         */
        private $callback;

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


            $this->callback = function ($tableObj) {
                $love = new \Backend\Database\Schemas\ILove($tableObj->id,
                    $tableObj->ilove, $tableObj->synced);

                return $love;
            };
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
         * @return \Backend\Database\Schemas\ILove[]|bool
         */
        public function readUnsynced() {
            return parent::readUnsynced(self::TABLE_NAME, $this->callback);
        }

        /**
         * @param bool $decode
         * @return \Backend\Database\Schemas\ILove[]|bool
         */
        public function readAll($decode = false) {
            return parent::readAll($decode, self::TABLE_NAME, $this->callback);
        }


        /**
         * @param $id
         *
         * @param callable $callback
         * @return \Backend\Database\Schemas\ILove|bool
         */
        public function read($id, $callback) {
            if (is_numeric($id)) {
                $this->id = (int)$id;
                if ($this->r->execute()) {
                    $result = $this->r->get_result();
                    if ($result->num_rows > 0) {
                        $obj = $result->fetch_object();
                        $this->strip($obj);
                        $ilove = $callback($obj);

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
                $oldData  = $this->read($obj->id, $this->callback);
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
