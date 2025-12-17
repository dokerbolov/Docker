<?php
    require_once "Delivery.php";
    require_once "../Interfaces/Trackable.php";
    require_once "../Interfaces/Cancelable.php";

    class BikeDelivery extends Delivery implements Trackable, Cancelable {

        public function __construct($distance)
        {
            parent::__construct($distance);
        }

        public function deliver()
        {
            return "Delivering by bike \n";
        }

        public function showPosition()
        {
            return "I am on the road \n";
        }

        public function cancel()
        {
            return "Your order is canceled \n";
        }
    }
?>
