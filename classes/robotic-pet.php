<?php
    class RoboticPet extends Pet {
        private string $_accessories;

        function __construct(string $animal="unknown animal",
                             string $color="unknown color",
                             string $accessories="no accessories")
        {
            //Pass name and color to the Pet constructor
            parent::__construct($animal, $color);

            //Set stuffed pet variables
            $this->_accessories = $accessories;
        }

        public function getAccessories(): string
        {
            return $this->_accessories;
        }

        public function setAccessories(string $accessories): void
        {
            $this->_accessories = $accessories;
        }
    }