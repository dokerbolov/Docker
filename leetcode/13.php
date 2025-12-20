<?php
    $s = 'LVIII';
    $number = 0;

    $dic = [
        'I' => 1,
        'V' => 5,
        'X' => 10,
        'L' => 50,
        'C' => 100,
        'D' => 500,
        'M' => 1000
    ];

    function checkPrevious($a, $b) {
        if(($b == 'V' || $b == 'X') && $a == 'I') {
            return true;
        } else if (($b == 'L' || $b == 'C') && $a == 'X') {
            return true;
        } else if (($b == 'D' || $b == 'M') && $a == 'C') {
            return true;
        } else {
            return false;
        }
    }

    for($i = 1; $i < mb_strlen($s); $i++) {
        $bool = checkPrevious($s[$i-1], $s[$i]);
        if($bool) {
            $temp = $dic[$s[$i]] - $dic[$s[$i-1]];
            $number += $temp;
            $i++;
        } else {
            $number += $dic[$s[$i-1]];
        };
    }
    if(!checkPrevious($s[mb_strlen($s) - 2], $s[mb_strlen($s) - 1])) {
        $number += $dic[$s[mb_strlen($s) - 1]];
    }

    echo $number;
?>
