<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/5/16
     * Time: 5:42 PM
     */

    namespace Backend\Database\Schemas;


    class Quote {
        public $id;
        public $quote;
        public $synced;
        public $toUpdate;

        /**
         * Quote constructor.
         *
         * @param $toUpdate
         * @param $synced
         * @param $quote
         * @param $id
         */
        public function __construct($id = null,  $quote = null, $synced = null, $toUpdate = null) {
            $this->id       = $id;
            $this->quote    = $quote;
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
        public function getQuote() {
            return $this->quote;
        }

        /**
         * @param mixed $quote
         */
        public function setQuote($quote) {
            $this->quote = $quote;
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