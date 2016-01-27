<?php
    /**
     * Created by PhpStorm.
     * User: prince
     * Date: 1/27/16
     * Time: 10:47 AM
     */

    namespace Backend\Database\Schemas;


    class ILove {
        public $id;
        public $love;
        public $synced;

        /**
         * ILove constructor.
         *
         * @param $id
         * @param $love
         * @param $synced
         */
        public function __construct($id = null, $love = null, $synced = "false") {
            $this->id     = $id;
            $this->love   = $love;
            $this->synced = $synced;
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
        public function getLove() {
            return $this->love;
        }

        /**
         * @param mixed $love
         */
        public function setLove($love) {
            $this->love = $love;
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