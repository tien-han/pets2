<?php
    class StuffedPet extends Pet {
        private string $_size;
        private string $_stuffingType;
        private string $_material;

        function __construct(string $animal="unknown animal",
                             string $color="unknown color",
                             string $size="unknown size",
                             string $stuffingType="unknown stuffing type",
                             string $material="unknown material type")
        {
            //Pass name and color to the Pet constructor
            parent::__construct($animal, $color);

            //Set stuffed pet variables
            $this->_size = $size;
            $this->_stuffingType = $stuffingType;
            $this->_material = $material;
        }

        public function getSize(): string
        {
            return $this->_size;
        }

        public function setSize(string $size): void
        {
            $this->_size = $size;
        }

        public function getStuffingType(): string
        {
            return $this->_stuffingType;
        }

        public function setStuffingType(string $stuffingType): void
        {
            $this->_stuffingType = $stuffingType;
        }

        public function getMaterial(): string
        {
            return $this->_material;
        }

        public function setMaterial(string $material): void
        {
            $this->_material = $material;
        }
    }