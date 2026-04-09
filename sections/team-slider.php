<section class="teams-section" id="team">
    <h2 class="teams-title section-title">Our Team</h2>

    <div class="teams-wrapper">

        <!-- LEFT NAV -->
        <div class="swiper-button-prev team-nav"></div>

        <!-- SLIDER -->
        <div class="swiper teamSwiper">
            <div class="swiper-wrapper">

                <?php
                $teams = $conn->query("SELECT * FROM team WHERE status = 1 ORDER BY sort_order ASC, id DESC");
                while ($c = $teams->fetch_assoc()):
                ?>
                    <div class="swiper-slide">
                        <div class="team-card">

                            <div class="team-img">
                                <img src="assets/images/team/<?= $c['image'] ?>"
                                     alt="<?= htmlspecialchars($c['name']) ?>">
                            </div>

                            <div class="team-info">
                                <h4><?= htmlspecialchars($c['name']) ?></h4>

                                <?php if (!empty($c['designation'])): ?>
                                    <span class="team-role"><?= htmlspecialchars($c['designation']) ?></span>
                                <?php endif; ?>
                            </div>

                            <?php if (!empty($c['instagram']) || !empty($c['website'])): ?>
                                <div class="team-socials">
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
        <div class="swiper-button-next team-nav"></div>

    </div>

    <div class="teams-divider"></div>
</section>

<style>
/* ===== SECTION ===== */
.teams-section {
    background: #122235;
    padding: 70px 0 50px;
    text-align: center;
}

.teams-title {
    color: #fff;
    font-size: 32px;
    margin-bottom: 40px;
    font-family: 'Playfair Display', serif;
}

/* ===== WRAPPER ===== */
.teams-wrapper {
    max-width: 1400px;
    margin: auto;
    position: relative;
    padding: 0 60px; /* space for arrows */
}

/* ===== SLIDER ===== */
.teamSwiper {
    padding: 20px 0;
}

.swiper-slide {
    display: flex;
    justify-content: center;
}

/* ===== CARD ===== */
.team-card {
    width: 220px;
    background: #ffffff;
    border-radius: 16px;
    padding: 16px 16px 20px;
    box-shadow: 0 12px 30px rgba(0,0,0,.25);
    text-align: center;
    transition: transform .3s ease;
}

.team-card:hover {
    transform: translateY(-8px);
}

/* IMAGE */
.team-img {
    width: 100%;
    height: 200px;
    overflow: hidden;
    border-radius: 14px;
}

.team-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* INFO */
.team-info h4 {
    margin: 12px 0 4px;
    font-size: 17px;
    font-weight: 600;
    color: #111;
}

.team-role {
    font-size: 13px;
    color: #777;
}

/* SOCIALS */
.team-socials {
    display: flex;
    justify-content: center;
    gap: 12px;
    margin-top: 14px;
}

.team-socials a {
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

.team-socials a:hover {
    background: #4f6df5;
    transform: scale(1.1);
}

/* ===== NAVIGATION (OUTSIDE SLIDER) ===== */
.team-nav {
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
.teams-divider {
    width: 80%;
    height: 2px;
    background: rgba(255,255,255,.25);
    margin: 45px auto 0;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
    .team-card {
        width: 190px;
    }

    .team-img {
        height: 170px;
    }
}

</style>
