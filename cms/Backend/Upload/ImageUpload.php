<?php
    /**
     * Created by PhpStorm.
     * User: prince
     * Date: 12/3/15
     * Time: 2:49 PM
     */

    namespace Backend\Upload;


    class Image {
        private $root;
        private $fileName;
        private $size;
        private $type;
        private $tmpName;
        private $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];

        /**
         * ImageUpload constructor.
         *
         * @param object $file Pass the file uploaded
         */
        public function __construct($file) {
            $this->fileName = $file['name'];
            $this->size     = $file['size'];
            $this->type     = $file['type'];
            $this->tmpName  = $file['tmp_name'];
            $this->root     = $_SERVER['DOCUMENT_ROOT'] . "/work/imalady/src/";
        }

        /**
         * Checks to see if it's a supported file type
         * @return bool
         */
        private function validExtension() {
            $extension = strtolower(substr($this->getFileName(), strpos($this->getFileName(), '.') + 1));
            for ($i = 0; $i < count($this->allowedExt); $i++) {
                if (!in_array($extension, $this->allowedExt)) {
                    return false;
                }
            }

            return true;
        }

        /**
         * Saves the uploaded file
         * @param string $location The location of the root of the directory
         *
         * @return bool
         */
        public function save($location) {
            if ($this->validExtension()) {
                echo $this->tmpName;
                if (move_uploaded_file($this->tmpName, $this->root . $location . $this->fileName)) {
                    return true;
                } else {
                    return false;
                }
            }

            return false;
        }


        /**
         * @return mixed
         */
        public function getFileName() {
            return $this->fileName;
        }

        /**
         * @return mixed
         */
        public function getSize() {
            return $this->size;
        }

        /**
         * @return mixed
         */
        public function getType() {
            return $this->type;
        }

        /**
         * @return mixed
         */
        public function getTmpName() {
            return $this->tmpName;
        }


    }
?>
