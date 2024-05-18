<?php
    /**
     * Pet class represents a pet
     */

    class Pet {
        private string $_animal;
        private string $_color;

        /**
         * Constructor creates a Pet object
         * @param $_animal string the type of pet (i.e. "cat")
         * @param $_color string the color of the pet
         */
        public function __construct(string $_animal="unknown animal", string $_color="unknown color")
        {
            $this->_animal = $_animal;
            $this->_color = $_color;
        }

        public function getAnimal(): string
        {
            return $this->_animal;
        }

        public function setAnimal(string $animal): void
        {
            $this->_animal = $animal;
        }

        public function getColor(): string
        {
            return $this->_color;
        }

        public function setColor(string $color): void
        {
            $this->_color = $color;
        }
    }