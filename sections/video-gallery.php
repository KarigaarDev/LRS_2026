<?php
$videos = $conn->query("
    SELECT video_id 
    FROM youtube_shorts 
    WHERE status = 1 
    ORDER BY sort_order ASC
");
?>

<!-- ================= YOUTUBE SHORTS ================= -->
<section class="video-gallery" id="videos">
    <h2 class="section-title">YouTube Shorts</h2>

    <div class="ytShorts-wrapper">
        <div class="swiper shortsSwiper">
            <div class="swiper-wrapper">

                <?php $i = 0; while($v = $videos->fetch_assoc()): ?>
                <div class="swiper-slide">
                    <iframe
                        class="yt-player"
                        data-index="<?= $i ?>"
                        src="https://www.youtube.com/embed/<?= htmlspecialchars($v['video_id']) ?>?enablejsapi=1&controls=1&mute=1&loop=1&playlist=<?= $v['video_id'] ?>"
                        allow="autoplay; encrypted-media"
                        allowfullscreen>
                    </iframe>
                </div>
                <?php $i++; endwhile; ?>

            </div>

            <div class="swiper-button-prev reels-nav"></div>
            <div class="swiper-button-next reels-nav"></div>
        </div>
    </div>
</section>

<!-- ================= CSS ================= -->
<style>
body { background:#000; }

.video-gallery {
    padding: 90px 0;
    text-align:center;
}

.video-gallery h2 {
    color:#fff;
    font-size:38px;
    margin-bottom:40px;
    font-family:'Playfair Display', serif;
}

.ytShorts-wrapper {
    max-width:1300px;
    margin:auto;
    overflow:hidden;
}

.shortsSwiper {
    padding:60px 80px;
}

.swiper-slide {
    /* width:300px !important; */
    height:520px;
    display:flex;
    justify-content:center;
    align-items:center;
}

.swiper-slide iframe {
    width:300px;
    height:520px;
    border-radius:20px;
    border:0;
    box-shadow:0 20px 50px rgba(0,0,0,.8);
    transform:scale(.88);
    opacity:.55;
    transition:.4s ease;
}

.swiper-slide-active iframe {
    transform:scale(1.08);
    opacity:1;
}

/* Nav */
.reels-nav {
    width:54px;
    height:54px;
    border-radius:50%;
    background:rgba(255,255,255,.12);
    backdrop-filter:blur(8px);
}

.reels-nav::after {
    font-size:26px;
    color:#fff;
}

/* Responsive */
@media(max-width:1024px){
    .swiper-slide iframe {
        width:260px;
        height:460px;
    }
}

@media(max-width:768px){
    .shortsSwiper { padding:20px; }
    .swiper-slide iframe {
        width:90vw;
        height:70vh;
    }
}
@media(max-width:480px){
    .swiper-slide iframe {
        height:60vh;
    }
    .shortsSwiper {
        padding:40px 57px;
    }
}
</style>

<!-- ================= LIBS ================= -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://www.youtube.com/iframe_api"></script>

<!-- ================= SCRIPT ================= -->
<script>
let players = {};
let swiper;
let ytReady = false;

/* YT API READY */
function onYouTubeIframeAPIReady() {
    ytReady = true;

    document.querySelectorAll(".yt-player").forEach(el => {
        const index = el.dataset.index;
        players[index] = new YT.Player(el);
    });

    setTimeout(playActiveVideo, 700);
}

/* Swiper */
document.addEventListener("DOMContentLoaded", () => {

    swiper = new Swiper(".shortsSwiper", {
        loop: true,
        centeredSlides: true,
        // grabCursor: true,
        slidesPerView: "auto",
        spaceBetween: 30,

        // initialSlide: 2, // 3rd video active

        breakpoints: {
            0:   { slidesPerView: 1 },
            768: { slidesPerView: 3 },
            1200:{ slidesPerView: 4 }
        },

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        },

        on: {
            slideChangeTransitionStart() {
                pauseAllVideos();
            },
            slideChangeTransitionEnd() {
                playActiveVideo();
            }
        }
    });
});

/* Helpers */
function pauseAllVideos() {
    Object.values(players).forEach(p => {
        if (p && p.pauseVideo) p.pauseVideo();
    });
}

function playActiveVideo() {
    if (!ytReady || !swiper) return;

    const index = swiper.realIndex;
    if (players[index]) {
        players[index].mute();
        players[index].playVideo();
    }
}
</script>
