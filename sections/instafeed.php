<?php
// Fetch active Instagram reels
$reels = $conn->query("
    SELECT reel_url 
    FROM instagram_reels 
    WHERE status = 1 
    ORDER BY sort_order ASC
");
?>

<!-- ================= INSTAGRAM REELS ================= -->
<section class="insta-reels-section" id="instafeed">
    <h2 class="insta-title section-title">Instagram Reels</h2>

    <div class="insta-reels-wrapper">
        <div class="swiper reelsSwiper">
            <div class="swiper-wrapper">

                <?php while($r = $reels->fetch_assoc()): ?>
                <div class="swiper-slide">
                    <div class="reel-card">
                        <div class="reel-frame">
                            <blockquote
                                class="instagram-media"
                                data-instgrm-permalink="<?= htmlspecialchars($r['reel_url']) ?>"
                                data-instgrm-version="14">
                            </blockquote>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>

            </div>

            <div class="swiper-button-prev reels-nav"></div>
            <div class="swiper-button-next reels-nav"></div>
        </div>
    </div>
</section>

<!-- ================= CSS ================= -->
<style>
.insta-reels-section {
    background:#000;
    padding: 90px 0 80px;
    text-align: center;
}

.insta-title {
    color:#fff;
    font-size: 36px;
    margin-bottom: 45px;
    font-family: 'Playfair Display', serif;
}

.insta-reels-wrapper {
    max-width: 1300px;
    margin: auto;
    position: relative;
    overflow: hidden;
}

.reelsSwiper {
    padding: 20px 80px;
}

.swiper-slide {
    display:flex;
    justify-content:center;
}

.reel-card {
    width: 320px;
    height: 560px;
    background:#000;
    border-radius: 22px;
    overflow:hidden;
    box-shadow: 0 25px 60px rgba(0,0,0,.85);
    transition: transform .35s ease, opacity .35s ease;
    transform: scale(.88);
    opacity:.6;
}

.swiper-slide-active .reel-card {
    transform: scale(1);
    opacity:1;
}

.reel-frame {
    width:100%;
    height:100%;
    display:flex;
    align-items:center;
    justify-content:center;
}

/* Force Instagram iframe sizing */
.instagram-media {
    min-width: 100% !important;
    max-width: 100% !important;
    width:100% !important;
    height:100% !important;
    margin:0 !important;
}

/* Navigation */
.reels-nav {
    color:#fff;
}

.swiper-button-prev::after,
.swiper-button-next::after {
    font-size:26px;
}

/* Responsive */
@media (max-width: 1024px) {
    .reel-card {
        width:280px;
        height:500px;
    }
}

@media (max-width: 768px) {
    .reelsSwiper {
        padding: 20px;
    }
    .reel-card {
        width:90vw;
        height:70vh;
    }
}
</style>

<!-- ================= LIBS ================= -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Instagram Embed Script (MUST be once per page) -->
<script async src="https://www.instagram.com/embed.js"></script>

<!-- ================= SCRIPT ================= -->
<script>
document.addEventListener("DOMContentLoaded", () => {

    const reelsSwiper = new Swiper(".reelsSwiper", {
        loop: true,
        centeredSlides: true,
        slidesPerView: "auto",
        spaceBetween: 30,

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        },

        breakpoints: {
            0:   { slidesPerView: 1 },
            768: { slidesPerView: 3 },
            1200:{ slidesPerView: 4 }
        },

        on: {
            init() {
                if (window.instgrm) {
                    window.instgrm.Embeds.process();
                }
            },
            slideChangeTransitionEnd() {
                if (window.instgrm) {
                    window.instgrm.Embeds.process();
                }
            }
        }
    });

});
</script>

