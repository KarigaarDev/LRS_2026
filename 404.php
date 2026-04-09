<?php
http_response_code(404);

if (!isset($errorMessage)) {
    $errorMessage = 'Page Not Found';
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>404 - Page Not Found</title>

<meta name="robots" content="noindex, nofollow">

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

    .error-box {
        background: #fff;
        max-width: 460px;
        width: 92%;
        padding: 44px 34px;
        border-radius: 18px;
        text-align: center;
        box-shadow: 0 30px 60px rgba(0,0,0,0.18);
        animation: fadeUp .45s ease;
    }

    .error-box img {
        max-width: 130px;
        margin-bottom: 22px;
    }

    .error-code {
        font-size: 64px;
        font-weight: 800;
        color: #6c63ff;
        margin-bottom: 8px;
        letter-spacing: 1px;
    }

    h1 {
        margin: 0 0 12px;
        color: #333;
        font-size: 1.6rem;
    }

    p {
        color: #666;
        line-height: 1.6;
        margin-bottom: 26px;
    }

    .btn-home {
        display: inline-block;
        padding: 12px 26px;
        background: #6c63ff;
        color: #fff;
        border-radius: 30px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
        transition: all .25s ease;
        box-shadow: 0 12px 30px rgba(108,99,255,.35);
    }

    .btn-home:hover {
        background: #574fe3;
        transform: translateY(-2px);
        box-shadow: 0 18px 40px rgba(108,99,255,.45);
    }

    @keyframes fadeUp {
        from {
            transform: translateY(30px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @media (max-width: 600px) {
        .error-box {
            padding: 36px 26px;
        }

        .error-code {
            font-size: 54px;
        }
    }
</style>
</head>

<body>

    <div class="error-box">
        <img src="assets/images/logo.png" alt="Logo">

        <div class="error-code">404</div>

        <h1><?= htmlspecialchars($errorMessage) ?></h1>

        <p>
            Oops 😕 the page you’re looking for doesn’t exist or has been moved.
        </p>

        <a href="/" class="btn-home">
            ← Back to Home
        </a>
    </div>

</body>
</html>
