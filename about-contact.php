<?php
define('APP_START', true);

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/sections/settings.php';
define('BASE_PATH', __DIR__);

$seo_title = "About Us | Living Room Storiez";
$seo_desc  = "Learn about Living Room Storiez — our story, design philosophy, and how to start your interior journey with us.";
include BASE_PATH . '/header.php';
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>">

<section class="about-contact-page">

    <!-- HERO -->
    <!-- HERO -->
<div class="ac-hero text-center">
    <img src="assets/images/logo1.png" alt="Living Room Storiez Logo" class="ac-hero-logo">
    <h1>Designing That Feels Like You</h1>
    <p>We don’t just design  — we design experiences that reflect who you are.</p>
</div>


    <!-- ABOUT SECTION -->
    <div class="container ac-section">
        <div class="row align-items-center g-5">

            <div class="col-md-6">
                <img src="assets/images/team.jpg" alt="About Living Room Storiez" class="ac-img">
            </div>

            <div class="col-md-6">
                <h2>Our Story</h2>
                <p>
                    At <strong>Living Room Storiez</strong>, we believe every space has a story waiting to be told.
                    Our passion lies in transforming everyday interiors into timeless environments that blend
                    comfort, functionality, and style.
                </p>

                <p>
                    From cozy living rooms to complete home transformations, our team works closely with
                    clients to bring their vision to life with creativity, precision, and care.
                </p>

                <p>
                    Every design choice we make is guided by one goal: creating a space that truly feels like *you*.
                </p>
            </div>

        </div>
    </div>

    <!-- PHILOSOPHY -->
    <div class="ac-philosophy text-center">
        <div class="container">
            <h2>Our Design Philosophy</h2>
            <div class="row g-4 mt-4">

                <div class="col-md-4">
                    <div class="ac-card">
                        <h3>Personalized</h3>
                        <p>Every home is unique, and so is every design we create.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="ac-card">
                        <h3>Functional</h3>
                        <p>Beauty is important, but comfort and usability come first.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="ac-card">
                        <h3>Timeless</h3>
                        <p>We design spaces that stay elegant and relevant for years.</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
<!-- FOUNDER SECTION -->
<div class="container ac-section">
    <div class="row align-items-center g-5 flex-md-row-reverse">

        <div class="col-md-5 text-center">
            <img src="assets/images/founder.jpg" alt="Founder - Living Room Storiez" class="ac-founder-img">
        </div>

        <div class="col-md-7">
            <h2>A Message from Our Founder</h2>
            <p>
                “Living Room Storiez was born from a simple belief — that a home should tell the story of
                the people who live in it. Every project we take on is deeply personal, and we pour our
                creativity and care into making spaces that feel warm, functional, and timeless.”
            </p>
            <p class="ac-founder-name">— Founder, Living Room Storiez</p>
        </div>

    </div>
</div>

    <!-- CONTACT INFO (NO FORM) -->
    <div class="container ac-section text-center">
        <h2>Let’s Talk About Your Space</h2>
        <p class="ac-contact-text">
            Ready to transform your home? Reach out to us and let’s start designing your dream space.
        </p>

        <div class="ac-contact-box">
            <p><strong>Address</strong><br>
                <?= nl2br(htmlspecialchars(setting('address'))) ?>
            </p>

            <?php if (setting('whatsapp')): ?>
                <p><strong>WhatsApp</strong><br>
                    <a href="https://wa.me/<?= preg_replace('/\D/', '', setting('whatsapp')) ?>" target="_blank">
                        Chat With Us
                    </a>
                </p>
            <?php endif; ?>
        </div>

        <button class="btn-primary open-project-modal track-cta"
            data-cta="start_project"
            data-location="about_contact_page">
            Start a Project
        </button>
    </div>

</section>

<style>
.about-contact-page {
    background: #f9fafc;
    color: #1a1a1a;
}

/* HERO */
.ac-hero {
    padding: 100px 20px 70px;
    background: linear-gradient(135deg, #0f1c2e, #122235);
    color: #fff;
}

.ac-hero h1 {
    font-size: 38px;
    margin-bottom: 15px;
}

.ac-hero p {
    font-size: 18px;
    opacity: .9;
}

/* SECTION SPACING */
.ac-section {
    padding: 80px 0;
}

/* IMAGE */
.ac-img {
    width: 100%;
    border-radius: 12px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.08);
}

/* PHILOSOPHY */
.ac-philosophy {
    background: #ffffff;
    padding: 80px 20px;
}

.ac-card {
    background: #f4f6fb;
    padding: 30px;
    border-radius: 12px;
    height: 100%;
    transition: all .3s ease;
}

.ac-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.08);
}

/* CONTACT BOX */
.ac-contact-box {
    margin: 30px auto;
    padding: 25px;
    background: #fff;
    border-radius: 12px;
    max-width: 500px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}

.ac-contact-text {
    max-width: 600px;
    margin: auto;
    opacity: .8;
}
.ac-hero-logo {
    width: 90px;
    margin-bottom: 20px;
    opacity: 0.95;
}
.ac-founder-img {
    width: 100%;
    max-width: 320px;
    border-radius: 14px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.12);
}

.ac-founder-name {
    margin-top: 10px;
    font-weight: 600;
    opacity: 0.8;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .ac-hero h1 { font-size: 28px; }
    .ac-section { padding: 60px 20px; }
}
</style>

<?php include BASE_PATH . '/footer.php'; ?>
