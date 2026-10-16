<?php

header("Content-Type: application/json");

$file = __DIR__ . "/messages.json";

// Read messages
function readMessages($file) {
    if (!file_exists($file)) {
        return [];
    }

    $content = file_get_contents($file);
    $messages = json_decode($content, true);

    if (!is_array($messages)) {
        return [];
    }

    return $messages;
}

// Send error
function sendError($message) {
    http_response_code(400);
    echo json_encode(["error" => $message]);
    exit;
}

// GET: load messages
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $messages = readMessages($file);

    echo json_encode(["messages" => $messages]);
    exit;
}

// POST: send a new message
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($name === "") {
        sendError("Name cannot be empty.");
    }

    if ($message === "") {
        sendError("Message cannot be empty.");
    }

    $messages = readMessages($file);

    $messages[] = [
        "name" => $name,
        "message" => $message
    ];

    $result = file_put_contents(
        $file,
        json_encode($messages, JSON_PRETTY_PRINT),
        LOCK_EX
    );

    if ($result === false) {
        http_response_code(500);
        echo json_encode(["error" => "Failed to save message."]);
        exit;
    }

    echo json_encode(["message" => "Message sent successfully."]);
    exit;
}

http_response_code(405);
echo json_encode(["error" => "Method not allowed."]);
