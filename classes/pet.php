<?php

    class Pet {
        private $_animal;
        private $_color;

        public function __construct($_animal="", $_color="")
        {
            $this->_animal = $_animal;
            $this->_color = $_color;
        }
    }