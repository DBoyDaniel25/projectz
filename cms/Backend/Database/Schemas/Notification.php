<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/17/16
     * Time: 12:30 PM
     */

    namespace Backend\Database\Schemas;


    class Notification {
        public $id;
        public $text;
        public $synced;

        /**
         * Notification constructor.
         *
         * @param $id
         * @param $text
         * @param $synced
         */
        public function __construct($id = null, $text = null, $synced = null) {
            $this->id     = $id;
            $this->text   = $text;
            if(is_null($synced)){
                $this->synced = "false";
            }else{
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
        public function getText() {
            return $this->text;
        }

        /**
         * @param mixed $text
         */
        public function setText($text) {
            $this->text = $text;
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



    }