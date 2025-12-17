<?php
    require_once "Delivery.php";
    require_once "../Interfaces/Trackable.php";

    class CarDelivery extends Delivery implements Trackable {
        public $car_mark;

        public function __construct($distance, $car_mark = 'Toyota')
        {
            $this->car_mark = $car_mark;
            parent::__construct($distance);
        }

        public function deliver()
        {
            return "Delivering by $this->car_mark car \n";
        }

        public function showPosition()
        {
            return "I am on the road \n";
        }
    }
?>
