<?php
define('APP_START', true);

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/sections/settings.php';
define('BASE_PATH', __DIR__);
$seo_title = "Terms & Conditions | Living Room Storiez";
include BASE_PATH . '/header.php';
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>">
<div class="container">
<section class="legal-page">
    <div class="legal-container">
        <h1>Terms & Conditions</h1>
        <p class="last-updated">Last updated: <?= date('F Y') ?></p>

        <h2>1. Introduction</h2>
        <p>
            Welcome to <strong>Living Room Storiez</strong>. By accessing or using our website and services,
            you agree to be bound by these Terms & Conditions. If you do not agree, please do not use our website.
        </p>

        <h2>2. Services</h2>
        <p>
            We provide interior design, creative visualization, and related services. All project timelines,
            deliverables, and costs are agreed upon separately through direct communication.
        </p>

        <h2>3. Intellectual Property</h2>
        <p>
            All content on this website — including images, designs, videos, text, and branding — is the property
            of Living Room Storiez unless otherwise stated. You may not copy, reproduce, or distribute any material
            without written permission.
        </p>

        <h2>4. User Conduct</h2>
        <p>You agree not to use this website for:</p>
        <ul>
            <li>Any unlawful purpose</li>
            <li>Attempting to gain unauthorized access to our systems</li>
            <li>Copying or misusing our design work</li>
        </ul>

        <h2>5. Project Deliverables</h2>
        <p>
            Final design files, drawings, and creative assets are shared according to agreed project terms.
            Unauthorized resale or redistribution of our work is prohibited.
        </p>

        <h2>6. Limitation of Liability</h2>
        <p>
            Living Room Storiez shall not be held liable for any indirect, incidental, or consequential damages
            arising from the use of our website or services.
        </p>

        <h2>7. Third-Party Links</h2>
        <p>
            Our website may contain links to third-party websites. We are not responsible for their content,
            policies, or practices.
        </p>

        <h2>8. Changes to Terms</h2>
        <p>
            We may update these Terms & Conditions at any time. Continued use of the site after changes
            indicates acceptance of the updated terms.
        </p>

        <h2>9. Contact Us</h2>
        <p>
            For any questions regarding these Terms, please contact us through our website contact form.
        </p>
    </div>
</section>
</div>
<?php include BASE_PATH . '/footer.php'; ?>
