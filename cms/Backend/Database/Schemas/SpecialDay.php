<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/19/16
     * Time: 5:19 PM
     */

    namespace Backend\Database\Schemas;


    class SpecialDay {
        public $id;
        public $date;
        public $message;
        public $synced;
        public $toUpdate;

        /**
         * SpecialDay constructor.
         *
         * @param $id
         * @param $date
         * @param $message
         * @param $synced
         * @param $toUpdate
         */
        public function __construct($id = null, $date = null, $message = null, $synced = null, $toUpdate = null) {
            $this->id       = $id;
            $this->date     = $date;
            $this->message  = $message;
            if(is_null($synced)){
                $this->synced   = "false";
            }else {
                $this->synced = $synced;
            }
            if(is_null($toUpdate)){
                $this->toUpdate = "false";
            }else {
                $this->toUpdate = $toUpdate;
            }
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
            $this->synced = $synced;
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
        public function getMessage() {
            return $this->message;
        }

        /**
         * @param mixed $message
         */
        public function setMessage($message) {
            $this->message = $message;
        }
    }