
<?php

function calc_average(array $numbers) {

    $total = 0;

    foreach ($numbers as $number) {
        $total += $number;
    }

    $average = $total / count($numbers);

    return round($average, 1);
}