<?php
    class Product {
        public $name;
        public $price;

        public function __construct($name) {
            $this->name = $name;
        }

        public function getPrice() {
            return "Price of $this->name " . $this->price . " Tenge";
        }

        public function setPrice($price) {
            if($price > 0) {
                $this->price = $price;
            }
        }

        public function __destruct()
        {
            echo "Products selled\n";
        }
    }

    $temp = '';
    $products = [];
    $bool = true;

    while($bool) {
        echo "1. Продуктыны енгізу \n
        2. Продуктілер тізімін қарау \n
        3. Шығу \n";

        $temp = trim(fgets(STDIN));

        switch ($temp) {
            case 1:
                echo "Продуктінің атауын енгізініз: ";
                $name = trim(fgets(STDIN));
                $product = new Product($name);
                echo "Продуктінің бағасын енгізініз: ";
                $price = trim(fgets(STDIN));
                $product->setPrice($price);
                $products[] = $product;
                break;
            case 2:
                echo "Продуктілер тізімі: \n";
                for($i = 0; $i < count($products); $i++) {
                    $selected_product = $products[$i];
                    $order = $i + 1;
                    echo "$order - $selected_product->name\n";
                }

                $count = count($products) + 1;

                echo "Продуктіні тандау үшін оның нөмерін жазыныз  \n
                $count. Артқа \n";

                $product_order = trim(fgets(STDIN));

                if($product_order == $count) {
                    break;
                } else {
                    $temp_product = $products[$product_order - 1];
                    echo "Продуктінің аты: $temp_product->name, Продуктінің бағасы: $temp_product->price \n";
                    echo "Продуктіні сатып алғыныз келсе, 1-ді жазыныз \n";
                    $decision = trim(fgets(STDIN));
                    if($decision == 1) {
                        // [ 1, 2, 3, 4, 5 ]
                        $first_half = array_slice($products, 0, $count - 1);
                        // [1,2]
                        $second_half = array_slice($products, $count, count($products));
                        // [4,5]
                        $products = [];
                        // []
                        $products[] = $first_half;
                        // [1,2]
                        $products[] = $second_half;
                        // [1,2,4,5]
                        echo "Продуктіні $temp_product->name сәтті сатып алдыныз \n";
                        break;
                    } else {
                        break;
                    }
                }
            case 3:
                $bool = false;
                break;
                default:
                    echo "Ондай команда жоқ";
                    break;
        }
    }
?>
