<?php
/* ==========================
   HERO SETTINGS FROM site_settings
========================== */

$heroImage = setting('hero_image')
    ? 'assets/images/' . htmlspecialchars(setting('hero_image'))
    : 'assets/images/hero-collage.jpg';

$particlesOn = is_enabled('particles_enabled');
?>

<section class="hero-parallax">

    <!-- Background -->
    <div class="hero-bg"
         style="background-image:url('<?= $heroImage ?>')">
    </div>

    <?php if ($particlesOn): ?>
        <div id="particles-js"></div>
    <?php endif; ?>

    <!-- Overlay Content -->
    <div class="hero-content">
        <img src="assets/images/logo.png" class="hero-logo" alt="Logo">

        <h1><?= htmlspecialchars(setting('short_tagline', 'Let’s Start a Brand New Story')) ?></h1>

        <div class="hero-socials">

            <?php if (is_enabled('facebook_enabled')): ?>
                <a href="<?= setting('facebook_url') ?>" target="_blank" aria-label="Facebook" class="track-social" data-platform="facebook"  onclick="trackEvent('social_click', {platform: 'facebook'})">
                    <i class="fab fa-facebook-f"></i>
                </a>
            <?php endif; ?>

            <?php if (is_enabled('instagram_enabled')): ?>
                <a href="<?= setting('instagram_url') ?>" target="_blank" aria-label="Instagram" class="track-social" data-platform="instagram" onclick="trackEvent('social_click', {platform: 'instagram'})">
                    <i class="fab fa-instagram"></i>
                </a>
            <?php endif; ?>

            <?php if (is_enabled('linkedin_enabled')): ?>
                 <a href="<?= setting('linkedin_url') ?>" target="_blank" aria-label="LinkedIn" class="track-social" data-platform="linkedin" onclick="trackEvent('social_click', {platform: 'linkedin'})">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            <?php endif; ?>

            <?php if (setting('whatsapp')): ?>
                <a href="https://wa.me/<?= preg_replace('/\D/', '', setting('whatsapp')) ?>"
                   target="_blank" aria-label="WhatsApp" class="track-social" data-platform="whatsapp" onclick="trackEvent('whatsapp_click')">
                    <i class="fab fa-whatsapp"></i>
                </a>
            <?php endif; ?>

            <?php if (is_enabled('youtube_enabled')): ?>
                <a href="<?= setting('youtube_url') ?>" target="_blank" aria-label="YouTube" class="track-social" data-platform="youtube" onclick="trackEvent('social_click', {platform: 'youtube'})">
                    <i class="fab fa-youtube"></i>
                </a>
            <?php endif; ?>

        </div>

        <button
  class="btn-primary open-project-modal"
  data-event="hero_cta_click"
  data-location="hero_section">
  Get In Touch
</button>

    </div>
</section>


<style>
    /* ===== HERO PARALLAX ===== */
.hero-parallax {
    position: relative;
    height: 100vh;
    overflow: hidden;
}

/* BACKGROUND IMAGE */
.hero-bg {
    position: absolute;
    inset: 0;
    background: url("assets/images/hero-collage.jpg") center / cover no-repeat;
    transform: translateZ(0);
    will-change: transform;
}

/* DARK OVERLAY */
.hero-parallax::after {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.55);
    z-index: 1;
}

/* CONTENT CARD */
.hero-content {
    position: relative;
    z-index: 2;
    max-width: 30%;
    margin: auto;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.52);
    backdrop-filter: blur(10px);
    padding: 15px 20px;
    border-radius: 18px;
    text-align: center;
    box-shadow: 0 20px 50px rgba(0,0,0,.4);
}
.glass-card {
  width: 240px;
  height: 360px;
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(21px);
  -webkit-backdrop-filter: blur(21px);
  border-radius: 20px;
  border: 1px solid rgba(255, 255, 255, 0.3);
  box-shadow: 
    0 8px 32px rgba(0, 0, 0, 0.1),
    inset 0 1px 0 rgba(255, 255, 255, 0.5),
    inset 0 -1px 0 rgba(255, 255, 255, 0.1),
    inset 0 0 22px 11px rgba(255, 255, 255, 1.1);
  position: relative;
  overflow: hidden;
}

.glass-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 1px;
  background: linear-gradient(
    90deg,
    transparent,
    rgba(255, 255, 255, 0.8),
    transparent
  );
}

.glass-card::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 1px;
  height: 100%;
  background: linear-gradient(
    180deg,
    rgba(255, 255, 255, 0.8),
    transparent,
    rgba(255, 255, 255, 0.3)
  );
}
/* LOGO */
.hero-logo {
    width: 50%;
    /* margin-bottom: 18px; */
}

/* TEXT */
.hero-content h1 {
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 18px;
    color: #000;
}

/* SOCIAL ICONS */
.hero-socials {
    display: flex;
    justify-content: center;
    gap: 14px;
}

.hero-socials a {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #000;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    transition: all .3s ease;
}

.hero-socials a:hover {
    background: #4f6df5;
    transform: scale(1.1);
}
#particles-js {
    position: absolute;
    inset: 0;
    z-index: 1;
    pointer-events: none;
}


/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .hero-content {
        max-width: 90%;
        padding: 30px 22px;
    }

    .hero-content h1 {
        font-size: 22px;
    }

    /* .hero-logo {
        width: 100px;
    } */
}

    </style>
<script>
window.addEventListener("scroll", () => {
    const scrolled = window.pageYOffset;
    const heroBg = document.querySelector(".hero-bg");

    // Control values
    const translateY = scrolled * 0.35;   // vertical parallax
    const scale = 1 + scrolled * 0.0003; // slow zoom in

    heroBg.style.transform = `translateY(${translateY}px) scale(${scale})`;
});
</script>
<?php if (!empty($particlesOn)): ?>
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script>
particlesJS("particles-js", {
  particles: {
    number: { value: 70 },
    color: { value: "#ffffff" },
    opacity: { value: 0.25 },
    size: { value: 3 },
    move: { speed: 1 }
  },
  interactivity: {
    events: { onhover: { enable: true, mode: "repulse" } }
  }
});
</script>
<?php endif; ?>

