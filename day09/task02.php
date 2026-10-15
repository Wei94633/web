<?php

function render_body($page) {
    if ($page == "home") {
        return file_get_contents("home.html");    
        // file_get_contents()：讀取檔案內容，並將內容以字串形式回傳
        
    } elseif ($page == "php") {
        return file_get_contents("php.html");
    } elseif ($page == "sql") {
        return file_get_contents("sql.html");
    } else {
        return "<p>Unknown page</p>";
    }
}

?>