<?php
session_start();
include 'db.php';

/* ==========================
   ADMIN LOGIN
========================== */
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if ($username && $password) {

        $stmt = $conn->prepare("
            SELECT id, username, password, role, is_active 
            FROM users 
            WHERE username = ? 
            LIMIT 1
        ");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();

        if (!$user) {
            $error = "Invalid username or password";
        } elseif (!$user['is_active']) {
            $error = "Your account is inactive. Contact admin.";
        } elseif (!password_verify($password, $user['password'])) {
            $error = "Invalid username or password";
        } else {
            // ✅ LOGIN SUCCESS
            $_SESSION['admin']    = true;
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role']     = $user['role'];

            header("Location: dashboard.php");
            exit;
        }
    } else {
        $error = "Please enter username and password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="assets/images/logo-thumb.png">

<style>
/* ===============================
   PREMIUM LOGIN UI
================================ */
* {
    box-sizing: border-box;
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
}

body {
    margin: 0;
    height: 100vh;
    background: radial-gradient(circle at top, #1a1445, #0b081a 70%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
}

/* Card */
.login-card {
    width: 100%;
    max-width: 380px;
    background: rgba(20, 16, 45, 0.85);
    backdrop-filter: blur(14px);
    border-radius: 18px;
    padding: 36px 32px 40px;
    box-shadow:
        0 25px 60px rgba(0,0,0,.6),
        inset 0 0 0 1px rgba(255,255,255,.05);
}

/* Logo */
.login-logo {
    text-align: center;
    margin-bottom: 18px;
}
.login-logo img {
    height: 80px;
}

/* Title */
.login-title {
    text-align: center;
    font-size: 22px;
    font-weight: 600;
    margin-bottom: 6px;
}
.login-sub {
    text-align: center;
    font-size: 13px;
    color: #b8b5ff;
    margin-bottom: 26px;
}

/* Input */
.form-group {
    margin-bottom: 16px;
}
.form-group input {
    width: 100%;
    padding: 13px 14px;
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,.12);
    background: rgba(255,255,255,.06);
    color: #fff;
    outline: none;
    font-size: 14px;
}
.form-group input::placeholder {
    color: #aaa;
}
.form-group input:focus {
    border-color: #7f5cff;
    background: rgba(255,255,255,.1);
}

/* Button */
.login-btn {
    width: 100%;
    padding: 13px;
    border-radius: 14px;
    border: none;
    background: linear-gradient(135deg, #7f5cff, #9d7bff);
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: transform .15s ease, box-shadow .15s ease;
}
.login-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 10px 25px rgba(127,92,255,.45);
}

/* Error */
.login-error {
    background: rgba(255, 77, 77, .12);
    color: #ffb3b3;
    padding: 10px 12px;
    border-radius: 10px;
    font-size: 13px;
    text-align: center;
    margin-bottom: 14px;
    border: 1px solid rgba(255,77,77,.25);
}

/* Footer */
.login-footer {
    text-align: center;
    font-size: 12px;
    color: #888;
    margin-top: 20px;
}
</style>
</head>

<body>

<div class="login-card">

    <div class="login-logo">
        <img src="../assets/images/logo1.png" alt="Living Room Storiez">
    </div>

    <div class="login-title">Admin Login</div>
    <div class="login-sub">Welcome back, please sign in</div>

    <?php if ($error): ?>
        <div class="login-error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="post" autocomplete="off">
        <div class="form-group">
            <input type="text" name="username" placeholder="Username" required>
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button class="login-btn">Sign In</button>
    </form>

    <div class="login-footer">
        © <?= date('Y') ?> Living Room Storiez
    </div>

</div>

</body>
</html>
