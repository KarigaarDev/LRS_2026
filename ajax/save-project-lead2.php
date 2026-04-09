<?php
// Nothing (no space, no comment, no blank line) before this line!

ob_start();  // Start output buffering IMMEDIATELY

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json; charset=utf-8');

// ... rest of your code (try { require ... } etc.)

try {
    require __DIR__ . '/../db.php';
} catch (Throwable $e) {
    ob_end_clean();
    http_response_code(500);
    echo json_encode([
        'status'  => 'error',
        'type'    => 'db_require_failed',
        'message' => $e->getMessage(),
        'file'    => $e->getFile(),
        'line'    => $e->getLine()
    ]);
    exit;
}

// Check connection
if ($conn->connect_error) {
    ob_end_clean();
    http_response_code(500);
    echo json_encode([
        'status'  => 'error',
        'type'    => 'db_connection_failed',
        'message' => $conn->connect_error
    ]);
    exit;
}

// ────────────────────────────────────────────────
// REQUEST VALIDATION
// ────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    ob_end_clean();
    echo json_encode(['status' => 'error', 'message' => 'Only POST allowed']);
    exit;
}

// Honeypot
if (!empty($_POST['website'])) {
    // pretend success to fool bots
    ob_end_clean();
    echo json_encode(['status' => 'success']);
    exit;
}

// ────────────────────────────────────────────────
// INPUT SANITIZATION
// ────────────────────────────────────────────────
$name           = trim($_POST['name']           ?? '');
$business_name  = trim($_POST['business_name']  ?? '');
$email          = trim($_POST['email']          ?? '');
$phone          = trim($_POST['phone']          ?? '');
$service_type   = trim($_POST['service_type']   ?? '');
$preferred_time = trim($_POST['preferred_time'] ?? '');
$remarks        = trim($_POST['remarks']        ?? '');

// Required fields
if ($name === '' || $email === '' || $phone === '' || $service_type === '') {
    ob_end_clean();
    echo json_encode([
        'status'  => 'error',
        'message' => 'Missing required fields'
    ]);
    exit;
}

// ────────────────────────────────────────────────
// DATABASE INSERT
// ────────────────────────────────────────────────
$stmt = $conn->prepare("
    INSERT INTO project_leads 
    (name, business_name, email, phone, service_type, preferred_time, remarks, source_page, ip_address, user_agent, created_at)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
");

if (!$stmt) {
    ob_end_clean();
    echo json_encode([
        'status'  => 'error',
        'type'    => 'prepare_failed',
        'message' => $conn->error
    ]);
    exit;
}

$referer    = $_SERVER['HTTP_REFERER']   ?? '';
$ip         = $_SERVER['REMOTE_ADDR']    ?? '';
$user_agent = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255);

$stmt->bind_param(
    "ssssssssss",   // ← FIXED: 10 s for 10 string parameters
    $name,
    $business_name,
    $email,
    $phone,
    $service_type,
    $preferred_time,
    $remarks,
    $referer,
    $ip,
    $user_agent
);

if (!$stmt->execute()) {
    ob_end_clean();
    echo json_encode([
        'status'  => 'error',
        'type'    => 'execute_failed',
        'message' => $stmt->error
    ]);
    $stmt->close();
    exit;
}

$stmt->close();

// // ────────────────────────────────────────────────
// // SEND EMAILS
// // ────────────────────────────────────────────────
// $adminEmail = "mindplus0@gmail.com";
// $fromHeader = "From: Living Room Storiez <no-reply@livingroomstoriez.co.in>\r\n";
// $replyTo    = "Reply-To: $email\r\n";

// $adminSubject = "New Project Lead – Living Room Storiez";
// $adminBody = "New enquiry:\n\n"
//     . "Name:           $name\n"
//     . "Business:       $business_name\n"
//     . "Email:          $email\n"
//     . "Phone:          $phone\n"
//     . "Service:        $service_type\n"
//     . "Preferred time: $preferred_time\n"
//     . "Remarks:\n$remarks\n\n"
//     . "IP: $ip\n"
//     . "Referer: $referer\n";

// @mail($adminEmail, $adminSubject, $adminBody, $fromHeader . $replyTo);

// // User thank-you email (very short & simple)
// $userSubject = "Thank you for contacting Living Room Storiez";
// $userBody = "Hi $name,\n\n"
//     . "Thank you for your interest!\n"
//     . "We have received your request and will get back to you shortly.\n\n"
//     . "Best regards,\nLiving Room Storiez Team";

// @mail($email, $userSubject, $userBody, $fromHeader);

// ────────────────────────────────────────────────
// SUCCESS
// ────────────────────────────────────────────────
ob_end_clean();
echo json_encode([
    'status'  => 'success',
    'message' => 'Request received successfully'
]);
exit;