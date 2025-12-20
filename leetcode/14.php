<?php
    $strs = ["flower","flow","floight"];
    $prefix = $strs[0];

    function compare($s1, $s2) {
        $string_parts1 = str_split($s1);
        $string_parts2 = str_split($s2);
        $size = min(sizeof($string_parts1), sizeof($string_parts2));
        $index = 0;
        $result = '';

        for($i = 0; $i < $size; $i++) {
            if($string_parts2[$i] == $string_parts1[$i]) {
                $index = $i+1;
                continue;
            } else {
                break;
            }
        }

        for($i = 0; $i < $index; $i++) {
            $result .= $string_parts2[$i];
        }

        return $result;
    }

    for($i = 1; $i < sizeof($strs); $i++) {
        if($prefix == '') {
            break;
        }
        $prefix = compare($strs[$i], $prefix);
    }

    echo $prefix;