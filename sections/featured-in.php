<section class="featured-section" id="featured-in">
    <h2 class="featured-title section-title">Featured In</h2>

    <div class="featured-wrapper">

        <!-- LEFT NAV -->
        <div class="swiper-button-prev featured-nav"></div>

        <!-- SLIDER -->
        <div class="swiper featuredSwiper">
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                    <div class="featured-card">
                        <img src="assets/images/featured/1.jpeg" alt="Featured Logo">
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="featured-card">
                        <img src="assets/images/featured/2.jpeg" alt="Featured Logo">
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="featured-card">
                        <img src="assets/images/featured/3.jpeg" alt="Featured Logo">
                    </div>
                </div>
                  <div class="swiper-slide">
                    <div class="featured-card">
                        <img src="assets/images/featured/1.jpeg" alt="Featured Logo">
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="featured-card">
                        <img src="assets/images/featured/2.jpeg" alt="Featured Logo">
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="featured-card">
                        <img src="assets/images/featured/3.jpeg" alt="Featured Logo">
                    </div>
                </div>
<!-- 
                <div class="swiper-slide">
                    <div class="featured-card">
                        <img src="assets/images/featured/greview.png" alt="Featured Logo">
                    </div>
                </div>
                 <div class="swiper-slide">
                    <div class="featured-card">
                        <img src="assets/images/featured/pd.png" alt="Featured Logo">
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="featured-card">
                        <img src="assets/images/featured/ak.png" alt="Featured Logo">
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="featured-card">
                        <img src="assets/images/featured/jtk.png" alt="Featured Logo">
                    </div>
                </div> -->

            </div>
        </div>

        <!-- RIGHT NAV -->
        <div class="swiper-button-next featured-nav"></div>

    </div>

    <div class="featured-divider"></div>
</section>
<style>
    /* ===== FEATURED IN SECTION ===== */
.featured-section {
    background: #000;
    padding: 70px 0 50px;
    text-align: center;
}

.featured-title {
    color: #fff;
    font-size: 32px;
    margin-bottom: 40px;
    font-family: 'Playfair Display', serif;
}

/* WRAPPER */
.featured-wrapper {
    max-width: 1400px;
    margin: auto;
    position: relative;
    padding: 0 60px; /* space for arrows */
    overflow: hidden;
}

/* SLIDER */
.featuredSwiper {
    width: 100%;
    padding: 20px 40px;
}

/* CARD */
.featured-card {
    background: #fff;
    border-radius: 12px;
    width: 200px;
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 15px;
    box-shadow: 0 10px 25px rgba(0,0,0,.25);
    transition: transform .3s ease;
    margin: auto;
}

.featured-card img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    border-radius: 12px;
    border: 1px solid rgba(0,0,0,0.05);

    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.10);
}

.featured-card:hover {
    transform: translateY(-6px);
}

/* SLIDE CENTERING */
.featured-section .swiper-slide {
    display: flex;
    justify-content: center;
}

/* NAVIGATION */
.featured-nav {
    width: 42px;
    height: 42px;
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
    color: #cbd5ff;
    transition: color .3s ease;
}

.swiper-button-prev:hover::after,
.swiper-button-next:hover::after {
    color: #ffffff;
}

/* DIVIDER */
.featured-divider {
    width: 80%;
    height: 2px;
    background: rgba(255,255,255,.25);
    margin: 45px auto 0;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .featured-card {
        height: 130px;
    }

    .featured-card img {
        max-height: 70px;
    }
}

    </style>
<script>
const featuredSwiper = new Swiper(".featuredSwiper", {
    loop: true,
    slidesPerView: 6,
    spaceBetween: 30,
    speed: 700,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: ".featured-section .swiper-button-next",
        prevEl: ".featured-section .swiper-button-prev",
    },
    breakpoints: {
        0: {
            slidesPerView: 1,
        },
        576: {
            slidesPerView: 3,
        },
        768: {
            slidesPerView: 4,
        },
        1024: {
            slidesPerView: 5,
        }
    }
});
</script>
