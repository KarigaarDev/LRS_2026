<section id="services" class="services-section">
    <h2 class="services-title section-title">Our Services</h2>

    <div class="services-grid">

        <?php
        $services = $conn->query(
            "SELECT * FROM services 
             WHERE status = 1 
             ORDER BY sort_order ASC"
        );

        while ($s = $services->fetch_assoc()):
        ?>
            <div class="service-card"
                 style="background: <?= htmlspecialchars($s['bg_color']) ?>">

                <h3><?= htmlspecialchars($s['title']) ?></h3>

                <ul>
                    <?php
                    $items = $conn->query(
                        "SELECT item_name 
                         FROM service_items 
                         WHERE service_id = {$s['id']} 
                         ORDER BY sort_order ASC"
                    );
                    while ($i = $items->fetch_assoc()):
                    ?>
                        <li><?= htmlspecialchars($i['item_name']) ?></li>
                    <?php endwhile; ?>
                </ul>

            </div>
        <?php endwhile; ?>

    </div>
</section>
<style>
    /* ===== SERVICES SECTION ===== */
.services-section {
    background: radial-gradient(circle at top, #3b1d5a, #2a143f);
    padding: 90px 0 110px;
    text-align: center;
}

.services-title {
    font-size: 36px;
    color: #fff;
    margin-bottom: 60px;
    font-family: 'Playfair Display', serif;
}

/* GRID */
.services-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 35px;
    max-width: 1200px;
    margin: auto;
    padding: 0 20px;
}

/* CARD */
.service-card {
    border-radius: 18px;
    padding: 30px 25px 35px;
    color: #fff;
    box-shadow: 0 20px 40px rgba(0,0,0,.35);
    transition: transform .35s ease;
}

.service-card:hover {
    transform: translateY(-8px);
}

.service-card h3 {
    font-size: 22px;
    margin-bottom: 22px;
    font-family: 'Playfair Display', serif;
}

/* LIST */
.service-card ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.service-card ul li {
    font-size: 14px;
    margin-bottom: 8px;
    opacity: .95;
}

/* RESPONSIVE */
@media (max-width: 1100px) {
    .services-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 600px) {
    .services-grid {
        grid-template-columns: 1fr;
    }

    .services-title {
        font-size: 28px;
    }
}

</style>