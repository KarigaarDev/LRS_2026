<?php
require_once '../db.php'; // your DB connection

$data = json_decode(file_get_contents('php://input'), true);

if (!$data || empty($data['event'])) {
    http_response_code(400);
    exit;
}

$event = $data['event'];
$page  = $data['page'] ?? '';
$meta  = json_encode($data['meta'] ?? []);
$ip    = $_SERVER['REMOTE_ADDR'];
$ua    = $_SERVER['HTTP_USER_AGENT'];

$stmt = $conn->prepare("
    INSERT INTO analytics_events (event_name, page, meta, ip_address, user_agent)
    VALUES (?, ?, ?, ?, ?)
");

$stmt->bind_param("sssss", $event, $page, $meta, $ip, $ua);
$stmt->execute();

echo json_encode(['status' => 'ok']);
