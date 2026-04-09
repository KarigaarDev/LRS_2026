<?php
define('APP_START', true);

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/sections/settings.php';
define('BASE_PATH', __DIR__);
$seo_title = "Privacy Policy | Living Room Storiez";
include BASE_PATH . '/header.php';
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>">
<div class="container">
<section class="legal-page">
    <div class="legal-container">
        <h1>Privacy Policy</h1>
        <p class="last-updated">Last updated: <?= date('F Y') ?></p>

        <h2>1. Information We Collect</h2>
        <p>We may collect personal information such as:</p>
        <ul>
            <li>Name and contact details (when you fill out forms)</li>
            <li>Project requirements you share with us</li>
            <li>Website usage data through analytics tools</li>
        </ul>

        <h2>2. How We Use Your Information</h2>
        <p>Your information is used to:</p>
        <ul>
            <li>Respond to inquiries and project requests</li>
            <li>Improve our website and services</li>
            <li>Send important project-related communication</li>
        </ul>

        <h2>3. Data Protection</h2>
        <p>
            We take appropriate security measures to protect your personal data from unauthorized access,
            alteration, or disclosure.
        </p>

        <h2>4. Cookies & Tracking</h2>
        <p>
            Our website may use cookies and tracking technologies (like Google Analytics or Facebook Pixel)
            to understand visitor behavior and improve performance.
        </p>

        <h2>5. Sharing of Information</h2>
        <p>
            We do not sell or rent your personal information. Data may only be shared with trusted service
            providers when necessary for project delivery or website operation.
        </p>

        <h2>6. Third-Party Links</h2>
        <p>
            Our site may contain links to external websites. We are not responsible for their privacy practices.
        </p>

        <h2>7. Your Rights</h2>
        <p>
            You may request to review, update, or delete your personal information by contacting us.
        </p>

        <h2>8. Updates to This Policy</h2>
        <p>
            We may update this Privacy Policy occasionally. Changes will be posted on this page with a revised date.
        </p>

        <h2>9. Contact Us</h2>
        <p>
            If you have any questions about this Privacy Policy, please reach out through our contact form.
        </p>
    </div>
</section>
</div>

<?php include BASE_PATH . '/footer.php'; ?>
