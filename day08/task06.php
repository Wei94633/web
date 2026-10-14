<?php

function sequence(int $n): void {    
    // :void：代表這個函式不回傳數值

    if ($n < 0) {
        return;
    }

    $current = "1";

    for ($i = 0; $i <= $n; $i++) {

        echo $current . PHP_EOL;

        $next = "";
        $count = 1;

        for ($j = 1; $j < strlen($current); $j++) {

            if ($current[$j] == $current[$j - 1]) {
                $count++;

            } else {
                $next .= $count . $current[$j - 1];     // .= :是串接後再指定回原變數
                $count = 1;
            }
        }

        $next .= $count . $current[strlen($current) - 1];

        $current = $next;
    }
}
