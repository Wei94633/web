<?php

header("Content-Type: application/json");

$type = $_POST["type"] ?? "";
$brand = $_POST["brand"] ?? "";
$price = $_POST["price"] ?? "";
$stock = $_POST["stock"] ?? "";

// Send error message
function sendError($message) {
    http_response_code(400);
    echo json_encode(["error" => $message]);
    exit;
}

// Validate type
if (strlen($type) < 3) {
    sendError("Type must have at least 3 characters.");
} elseif (strlen($type) > 10) {
    sendError("Type must have at most 10 characters.");
} elseif (!preg_match("/^[a-z-]+$/i", $type)) {
    sendError("Type contains invalid characters.");
}

// Validate brand
if (strlen($brand) < 2) {
    sendError("Brand must have at least 2 characters.");
} elseif (strlen($brand) > 20) {
    sendError("Brand must have at most 20 characters.");
} elseif (!preg_match("/^[a-z0-9&-]+$/i", $brand)) {
    sendError("Brand contains invalid characters.");
}

// Validate price
if (!is_numeric($price) || $price === "" || $price < 0) {
    sendError("Price must be a non-negative number.");
}

// Validate stock
if ($stock === "" || !ctype_digit($stock)) {
    sendError("Stock must be a non-negative integer.");
}

try {
    // Connect to SQLite
    $db = new PDO("sqlite:" . __DIR__ . "/ajax_products.db");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if product exists
    $stmt = $db->prepare(
        "SELECT id FROM products
         WHERE LOWER(type) = LOWER(?)
         AND LOWER(brand) = LOWER(?)"
    );

    $stmt->execute([$type, $brand]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        // Update existing product
        $stmt = $db->prepare(
            "UPDATE products
             SET price = ?, stock = ?
             WHERE id = ?"
        );

        $stmt->execute([$price, $stock, $product["id"]]);

        echo json_encode([
            "message" => "Product updated successfully."
        ]);

    } else {
        // Insert new product
        $stmt = $db->prepare(
            "INSERT INTO products (type, brand, price, stock)
             VALUES (?, ?, ?, ?)"
        );

        $stmt->execute([$type, $brand, $price, $stock]);

        echo json_encode([
            "message" => "Product added successfully."
        ]);
    }

} catch (PDOException $error) {
    http_response_code(500);
    echo json_encode([
        "error" => "Database error."
    ]);
}
