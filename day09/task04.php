<?php

function whoami() {
    $name = $_POST["name"] ?? "";
    $age = $_POST["age"] ?? "";
    // ??：Null Coalescing Operator（空值合併運算子）
    // 如果左邊的值存在且不是 null，就使用??左邊；否則使用??右邊的預設值

    if ($name !== "" && filter_var($age, FILTER_VALIDATE_INT) !== false && (int)$age >= 0) {
        // FILTER_VALIDATE_INT：檢查資料是否為有效整數        &&: AND
        echo "Hi, my name is $name and I'm $age years old.";
    } elseif ($name === "" && filter_var($age, FILTER_VALIDATE_INT) !== false && (int)$age >= 0) {
        echo "Hi, I have no name and I'm $age years old.";
    } elseif ($name !== "") {
        echo "Hi, my name is $name.";
    } else {
        echo "Hi, I have no name.";
    }
}

?>