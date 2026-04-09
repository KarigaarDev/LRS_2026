<section class="clients-section" id="clients">
    <h2 class="clients-title section-title">Our Clients</h2>

    <div class="clients-wrapper">

        <!-- LEFT NAV -->
        <div class="swiper-button-prev client-nav"></div>

        <!-- SLIDER -->
        <div class="swiper clientsSwiper">
            <div class="swiper-wrapper">
                <?php
                $clients = $conn->query("SELECT * FROM clients ORDER BY id DESC");
                while ($c = $clients->fetch_assoc()):
                ?>
                    <div class="swiper-slide">
                        <div class="client-card">
                            <img src="assets/images/clients/<?= $c['logo'] ?>" alt="<?= $c['name'] ?>">
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>

        <!-- RIGHT NAV -->
        <div class="swiper-button-next client-nav"></div>

    </div>

    <div class="clients-divider"></div>
</section>


<!-- ===== CLIENT SECTION CSS ===== -->
<style>
.clients-section {
    background: #233447;
    padding: 70px 0 50px;
    text-align: center;
}

.clients-title {
    color: #fff;
    font-size: 32px;
    margin-bottom: 40px;
    font-family: 'Playfair Display', serif;
}



/* CARD SIZE FIX */
.client-card {
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

.client-card img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}
.client-card:hover {
    transform: translateY(-6px);
}

/* Navigation Arrows */
/* Arrow styling */
.client-nav {
    color: #cbd5ff;
}

.swiper-button-prev::after,
.swiper-button-next::after {
    font-size: 22px;
    font-weight: bold;
    color: #cbd5ff;
    transition: color .3s ease;
    
}
.clientsSwiper {
    width: 100%;
    padding: 20px 40px;
}

.swiper-slide {
    display: flex;
    justify-content: center;
}

/* Bottom Divider */
.clients-divider {
    width: 80%;
    height: 2px;
    background: rgba(255,255,255,.25);
    margin: 45px auto 0;
}
.clients-wrapper {
    max-width: 1400px;
    margin: auto;
    position: relative;
    overflow: hidden; /* IMPORTANT */
}



/* Responsive */
@media (max-width: 768px) {
    .client-card {
        height: 130px;
    }

    .client-card img {
        max-height: 70px;
    }
}
.clients-wrapper {
    max-width: 1400px;
    margin: auto;
    position: relative;
    padding: 0 60px; /* space for arrows */
}

/* NAV BUTTONS */
.client-nav {
    color: #cbd5ff;
    width: 42px;
    height: 42px;
}

.swiper-button-prev,
.swiper-button-next {
    top: 50%;
    transform: translateY(-50%);
}

.swiper-button-prev {
    left: -10px; /* OUTSIDE LEFT */
}

.swiper-button-next {
    right: -10px; /* OUTSIDE RIGHT */
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

</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
    new Swiper(".clientsSwiper", {
        loop: true,
        speed: 700,
        spaceBetween: 30,
        centeredSlides: false,
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },

        navigation: {
            nextEl: ".clients-section .swiper-button-next",
            prevEl: ".clients-section .swiper-button-prev",
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
                slidesPerView: 6,
            },
        },

        grabCursor: true,
        watchOverflow: true,
    });
});
</script>
