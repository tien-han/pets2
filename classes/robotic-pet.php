<?php
    class RoboticPet extends Pet {
        private array $_accessories;

        function __construct(string $animal="unknown animal",
                             string $color="unknown color",
                             array $accessories=['no accessories'])
        {
            //Pass name and color to the Pet constructor
            parent::__construct($animal, $color);

            //Set stuffed pet variables
            $this->_accessories = $accessories;
        }

        public function getAccessories(): array
        {
            return $this->_accessories;
        }

        public function setAccessories(array $accessories): void
        {
            $this->_accessories = $accessories;
        }
    }