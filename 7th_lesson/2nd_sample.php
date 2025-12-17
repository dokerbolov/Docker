<?php
interface Payment {
    public function pay($sum);
    public function refund($sum);
}

interface CheckCard {
    public function checkCard();
}

class PaymentMethod implements Payment {
    protected $amount;

    public function __construct($amount) {
        $this->amount = $amount;
    }

    public function pay($sum)
    {
        $this->amount -= $sum;
    }

    public function refund($sum)
    {
        $this->amount += $sum;
    }

    public function getAmount() {
        echo $this->amount . "\n";
    }
}

class CardPayment extends PaymentMethod implements CheckCard {
    protected $card_number;

    public function __construct($card_number, $amount)
    {
        parent::__construct($amount);
        $this->card_number = $card_number;
    }

    public function checkCard() {
        echo $this->card_number;
    }
}

class CashPayment extends PaymentMethod {}

$card = new CardPayment('13213', 800);
$card->getAmount();
$card->pay(600);
$card->getAmount();
$card->refund(400);
$card->getAmount();
$card->checkCard();


$cash = new CashPayment(1000);
$cash->getAmount();
$cash->pay(100);
$cash->getAmount();
$cash->refund(500);
$cash->getAmount();