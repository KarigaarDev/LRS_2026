<section class="cta-section">
    <div class="cta-container">

        <!-- LEFT : LOGO + ADDRESS -->
        <div class="cta-left">
            <img src="assets/images/logo1.png" alt="Living Room Storiez" class="cta-logo">

            <p class="cta-address">
                <?= nl2br(htmlspecialchars(setting('address'))) ?>
            </p>
        </div>

        <!-- CENTER : CTA -->
        <div class="cta-center">
            <h2>Let’s Create Something Powerful</h2>
            <button class="btn-primary open-project-modal track-cta" data-cta="start_project"
                data-location="footer_cta">
                Start a Project
            </button>

        </div>

        <!-- RIGHT : SOCIAL -->
        <div class="cta-right">
            <p class="cta-follow">Follow Us</p>

            <div class="cta-socials">

                <?php if (is_enabled('facebook_enabled')): ?>
                    <a href="<?= setting('facebook_url') ?>" target="_blank" class="track-social" data-platform="facebook"
                        aria-label="Facebook" onclick="trackEvent('social_click', {platform: 'facebook'})">

                        <i class="fab fa-facebook-f"></i>
                    </a>
                <?php endif; ?>

                <?php if (is_enabled('instagram_enabled')): ?>
                    <a href="<?= setting('instagram_url') ?>" target="_blank" class="track-social" data-platform="instagram"
                        aria-label="Instagram" onclick="trackEvent('social_click', {platform: 'instagram'})">

                        <i class="fab fa-instagram"></i>
                    </a>
                <?php endif; ?>

                <?php if (is_enabled('linkedin_enabled')): ?>
                    <a href="<?= setting('linkedin_url') ?>" target="_blank" aria-label="LinkedIn" class="track-social"
                        data-platform="linkedin" onclick="trackEvent('social_click', {platform: 'linkedin'})">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                <?php endif; ?>

                <?php if (setting('whatsapp')): ?>
                    <a href="https://wa.me/<?= preg_replace('/\D/', '', setting('whatsapp')) ?>" target="_blank"
                        class="track-social" data-platform="whatsapp" aria-label="WhatsApp" onclick="trackEvent('whatsapp_click')">

                        <i class="fab fa-whatsapp"></i>
                    </a>
                <?php endif; ?>

                <?php if (is_enabled('youtube_enabled')): ?>
                    <a href="<?= setting('youtube_url') ?>" target="_blank" aria-label="YouTube" class="track-social"
                        data-platform="youtube" onclick="trackEvent('social_click', {platform: 'youtube'})">
                        <i class="fab fa-youtube"></i>
                    </a>
                <?php endif; ?>

            </div>
        </div>

    </div>
</section>

<style>
    /* ===== CTA SECTION ===== */
    /* ===== CTA SECTION ===== */
    .cta-section {
        background: linear-gradient(135deg, #0f1c2e, #122235);
        color: #fff;
        padding: 70px 20px;
    }

    /* CONTAINER */
    .cta-container {
        max-width: 1200px;
        margin: auto;
        display: grid;
        grid-template-columns: 1fr 1.2fr 1fr;
        align-items: center;
        gap: 30px;
    }

    /* LEFT */
    .cta-left {
        text-align: left;
    }

    .cta-logo {
        width: 120px;
        margin-bottom: 15px;
    }

    .cta-address {
        font-size: 14px;
        line-height: 1.6;
        opacity: .85;
    }

    /* CENTER */
    .cta-center {
        text-align: center;
    }

    .cta-center h2 {
        font-size: 30px;
        margin-bottom: 18px;
    }



    /* RIGHT */
    .cta-right {
        text-align: right;
    }

    .cta-follow {
        margin-bottom: 10px;
        font-size: 14px;
        opacity: .8;
    }

    .cta-socials {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }

    .cta-socials a {
        width: 38px;
        height: 38px;
        background: rgba(255, 255, 255, .12);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 15px;
        transition: all .3s ease;
    }

    .cta-socials a:hover {
        background: #4f6df5;
        transform: scale(1.1);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 900px) {
        .cta-container {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .cta-left,
        .cta-right {
            text-align: center;
        }

        .cta-socials {
            justify-content: center;
        }

        .cta-center h2 {
            font-size: 24px;
        }
    }
</style>
<script>
    document.addEventListener('click', function (e) {

        /* CTA BUTTON TRACK */
        const cta = e.target.closest('.track-cta');
        if (cta) {
            window.dataLayer.push({
                event: 'cta_click',
                cta_name: cta.dataset.cta,
                location: cta.dataset.location
            });
        }

        /* SOCIAL ICON TRACK */
        const social = e.target.closest('.track-social');
        if (social) {
            window.dataLayer.push({
                event: 'social_click',
                platform: social.dataset.platform,
                location: 'footer_cta'
            });
        }

    });
</script>