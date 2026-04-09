<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MKL5V4HF');</script>
<!-- End Google Tag Manager -->
<title><?= htmlspecialchars(setting('meta_title', 'Living Room Storiez')) ?></title>
<meta name="description" content="<?= htmlspecialchars(setting('meta_description')) ?>">
<meta name="keywords" content="<?= htmlspecialchars(setting('meta_keywords')) ?>">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<!-- Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- Swiper -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css">

<link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>">
<link rel="shortcut icon" href="<?= asset('assets/images/logo-thumb.png') ?>">

<style>
/* ===== PREMIUM NAVBAR ===== */
.navbar {
     position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
    padding: 14px 28px;
    background: rgba(15, 28, 46, 0.65);
    backdrop-filter: blur(14px);
    -webkit-backdrop-filter: blur(14px);
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: background .3s ease, box-shadow .3s ease, padding .3s ease;
}

.navbar.scrolled {
    background: rgba(15, 28, 46, 0.95);
    box-shadow: 0 10px 30px rgba(0,0,0,.25);
    padding: 10px 28px;
}
.navbar.scrolled .nav-logo img {
    height: 32px;
}

/* LOGO */
.nav-logo {
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 600;
    font-size: 18px;
    color: #fff;
    text-decoration: none;
}

.nav-logo img {
    height: 38px;
}

/* MENU */
.nav-menu {
    display: flex;
    gap: 26px;
     align-items: center;
}

.nav-menu a {
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    opacity: .85;
    transition: all .25s ease;
    position: relative;
}

.nav-menu a::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px;
    width: 0;
    height: 2px;
    background: linear-gradient(45deg,#7f5cff,#ff5ce1);
    transition: width .25s ease;
}

.nav-menu a:hover {
    opacity: 1;
}

.nav-menu a:hover::after {
    width: 100%;
}

/* CTA BUTTON */
.nav-cta {
    padding: 10px 18px;
    border-radius: 30px;
    background: #4f6df5;
    color: #fff;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: all .3s ease;
}

.nav-cta:hover {
    background: #3b56d8;
    transform: translateY(-1px);
}

/* MOBILE */
.menu-toggle {
    display: none;
    font-size: 22px;
    color: #fff;
    cursor: pointer;
}
section {
    scroll-margin-top: 90px;
}
@media (max-width: 900px) {
    .menu-toggle {
        display: block;
    }

    .nav-menu {
        position: fixed;
        top: 70px;
        right: -100%;
        width: 260px;
        height: calc(100vh - 70px);
        background: rgba(15, 28, 46, 0.96);
        backdrop-filter: blur(14px);
        flex-direction: column;
        padding: 30px;
        transition: right .3s ease;
    }

    .nav-menu.active {
        right: 0;
    }

    .nav-menu a {
        font-size: 16px;
    }

    .nav-cta {
        margin-top: 20px;
        text-align: center;
    }
}
</style>
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MKL5V4HF"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<header class="navbar" id="navbar">

    <!-- LOGO -->
    <a href="/" class="nav-logo">
        <img src="<?= asset('assets/images/logo-thumb.png') ?>" alt="Living Room Storiez">
        Living Room Storiez
    </a>

    <!-- TOGGLE -->
    <div class="menu-toggle" id="menuToggle" aria-label="Toggle menu" role="button">
        <i class="fas fa-bars"></i>
    </div>

    <!-- MENU -->
    <nav class="nav-menu" id="navMenu">

        <?php if (is_enabled('enable_services')): ?>
            <a href="/#services">Services</a>
        <?php endif; ?>

        <?php if (is_enabled('enable_portfolio')): ?>
            <a href="/#portfolio">Portfolio</a>
        <?php endif; ?>

        <?php if (is_enabled('enable_video_gallery')): ?>
            <a href="/#videos">Videos</a>
        <?php endif; ?>

        <?php if (is_enabled('enable_instafeed')): ?>
            <a href="/#instafeed">Instagram</a>
        <?php endif; ?>

        <?php if (is_enabled('enable_stories')): ?>
            <a href="/#stories">Stories</a>
        <?php endif; ?>

        <?php if (is_enabled('enable_team')): ?>
            <a href="/#team">Team</a>
        <?php endif; ?>

        <?php if (is_enabled('enable_cta')): ?>
            <button class="btn-primary open-project-modal" style="margin-top: 0px !important;" data-event="hero_cta_click" data-location="hero_section" >Get In Touch</button>
            <!-- <a href="#contact" class="nav-cta">GetInTouch</a> -->
        <?php endif; ?>

    </nav>
</header>

<script>
const menuToggle = document.getElementById('menuToggle');
const navMenu = document.getElementById('navMenu');
const navbar = document.getElementById('navbar');

menuToggle.addEventListener('click', () => {
    navMenu.classList.toggle('active');
});

window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 20);
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    trackEvent('page_view');
});
</script>
