<section class="celebs-section" id="celebrities">
    <h2 class="celebs-title section-title">Celebrity Collaborations</h2>

    <div class="celebs-wrapper">

        <!-- LEFT NAV -->
        <div class="swiper-button-prev celeb-nav"></div>

        <!-- SLIDER -->
        <div class="swiper celebSwiper">
            <div class="swiper-wrapper">

                <?php
                $celebs = $conn->query("SELECT * FROM celebrities WHERE status = 1 ORDER BY sort_order ASC, id DESC");
                while ($c = $celebs->fetch_assoc()):
                ?>
                    <div class="swiper-slide">
                        <div class="celeb-card">

                            <div class="celeb-img">
                                <img src="assets/images/celebs/<?= $c['image'] ?>"
                                     alt="<?= htmlspecialchars($c['name']) ?>">
                            </div>

                            <div class="celeb-info">
                               <h5><?= strip_tags(str_replace(['<br/>','<br />'], '<br>', $c['name']), '<br>') ?></h5>

                                <?php if (!empty($c['designation'])): ?>
                                    <span class="celeb-role"><?= htmlspecialchars($c['designation']) ?></span>
                                <?php endif; ?>
                            </div>

                            <?php if (!empty($c['instagram']) || !empty($c['website'])): ?>
                                <div class="celeb-socials">
                                    <?php if (!empty($c['instagram'])): ?>
                                        <a href="<?= $c['instagram'] ?>" target="_blank" aria-label="Instagram">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (!empty($c['website'])): ?>
                                        <a href="<?= $c['website'] ?>" target="_blank" aria-label="Website">
                                            <i class="fas fa-globe"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endwhile; ?>

            </div>
        </div>

        <!-- RIGHT NAV -->
        <div class="swiper-button-next celeb-nav"></div>

    </div>

    <div class="celebs-divider"></div>
</section>

<style>
/* ===== SECTION ===== */
.celebs-section {
    background: #1f2e40;
    padding: 70px 0 50px;
    text-align: center;
}

.celebs-title {
    color: #fff;
    font-size: 32px;
    margin-bottom: 40px;
    font-family: 'Playfair Display', serif;
}

/* ===== WRAPPER ===== */
.celebs-wrapper {
    max-width: 1400px;
    margin: auto;
    position: relative;
    padding: 0 60px; /* space for arrows */
}

/* ===== SLIDER ===== */
.celebSwiper {
    padding: 20px 0;
}

.swiper-slide {
    display: flex;
    justify-content: center;
}

/* ===== CARD ===== */
.celeb-card {
    width: 220px;
    background: #ffffff;
    border-radius: 16px;
    padding: 16px 16px 20px;
    box-shadow: 0 12px 30px rgba(0,0,0,.25);
    text-align: center;
    transition: transform .3s ease;
}

.celeb-card:hover {
    transform: translateY(-8px);
}

/* IMAGE */
.celeb-img {
    width: 100%;
    height: 200px;
    overflow: hidden;
    border-radius: 14px;
}

.celeb-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* INFO */
.celeb-info h4 {
    margin: 12px 0 4px;
    font-size: 17px;
    font-weight: 600;
    color: #111;
     white-space: normal;
}
.celeb-info h5 {
    margin: 12px 0 4px;
    font-size: 15px;
    font-weight: 600;
    color: #111;
     white-space: normal;
}

.celeb-role {
    font-size: 13px;
    color: #777;
}

/* SOCIALS */
.celeb-socials {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-top: 14px;
}

.celeb-socials a {
    width: 36px;
    height: 36px;
    background: #233447;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 15px;
    transition: all .3s ease;
}

.celeb-socials a:hover {
    background: #4f6df5;
    transform: scale(1.1);
}

/* ===== NAVIGATION (OUTSIDE SLIDER) ===== */
.celeb-nav {
    color: #cbd5ff;
}

.swiper-button-prev,
.swiper-button-next {
    top: 50%;
    transform: translateY(-50%);
}

.swiper-button-prev {
    left: -10px;
}

.swiper-button-next {
    right: -10px;
}

.swiper-button-prev::after,
.swiper-button-next::after {
    font-size: 22px;
    font-weight: bold;
    transition: color .3s ease;
}

.swiper-button-prev:hover::after,
.swiper-button-next:hover::after {
    color: #ffffff;
}

/* ===== DIVIDER ===== */
.celebs-divider {
    width: 80%;
    height: 2px;
    background: rgba(255,255,255,.25);
    margin: 45px auto 0;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .celeb-card {
        width: 190px;
    }

    .celeb-img {
        height: 170px;
    }
}

</style>
<script>
document.addEventListener("DOMContentLoaded", function () {
    new Swiper(".celebSwiper", {
        loop: true,
        speed: 700,
        spaceBetween: 30,
        centeredSlides: false,

        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },

        navigation: {
            nextEl: ".celebs-section .swiper-button-next",
            prevEl: ".celebs-section .swiper-button-prev",
        },

        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            576: {
                slidesPerView: 2,
            },
            768: {
                slidesPerView: 3,
            },
            1024: {
                slidesPerView: 5,
            },
        },

        grabCursor: true,
        watchOverflow: true,
    });
});
</script>
