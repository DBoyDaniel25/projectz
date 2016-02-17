<?php
    /**
     * Created by PhpStorm.
     * User: prince
     * Date: 12/17/15
     * Time: 4:39 PM
     */

    namespace Backend\Database\Schemas;


    class Poem {

        public $id;
        public $author;
        public $date;
        public $name;
        public $poem;
        public $favourite;
        public $synced;
        public $toUpdate;

        /**
         * Poem constructor.
         *
         * @param        $id
         * @param        $author
         * @param        $name
         * @param        $poem
         * @param        $date
         * @param string $favourite
         * @param        $synced
         * @param        $toUpdate
         */
        public function __construct($id = null, $author = null, $name = null, $poem = null, $date = null, $favourite = "false", $synced = null, $toUpdate = null) {
            $this->id     = $id;
            $this->author = $author;
            if (is_null($date)) {
                $this->date = date("jS M, y");
            } else {
                $this->date = $date;
            }
            $this->name      = $name;
            $this->poem      = $poem;
            $this->favourite = $favourite;
            if (is_null($synced)) {
                $this->synced = "false";
            } else {
                $this->synced = $synced;
            }
            if (is_null($toUpdate)) {
                $this->toUpdate = "false";
            } else {
                $this->toUpdate = $toUpdate;
            }
            if (is_null($favourite)) {
                $this->favourite = "false";
            } else {
                $this->favourite = $toUpdate;
            }
        }

        /**
         * @return mixed
         */
        public function getToUpdate() {
            return $this->toUpdate;
        }

        /**
         * @param mixed $toUpdate
         */
        public function setToUpdate($toUpdate) {
            $this->toUpdate = $toUpdate;
        }



        /**
         * @return mixed
         */
        public function getSynced() {
            return $this->synced;
        }

        /**
         * @param mixed $synced
         */
        public function setSynced($synced) {
            if (is_null($synced)) {
                $this->synced = "false";
            } else {
                $this->synced = $synced;
            }
        }


        /**
         * @return mixed
         */
        public function getId() {
            return $this->id;
        }

        /**
         * @param mixed $id
         */
        public function setId($id) {
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getAuthor() {
            return $this->author;
        }

        /**
         * @param mixed $author
         */
        public function setAuthor($author) {
            $this->author = $author;
        }

        /**
         * @return mixed
         */
        public function getDate() {
            return $this->date;
        }

        /**
         * @param mixed $date
         */
        public function setDate($date) {
            $this->date = $date;
        }

        /**
         * @return mixed
         */
        public function getName() {
            return $this->name;
        }

        /**
         * @param mixed $name
         */
        public function setName($name) {
            $this->name = $name;
        }

        /**
         * @return mixed
         */
        public function getPoem() {
            return $this->poem;
        }

        /**
         * @param mixed $poem
         */
        public function setPoem($poem) {
            $this->poem = $poem;
        }

        /**
         * @return mixed
         */
        public function getFavourite() {
            return $this->favourite;
        }

        /**
         * @param mixed $favourite
         */
        public function setFavourite($favourite) {
            $this->favourite = $favourite;
        }


    }