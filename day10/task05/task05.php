<?php

header("Content-Type: application/json");

$type = $_GET["type"] ?? "";
$brand = $_GET["brand"] ?? "";
$price = $_GET["price"] ?? "";
$number = $_GET["number"] ?? "";

function sendError($message) {
    http_response_code(400);
    echo json_encode(["error" => $message]);
    exit;
}

try {
    $db = new PDO("sqlite:" . __DIR__ . "/ajax_products.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Validate type
    if (strlen($type) < 3) {
        sendError("Error ($type): this type does not have enough characters.");
    } elseif (strlen($type) > 10) {
        sendError("Error ($type): this type has too many characters.");
    } elseif (!preg_match("/^[a-z-]+$/i", $type)) {
        sendError("Error ($type): this type has non-alphabetical characters (different from '-').");
    }

    $stmt = $db->prepare(
        "SELECT COUNT(*) FROM products WHERE LOWER(type) = LOWER(?)"
    );
    $stmt->execute([$type]);

    if ($stmt->fetchColumn() == 0) {
        sendError("Error ($type): this type doesn't exist in our shop.");
    }

    // Validate brand
    if (strlen($brand) < 2) {
        sendError("Error ($brand): this brand does not have enough characters.");
    } elseif (strlen($brand) > 20) {
        sendError("Error ($brand): this brand has too much characters.");
    } elseif (!preg_match("/^[a-z0-9&-]+$/i", $brand)) {
        sendError("Error ($brand): this brand has invalid characters.");
    }

    $stmt = $db->prepare(
        "SELECT COUNT(*) FROM products
         WHERE LOWER(type) = LOWER(?)
         AND LOWER(brand) = LOWER(?)"
    );
    $stmt->execute([$type, $brand]);

    if ($stmt->fetchColumn() == 0) {
        sendError("Error ($brand): this brand doesn't exist in our database.");
    }

    // Validate price
    if (strlen($price) < 2) {
        sendError("Error ($price): this price does not have enough characters.");
    } elseif (strlen($price) > 5) {
        sendError("Error ($price): this price has too many characters.");
    } elseif (!preg_match("/^[<>=][0-9]+$/", $price)) {
        sendError("Error ($price): we cannot define a price - string invalid.");
    }

    // Validate number
    if (!ctype_digit($number) || (int)$number <= 0) {
        sendError("Error ($number): not a positive number.");
    }

    // Separate price operator and value
    $operator = $price[0];
    $priceValue = (int)substr($price, 1);
    $quantity = (int)$number;

    // Search products
    $stmt = $db->prepare(
        "SELECT type, brand, price, stock
         FROM products
         WHERE LOWER(type) = LOWER(?)
         AND LOWER(brand) = LOWER(?)
         AND price $operator ?"
    );

    $stmt->execute([$type, $brand, $priceValue]);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($products) == 0) {
        sendError("Error ($price): no products found at this price.");
    }

    // Check stock
    $results = [];
    $maxStock = 0;

    foreach ($products as $product) {
        $maxStock = max($maxStock, (int)$product["stock"]);

        if ($product["stock"] >= $quantity) {
            $product["number"] = $quantity;
            $results[] = $product;
        }
    }

    if (count($results) == 0) {
        sendError("Error ($number): sorry, we don't have enough stock, we only have $maxStock in stock.");
    }

    echo json_encode(["products" => $results]);

} catch (PDOException $error) {
    http_response_code(500);
    echo json_encode(["error" => "Database error"]);
}
