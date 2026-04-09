<section id="portfolio" class="portfolio-section">
    <div class="container">

        <h2 class="portfolio-title section-title">Our Portfolio</h2>
<div class="portfolio-wrapper">
           
        <!-- ================= FILTERS (DYNAMIC) ================= -->
        <div class="portfolio-filters">
            <button class="active" data-filter="*">All</button>

            <?php
            $cats = $conn->query("
                SELECT DISTINCT category 
                FROM portfolio 
                WHERE status=1 
                ORDER BY category ASC
            ");

            while($cat = $cats->fetch_assoc()):
                $slug = strtolower(str_replace(' ', '-', $cat['category']));
            ?>
                <button data-filter=".<?= $slug ?>">
                    <?= htmlspecialchars($cat['category']) ?>
                </button>
            <?php endwhile; ?>
        </div>

        <!-- ================= GRID ================= -->
        <div class="portfolio-grid">

            <?php
            $data = $conn->query("
                SELECT * FROM portfolio 
                WHERE status=1 
                ORDER BY sort_order ASC
            ");

            while($p = $data->fetch_assoc()):
                $catClass = strtolower(str_replace(' ', '-', $p['category']));
            ?>

           <div class="portfolio-item <?= $catClass ?>">
    <a
        href="<?= BASE_URL ?>portfolio-detail/<?= $p['id'] ?>"
        class="portfolio-card"
        data-portfolio-id="<?= $p['id'] ?>"
        data-category="<?= htmlspecialchars($p['category']) ?>"
    >
        <img
            src="<?= asset('assets/images/portfolio/' . $p['image']) ?>"
            alt="<?= htmlspecialchars($p['title']) ?>"
            loading="lazy"
        >

        <div class="portfolio-overlay">
            <h4><?= htmlspecialchars($p['title']) ?></h4>
            <span><?= htmlspecialchars($p['category']) ?></span>
        </div>
    </a>
</div>


            <?php endwhile; ?>

        </div>
</div>
    </div>
</section>

<style>
/* ===== PORTFOLIO SECTION ===== */
.portfolio-section {
    background: #5a3f79;
    padding: 90px 0;
}
.portfolio-wrapper {
    max-width: 1400px;
    margin: auto;
    position: relative;
    padding: 0 60px; /* space for arrows */
}

.portfolio-title {
    text-align: center;
    color: #fff;
    font-size: clamp(30px, 4vw, 42px);
    margin-bottom: 30px;
    font-family: 'Playfair Display', serif;
}
.portfolio-card {
    cursor: pointer;
    text-decoration: none;
}

.portfolio-overlay {
    pointer-events: none;
}

/* Filters */
.portfolio-filters {
    text-align: center;
    margin-bottom: 45px;
}

.portfolio-filters button {
    background: rgba(255,255,255,.18);
    border: 0;
    color: #fff;
    padding: 10px 24px;
    margin: 6px;
    border-radius: 30px;
    cursor: pointer;
    transition: all .3s ease;
    font-weight: 500;
}

.portfolio-filters button.active,
.portfolio-filters button:hover {
    background: #fff;
    color: #5a3f79;
}

/* Masonry */
.portfolio-grid {
    column-count: 4;
    column-gap: 18px;
}

.portfolio-item {
    break-inside: avoid;
    margin-bottom: 18px;
    width: 100%;
}


/* Card */
.portfolio-card {
    position: relative;
    display: block;
    border-radius: 10px;
    overflow: hidden;
    background: #000;
    box-shadow: 0 12px 30px rgba(0,0,0,.35);
    text-decoration: none;
}

.portfolio-card img {
    width: 100%;
    display: block;
    transition: transform .6s ease;
}

/* Hover */
.portfolio-card:hover img {
    transform: scale(1.08);
}

.portfolio-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,.75), rgba(0,0,0,.1));
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 18px;
    opacity: 0;
    transition: opacity .35s ease;
}

.portfolio-card:hover .portfolio-overlay {
    opacity: 1;
}

.portfolio-overlay h4 {
    color: #fff;
    font-size: 16px;
    margin: 0 0 4px;
}

.portfolio-overlay span {
    color: #ddd;
    font-size: 13px;
}

.portfolio-cta {
    margin-top: 10px;
    font-size: 13px;
    font-weight: 600;
    color: #fff;
    opacity: .9;
}

/* Responsive */
@media (max-width: 1400px) { .portfolio-grid { column-count: 4; } }
@media (max-width: 1100px) { .portfolio-grid { column-count: 3; } }
@media (max-width: 768px)  { .portfolio-grid { column-count: 2; } }
@media (max-width: 480px)  { .portfolio-grid { column-count: 1; } }
</style>
<script>
document.addEventListener("DOMContentLoaded", () => {

    const buttons = document.querySelectorAll('.portfolio-filters button');
    const items   = document.querySelectorAll('.portfolio-item');

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {

            document.querySelector('.portfolio-filters .active')
                ?.classList.remove('active');

            btn.classList.add('active');

            const filter = btn.dataset.filter;

            items.forEach(item => {
                if (filter === '*' || item.classList.contains(filter.substring(1))) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

});
</script>

