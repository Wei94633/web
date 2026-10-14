<?php

function dog_bark(int $woof_nb) {
    
    for ($i = 1; $i <= $woof_nb; $i++) {

        if ($i > 1) {      // 只有一個woof時不用加空格
            echo " ";     // 加空格
        }

        echo "woof";
    }

    echo PHP_EOL;
}
