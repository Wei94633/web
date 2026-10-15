<?php

function dynamic_body() {
    if (!isset($_GET["page"])) {
        // isset()：檢查變數是否存在且不是 null
        return "<p>Unknown page</p>";
    }

    $page = $_GET["page"];     // 取得網址後面的文字

    if ($page === "home") {
        return file_get_contents("home.html");
    } elseif ($page === "php") {
        return file_get_contents("php.html");
    } elseif ($page === "sql") {
        return file_get_contents("sql.html");
    } else {
        return "<p>Unknown page</p>";
    }
}

?>