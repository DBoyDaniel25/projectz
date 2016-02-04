<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/4/16
     * Time: 1:17 PM
     */

    namespace Backend\Database\Schemas;


    class Reassure {
        public $id;
        public $reassure;
        public $synced;
        public $toUpdate;

        /**
         * Reassure constructor.
         *
         * @param $id
         * @param $reassure
         * @param $synced
         * @param $toUpdate
         */
        public function __construct($id = null, $reassure = null, $synced = null, $toUpdate = null) {
            $this->id       = $id;
            $this->reassure = $reassure;
            if(is_null($synced)){
                $this->synced   = "false";
            }
            if(is_null($toUpdate)){
                $this->toUpdate = "false";
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
        public function getReassure() {
            return $this->reassure;
        }

        /**
         * @param mixed $reassure
         */
        public function setReassure($reassure) {
            $this->reassure = $reassure;
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


    }