<?php
    abstract class Delivery {
        protected $distance;

        public function __construct($distance) {
            $this->distance = $distance;
        }

        public function getPrice() {
            return "The price: " . $this->distance * 10 . "\n";
        }

        abstract public function deliver();
    }
?>
