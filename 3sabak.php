<?php
    $a = 6;
    $b = "5";

    echo "a:" . gettype($a) . ' ' . "b:" . gettype($b) . "\n";

    if ($a === $b) {
        echo "Сандар тен, жане онын типтеріде тен";
    } elseif($a == $b) {
        echo "Сандар тен";
    } else {
        echo "nothing";
    }
?>
