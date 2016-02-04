<?php
    /**
     * Created by PhpStorm.
     * User: evolutionarycoder
     * Date: 2/3/16
     * Time: 7:09 PM
     */

    namespace Backend\Helpers;


    class TableBuilder {
        private $attr;
        private $actionAttrs;
        private $cells;

        /**
         * TableBuilder constructor.
         *
         */
        public function __construct() {
            $this->cells = "";
            $this->attr        = "";
            $this->actionAttrs = "";
        }


        public function buildCell($celltext) {
            $this->cells .= "<td>{$celltext}</td>";
            return $this;
        }

        private function reset(){
            $this->cells = "";
            $this->actionAttrs = "";
            $this->attr = "";
        }

        public function buildRow() {
            $row = "<tr {$this->attr}>" . $this->cells . $this->buildActions() . "</tr>";
            $this->reset();
            return $row;
        }

        public function addRowAttr($attr, $val) {
            $this->attr .= " data-" . $attr . "='" . $val . "'";
            return $this;
        }

        public function addActionAttrs($attr, $val) {
            $this->actionAttrs .= " data-" . $attr . "='" . $val . "'";
            return $this;
        }

        public function buildActions() {
            return "<td class=\"actions\">
                            <a href=\"#\" {$this->actionAttrs} class=\"on-default edit-row\"><i class=\"fa fa-pencil\"></i></a>
                            <a href=\"#\" {$this->actionAttrs} class=\"on-default remove-row\"><i class=\"fa fa-trash-o\"></i></a>
                    </td>";
        }
    }