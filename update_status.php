<?php
// update_status.php

// صرف GET یا POST میں "status" parameter قبول کرے گا
// status = "open" یا "closed"

if (!isset($_GET['status'])) {
    http_response_code(400);
    echo json_encode(["error" => "Missing status parameter"]);
    exit;
}

$status = strtolower($_GET['status']);
if ($status !== "open" && $status !== "closed") {
    http_response_code(400);
    echo json_encode(["error" => "Invalid status. Use 'open' or 'closed'."]);
    exit;
}

// status.json کی path
$file = 'status.json';

// JSON data بنائیں
$data = [
    "open" => ($status === "open")
];

// فائل میں write کریں
if (file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT))) {
    echo json_encode(["success" => true, "new_status" => $status]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Failed to write to status.json"]);
}
?>
