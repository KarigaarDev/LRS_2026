<?php
// maintenance.php
if (!isset($maintenanceMessage)) {
    $maintenanceMessage = 'We are under maintenance. Please check back soon.';
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Maintenance</title>

<style>
    body {
        margin: 0;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', Roboto, Arial, sans-serif;
        background: linear-gradient(135deg, #6c63ff, #8f88ff);
    }

    .maintenance-box {
        background: #fff;
        max-width: 420px;
        width: 90%;
        padding: 40px 30px;
        border-radius: 16px;
        text-align: center;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .maintenance-box img {
        max-width: 140px;
        margin-bottom: 20px;
    }

    h1 {
        margin-bottom: 10px;
        color: #333;
        font-size: 1.6rem;
    }

    p {
        color: #666;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    .loader {
        width: 40px;
        height: 40px;
        border: 4px solid #e5e7eb;
        border-top: 4px solid #6c63ff;
        border-radius: 50%;
        margin: 0 auto;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>
</head>

<body>
    <div class="maintenance-box">
        <img src="assets/images/logo.png" alt="Logo">
        <h1><?= htmlspecialchars($maintenanceMessage) ?></h1>
        <p>We’ll be back soon ✨</p>
        <div class="loader"></div>
    </div>
</body>
</html>
