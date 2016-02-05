<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/4/16
     * Time: 7:30 PM
     */

    namespace Backend\Database\Schemas;


    class Memory {
        public $id;
        public $memory;
        public $synced;
        public $toUpdate;

        /**
         * Memory constructor.
         *
         * @param $id
         * @param $memory
         * @param $synced
         * @param $toUpdate
         */
        public function __construct($id = null, $memory = null, $synced = null, $toUpdate = null) {
            $this->id       = $id;
            $this->memory   = $memory;

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
        public function getMemory() {
            return $this->memory;
        }

        /**
         * @param mixed $memory
         */
        public function setMemory($memory) {
            $this->memory = $memory;
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