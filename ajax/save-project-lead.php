<?php
// ajax/save-project-lead.php

// error_reporting(0);
// ini_set('display_errors', 0);
console.log('ajax/save-project-lead.php loaded');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json; charset=UTF-8');

try {
    require __DIR__ . '/../db.php';
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Cannot load db.php: ' . $e->getMessage()
    ]);
    exit;
}

// ===================
// REQUEST CHECK
// ===================
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error']);
    exit;
}

// ===================
// HONEYPOT CHECK
// ===================
if (!empty($_POST['website'])) {
    echo json_encode(['status' => 'success']);
    exit;
}

// ===================
// SANITIZE INPUT
// ===================
$name           = trim($_POST['name'] ?? '');
$business_name  = trim($_POST['business_name'] ?? '');
$email          = trim($_POST['email'] ?? '');
$phone          = trim($_POST['phone'] ?? '');
$service_type   = trim($_POST['service_type'] ?? '');
$preferred_time = trim($_POST['preferred_time'] ?? '');
$remarks        = trim($_POST['remarks'] ?? '');

if ($name === '' || $email === '' || $phone === '' || $service_type === '') {
    echo json_encode(['status' => 'error']);
    exit;
}

// ===================
// SAVE TO DATABASE
// ===================
if (!$conn) {
    echo json_encode(['status'=>'error', 'message'=>'No database connection']);
    exit;
}

$stmt = $conn->prepare("
    INSERT INTO project_leads
    (name, business_name, email, phone, service_type, preferred_time, remarks, source_page, ip_address, user_agent)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

if (!$stmt) {
    echo json_encode(['status' => 'error','message'=>$conn->error]);
    exit;
}

$stmt->bind_param(
    "ssssssssss",
    $name,
    $business_name,
    $email,
    $phone,
    $service_type,
    $preferred_time,
    $remarks,
    $_SERVER['HTTP_REFERER'] ?? '',
    $_SERVER['REMOTE_ADDR'] ?? '',
    substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255)
);

$stmt->execute();
$stmt->close();

// ===================
// ADMIN EMAIL
// ===================
$adminEmail = "hello@livingroomstoriez.co.in";
$subjectAdmin = "New Project Inquiry – Living Room Storiez";

$adminMessage = "New project enquiry received:\n\n"
    . "Name: $name\n"
    . "Business: $business_name\n"
    . "Email: $email\n"
    . "Phone: $phone\n"
    . "Service: $service_type\n"
    . "Preferred Time: $preferred_time\n\n"
    . "Remarks:\n$remarks\n";

$headersAdmin = "From: Living Room Storiez <no-reply@livingroomstoriez.co.in>\r\n";
@mail($adminEmail, $subjectAdmin, $adminMessage, $headersAdmin);

// ===================
// USER AUTO-REPLY
// ===================
$subjectUser = "Thanks for contacting Living Room Storiez";
$userMessage = "Thanks for contacting Living Room Storiez — we’ll get back shortly.";

$headersUser = "From: Living Room Storiez <hello@livingroomstoriez.co.in>\r\n";
@mail($email, $subjectUser, $userMessage, $headersUser);

// ===================
// FINAL JSON RESPONSE
// ===================
echo json_encode(['status' => 'success']);
exit;
