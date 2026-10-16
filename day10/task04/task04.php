<?php

header("Content-Type: application/json");

$type = $_GET["type"] ?? "";
$brand = $_GET["brand"] ?? "";

$typeMessage = "";
$brandMessage = "";
$typeValid = false;
$brandValid = false;

try {
    $db = new PDO("sqlite:" . __DIR__ . "/ajax_products.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Validate type
    if ($type === "") {
        $typeMessage = "No type sent yet!";
    } elseif (strlen($type) < 3) {
        $typeMessage = "$type: this type does not have enough characters.";
    } elseif (strlen($type) > 10) {
        $typeMessage = "$type: this type has too many characters.";
    } elseif (!preg_match("/^[a-z-]+$/i", $type)) {
        $typeMessage = "$type: this type has non-alphabetical characters (different from '-').";
    } else {
        $stmt = $db->prepare(
            "SELECT COUNT(*) FROM products WHERE LOWER(type) = LOWER(?)"
        );
        $stmt->execute([$type]);

        if ($stmt->fetchColumn() > 0) {
            $typeMessage = "$type: this type exists in databases.";
            $typeValid = true;
        } else {
            $typeMessage = "$type: this type doesn't exist in our shop.";
        }
    }

    // Validate brand
    if ($brand === "") {
        $brandMessage = "No brand sent yet!";
    } elseif (strlen($brand) < 2) {
        $brandMessage = "$brand: this brand does not have enough characters.";
    } elseif (strlen($brand) > 20) {
        $brandMessage = "$brand: this brand has too many characters.";
    } elseif (!preg_match("/^[a-z0-9&-]+$/i", $brand)) {
        $brandMessage = "$brand: this brand has invalid characters.";
    } elseif ($typeValid) {
        $stmt = $db->prepare(
            "SELECT COUNT(*) FROM products
             WHERE LOWER(type) = LOWER(?)
             AND LOWER(brand) = LOWER(?)"
        );
        $stmt->execute([$type, $brand]);

        if ($stmt->fetchColumn() > 0) {
            $brandMessage = "$brand: this brand already exists in databases.";
        } else {
            $brandMessage = "$brand: this brand is valid for the type $type.";
            $brandValid = true;
        }
    } else {
        $brandMessage = "$brand: waiting for a valid type.";
    }

    echo json_encode([
        "typeMessage" => $typeMessage,
        "brandMessage" => $brandMessage,
        "typeValid" => $typeValid,
        "brandValid" => $brandValid
    ]);

} catch (PDOException $error) {
    http_response_code(500);
    echo json_encode(["error" => "Database error"]);
}

?>
