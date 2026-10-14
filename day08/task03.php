<?php

function get_shortest(array $words) {

    $shortest = $words[0];

    foreach ($words as $word) {    
    // foreach 會依序取出陣列中的每個元素

        if (strlen($word) < strlen($shortest)) {
            // strlen() 是 PHP 用來取得字串長度的函式
            $shortest = $word;
        }
    }

    return $shortest;
}
