<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 1/30/16
     * Time: 7:08 PM
     */

    namespace Backend\Helpers;


    class Email {

        private $subject;
        private $body;
        private $recipient;
        private $sender;

        /**
         * Email constructor.
         * @param $subject
         * @param $body
         * @param $recipient
         * @param $sender
         */
        public function __construct($subject, $body, $recipient = "programmer96@hotmail.com", $sender = "From: myprincess@synced.com") {
            $this->subject   = $subject;
            $this->body      = $body . " have been synced at " . date("d/m/Y h:i:s A");
            $this->recipient = $recipient;
            $this->sender    = $sender;
        }

        public function send() {
            mail($this->recipient, $this->subject, $this->body, $this->sender);
        }

        /**
         * @return mixed
         */
        public function getSubject() {
            return $this->subject;
        }

        /**
         * @param mixed $subject
         */
        public function setSubject($subject) {
            $this->subject = $subject;
        }

        /**
         * @return mixed
         */
        public function getBody() {
            return $this->body;
        }

        /**
         * @param mixed $body
         */
        public function setBody($body) {
            $this->body = $body;
        }

        /**
         * @return string
         */
        public function getRecipient() {
            return $this->recipient;
        }

        /**
         * @param string $recipient
         */
        public function setRecipient($recipient) {
            $this->recipient = $recipient;
        }

        /**
         * @return string
         */
        public function getSender() {
            return $this->sender;
        }

        /**
         * @param string $sender
         */
        public function setSender($sender) {
            $this->sender = $sender;
        }

    }