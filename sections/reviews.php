<section class="reviews-section">
    <h2 class="reviews-title section-title" id="reviews">What Clients Say</h2>

    <div class="reviews-wrapper">

        <!-- LEFT NAV -->
        <div class="swiper-button-prev review-nav"></div>
xxxxxxxxxxxxxxxxxxx
        <!-- SLIDER -->
        <div class="swiper reviewSwiper">
            <div class="swiper-wrapper">

                <?php
                $reviews = $conn->query("
                    SELECT * FROM reviews
                    WHERE is_active = 1
                    ORDER BY id DESC
                ");

                while ($r = $reviews->fetch_assoc()):
                ?>
                <div class="swiper-slide">
                    <div class="review-card">
                        <div class="review-header">
                            <img src="assets/images/reviews/<?= htmlspecialchars($r['image']) ?>"
                                 alt="<?= htmlspecialchars($r['name']) ?>">
                            <div>
                                <h4><?= htmlspecialchars($r['name']) ?></h4>
                                <div class="stars">
                                    <?= str_repeat('★', (int)$r['rating']) ?>
                                    <?= str_repeat('☆', 5 - (int)$r['rating']) ?>
                                </div>
                            </div>
                        </div>
                        <p><?= nl2br(htmlspecialchars($r['review'])) ?></p>
                    </div>
                </div>
                <?php endwhile; ?>

            </div>
        </div>

        <!-- RIGHT NAV -->
        <div class="swiper-button-next review-nav"></div>

    </div>

    <!-- CTA -->
     <a href="https://www.google.com/search?sca_esv=04d368c2d7c05ade&rlz=1C1ONGR_enIN1102IN1102&sxsrf=ANbL-n4VQN069VEP4xONYA5ByILFegW3iA:1768652959304&si=AL3DRZEsmMGCryMMFSHJ3StBhOdZ2-6yYkXd_doETEE1OR-qOX3R0-9iQe1PR-wPbw6GrtpcLMxyTvsO9o4O9aWISb3izvrtKHR3u7c5LeBUBHo5Ahz6PjvAizKrOhQ0kaPdxe6GVatJKIfoSDgAxshrBWUFCAUk-Q%3D%3D&q=Living+room+storiez+Reviews&sa=X&ved=2ahUKEwjr8vrayZKSAxUQzzkIHR8PMD8Q0bkNegQISBAH&biw=1920&bih=945&dpr=1&aic=0"
       target="_blank"
       class="review-cta">
        Give Us a Reviewxxxxx
    </a>

    <div class="reviews-divider"></div>
</section>

<style>
   /* ===== REVIEWS SECTION ===== */
.reviews-section {
    background: #000;
    padding: 80px 0 60px;
    text-align: center;
}

.reviews-title {
    color: #fff;
    font-size: 32px;
    margin-bottom: 40px;
    font-family: 'Playfair Display', serif;
}

/* WRAPPER */
.reviews-wrapper {
    max-width: 1400px;
    margin: auto;
    position: relative;
    padding: 0 60px;
}

/* SLIDER */
.reviewSwiper {
    width: 100%;
    padding: 20px 0;
}
.swiper-slide {
    display: flex;
    justify-content: center;
}

/* CARD */
.review-card {
    width: 320px;
    background: rgba(255,255,255,0.95);
    border-radius: 18px;
    padding: 22px;
    box-shadow: 0 14px 35px rgba(0,0,0,.35);
    text-align: left;
    transition: transform .3s ease;
}

.review-card:hover {
    transform: translateY(-8px);
}

/* HEADER */
.review-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 14px;
}

.review-header img {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    object-fit: cover;
}

.review-header h4 {
    font-size: 15px;
    margin: 0;
    color: #111;
}

.stars {
    color: #fbbc04;
    font-size: 14px;
    letter-spacing: 1px;
}

/* TEXT */
.review-card p {
    font-size: 14px;
    line-height: 1.6;
    color: #444;
}

/* CTA */
.review-cta {
    display: inline-block;
    margin-top: 40px;
    padding: 14px 34px;
    border-radius: 30px;
    background: linear-gradient(135deg, #4f6df5, #6a82fb);
    color: #fff;
    font-weight: 600;
    text-decoration: none;
    transition: transform .3s ease, box-shadow .3s ease;
}

.review-cta:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(79,109,245,.45);
}

/* NAV */
.review-nav {
    color: #cbd5ff;
}

.reviews-section .swiper-button-prev,
.reviews-section .swiper-button-next {
    top: 50%;
    transform: translateY(-50%);
}

.reviews-section .swiper-button-prev {
    left: -10px;
}

.reviews-section .swiper-button-next {
    right: -10px;
}

.reviews-section .swiper-button-prev::after,
.reviews-section .swiper-button-next::after {
    font-size: 22px;
    font-weight: bold;
    transition: color .3s ease;
}

.reviews-section .swiper-button-prev:hover::after,
.reviews-section .swiper-button-next:hover::after {
    color: #fff;
}

/* DIVIDER */
.reviews-divider {
    width: 80%;
    height: 2px;
    background: rgba(255,255,255,.25);
    margin: 50px auto 0;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .review-card {
        width: 280px;
    }
}
 
</style>
<script>
document.addEventListener("DOMContentLoaded", function () {
    new Swiper(".reviewSwiper", {
        loop: true,
        speed: 700,
        spaceBetween: 30,

        centeredSlides: false,   // IMPORTANT
        slidesPerView: 3,        // DEFAULT (desktop)

        navigation: {
            nextEl: ".reviews-section .swiper-button-next",
            prevEl: ".reviews-section .swiper-button-prev",
        },

        breakpoints: {
            0: {
                slidesPerView: 1,
            },
            640: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },

        grabCursor: true,
        watchOverflow: true,
    });
});
</script>

