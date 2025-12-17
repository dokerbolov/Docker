<?php
    abstract class Shape {
        public $sides;

        public function __construct($sides) {
            $this->sides = $sides;
        }

        public function getSides()
        {
            echo $this->sides . "\n";
        }

        abstract function getPerimeter();
    }

    class Triangle extends Shape {

        public $side1;
        public $side2;
        public $side3;

        public function __construct($sides, $side1, $side2, $side3)
        {
            parent::__construct($sides);
            $this->side1 = $side1;
            $this->side2 = $side2;
            $this->side3 = $side3;
        }

        function getPerimeter()
        {
            echo "Perimeter of Triangle: " . ($this->side1 + $this->side2 + $this->side3) . "\n";
        }
    }

    class Square extends Shape {
        public $length;

        public function __construct($sides, $length)
        {
            parent::__construct($sides);
            $this->length = $length;
        }

        public function getPerimeter()
        {
            echo "Perimeter of Square: " . ($this->length * 4) . "\n";
        }
    }

    class Circle extends Shape {
        protected $pi = 3.14;
        public $radius;

        public function __construct($sides, $radius)
        {
            parent::__construct($sides);
            $this->radius = $radius;
        }

        public function getPerimeter()
        {
            echo "Perimeter of Circle: " . (2 * $this->radius * $this->pi) . "\n";
        }
    }

    $triangle = new Triangle(3, 1, 2, 2);
    $square = new Square(4, 2);
    $circle = new Circle(0, 3);

    $triangle->getSides();
    $triangle->getPerimeter();

    $square->getSides();
    $square->getPerimeter();

    $circle->getSides();
    $circle->getPerimeter();
?>
