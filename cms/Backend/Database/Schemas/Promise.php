<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/4/16
     * Time: 6:44 PM
     */

    namespace Backend\Database\Schemas;


    class Promise {
        public $id;
        public $promise;
        public $synced;
        public $toUpdate;

        /**
         * Promise constructor.
         *
         * @param $id
         * @param $promise
         * @param $synced
         * @param $toUpdate
         */
        public function __construct($id = null, $promise = null, $synced = null, $toUpdate = null) {
            $this->id       = $id;
            $this->promise  = $promise;
            $this->synced   = $synced;
            $this->toUpdate = $toUpdate;
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
         * @return
         */
        public function getId() {
            return $this->id;
        }

        /**
         * @param  $id
         */
        public function setId($id) {
            $this->id = $id;
        }

        /**
         * @return string
         */
        public function getPromise() {
            return $this->promise;
        }

        /**
         * @param $promise
         */
        public function setPromise($promise) {
            $this->promise = $promise;
        }

        /**
         * @return string
         */
        public function getSynced() {
            return $this->synced;
        }

        /**
         * @param $synced
         */
        public function setSynced($synced) {
            $this->synced = $synced;
        }

        /**
         * @return string
         */
        public function getToUpdate() {
            return $this->toUpdate;
        }

        /**
         * @param $toUpdate
         */
        public function setToUpdate($toUpdate) {
            $this->toUpdate = $toUpdate;
        }
    }