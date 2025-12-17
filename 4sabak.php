<?php

function getInputs($sum) {
    echo "1-ші санды еңгізініз: ";
    $num2 = trim(fgets(STDIN));
    return [
        'num1' => $sum,
        'num2' => $num2
    ];
}

function outputs($total, $text) {
    echo "Сандардың $text: " . $total . "\n";
}

function operartion($a, $b, $operation, &$sum) {
    switch ($operation) {
        case '+':
            $result = $a + $b;
            $sum = $result;
            return $result;
        case '-' :
            $result = $a - $b;
            $sum = $result;
            return $result;
        case '*':
            $result = $a * $b;
            $sum = $result;
            return $result;
        case '/':
            $result = $a / $b;
            $sum = $result;
            return $result;
        default:
            return 0;
    }
}

echo "Жасағыныз келген опперацияны танданыз: \n 
      1) + \n
      2) - \n
      3) * \n
      4) / \n
      5) AC \n
      6) Прогаммадан шығу \n";

$boolean = true;
$sum = 0;
while($boolean) {

    $operation = trim(fgets(STDIN));

    switch ($operation) {
        case 1:
            $array = getInputs($sum);
            $total = operartion($array['num1'], $array['num2'], '+', $sum);
            outputs($total, 'қосындысы');
            break;
        case 2:
            $array = getInputs($sum);
            $total = operartion($array['num1'], $array['num2'], '-', $sum);
            outputs($total, 'айырмасы');
            break;
        case 3:
            $array = getInputs($sum);
            $total = operartion($array['num1'], $array['num2'], '*', $sum);
            outputs($total, 'көбейтіндісі');
            break;
        case 4:
            $array = getInputs($sum);
            $total = operartion($array['num1'], $array['num2'], '/', $sum);
            outputs($total, 'бөліндісі');
            break;
        case 5:
            $sum = 0;
            break;
        case 6:
            $boolean = 0;
            break;
        default:
            echo "Сіз дұрыс емес операцияны тандадыңыз!";
            break;
    }
}

?>
