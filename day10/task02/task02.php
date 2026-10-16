<?php

$email = $_POST["email"] ?? "";

if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // FILTER_VALIDATE_EMAIL：檢查 Email 格式的驗證規則

    http_response_code(200);
    echo "Valid email";
} else {
    http_response_code(400);
    echo "Invalid email";
}

?>