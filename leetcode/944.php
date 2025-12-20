<?php
    $strs = ["zyx","wvu","tsr"];
    $array = [];
    $cnt = 0;

    $size = mb_strlen($strs[0]);
    for($i = 0; $i < sizeof($strs); $i++) {
        for($j = 0; $j < $size; $j++) {
            $letter = $strs[$i];
            $temp = $array[$j];
            $array[$j] = $array[$j] . $letter[$j];
        }
    }

    for($i = 0; $i < sizeof($array); $i++) {
        $temp = $array[$i];
        $string_parts = str_split($temp);
        sort($string_parts);
        $sorted_string = implode($string_parts);
        if($sorted_string != $temp) {
            $cnt++;
        }
    }

    echo $cnt;
?>
