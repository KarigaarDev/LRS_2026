<?php
define('APP_START', true);

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/db.php';

/* ==========================
   LOAD SETTINGS
========================== */
require_once __DIR__ . '/sections/settings.php';


/* ==========================
   MAINTENANCE CHECK
========================== */
if (setting('maintenance_mode')) {
    $maintenanceMessage = setting('maintenance_message');
    include 'sections/maintenance.php';
    exit;
}

/* ==========================
   NORMAL SITE LOAD
========================== */
include 'header.php';
?>

<!-- ================= MAIN CONTENT ================= -->

<?php include 'sections/contactmodal.php'; ?>

<?php if (is_enabled('enable_hero')): ?>
    <?php include 'sections/hero.php'; ?>
<?php endif; ?>

<?php if (is_enabled('enable_services')): ?>
    <?php include 'sections/services.php'; ?>
<?php endif; ?>

<?php if (is_enabled('enable_clients')): ?>
    <?php include 'sections/clients.php'; ?>
<?php endif; ?>

<?php if (is_enabled('enable_celebrities')): ?>
    <?php include 'sections/celebrities.php'; ?>
<?php endif; ?>

<?php if (is_enabled('enable_video_gallery')): ?>
    <?php include 'sections/video-gallery.php'; ?>
<?php endif; ?>

<?php if (is_enabled('enable_portfolio')): ?>
    <?php include 'sections/portfolio.php'; ?>
<?php endif; ?>

<?php if (is_enabled('enable_instafeed')): ?>
    <?php include 'sections/instafeed.php'; ?>
<?php endif; ?>



<?php if (is_enabled('enable_stories')): ?>
    <?php include 'sections/stories.php'; ?>
<?php endif; ?>

<?php if (is_enabled('enable_featured_in')): ?>
    <?php include 'sections/featured-in.php'; ?>
<?php endif; ?>
<?php if (is_enabled('enable_reviews')): ?>
    <?php include 'sections/reviews.php'; ?>
<?php endif; ?>
<?php if (is_enabled('enable_team')): ?>
    <?php include 'sections/team-slider.php'; ?>
<?php endif; ?>

<?php if (is_enabled('enable_cta')): ?>
    <?php include 'sections/cta.php'; ?>
<?php endif; ?>

<?php include 'footer.php'; ?>
<!-- =============== END OF MAIN CONTENT =============== -->

