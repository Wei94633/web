<?php

function form_is_submitted() {
    return isset($_POST["submit"]);
}

function whoami() {
    $name = $_POST["name"] ?? "";
    $age = $_POST["age"] ?? "";
    $curriculum = $_POST["curriculum"] ?? "";

    $valid_age = filter_var($age, FILTER_VALIDATE_INT) !== false && (int)$age >= 0;

    if ($name !== "" && $valid_age) {
        echo "Hi, my name is $name and I'm $age years old.";
    } elseif ($name === "" && $valid_age) {
        echo "Hi, I have no name and I'm $age years old.";
    } elseif ($name !== "") {
        echo "Hi, my name is $name.";
    } else {
        echo "Hi, I have no name.";
    }

    $curriculums = [
        "pge" => "PGE (Programme Grande Ecole)",
        "bachelor" => "Bachelor",
        "msc" => "MSc Pro",
        "coding" => "Coding Academy",
        "wac" => "Web@cademie"
    ];

    if ($curriculum !== "" && isset($curriculums[$curriculum])) {
        echo " I'm a student of " . $curriculums[$curriculum] . ".";
    }
}

?>