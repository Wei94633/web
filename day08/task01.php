
<?php    // php起始標籤

// 變數前面都要加上$
function discover_type(int $age, string $name, float $gpa, bool $isStudent) {

    if ($isStudent) {
        echo "Hello my name is $name, I'm $age years old. I'm a student at Epitech with a GPA of $gpa." . PHP_EOL;
    } else {
        echo "Hello my name is $name, I'm $age years old. I'm not a student." . PHP_EOL;   // .:字串連接運算子(類似+)   
    }       // echo:輸出內容                                                       // PHP_EOL: 換行符號
}
