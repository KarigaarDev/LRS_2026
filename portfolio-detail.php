<?php
define('APP_START', true);

require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/sections/settings.php';
define('BASE_PATH', __DIR__);

/* ======================
   ROUTING
====================== */
$key  = $_GET['key'] ?? '';
$isId = ctype_digit($key);

/* ======================
   DATA FETCH
====================== */
if ($isId) {

    $id = (int)$key;

    $result = $conn->query("
        SELECT * FROM portfolio
        WHERE id = $id AND status = 1
        LIMIT 1
    ");

    $portfolio = $result ? $result->fetch_assoc() : null;

    if (!$portfolio) {
        http_response_code(404);
        include BASE_PATH . '/404.php';
        exit;
    }

    /* ===== Increment Views Safely ===== */
    $conn->query("UPDATE portfolio SET views = views + 1 WHERE id = $id");
    $portfolio['views']++; // keep display in sync

    /* ===== Related Works Query ===== */
    $cat = $conn->real_escape_string($portfolio['category']);
    $currentId = (int)$portfolio['id'];

    $rel = $conn->query("
        SELECT id, title, image
        FROM portfolio
        WHERE status = 1
          AND category = '$cat'
          AND id != $currentId
        ORDER BY sort_order ASC
        LIMIT 8
    ");

    if (!$rel) {
        $rel = null; // prevents errors in loop
    }

    /* ===== SEO ===== */
    $seo_title = $portfolio['seo_title'] ?: $portfolio['title'];
    $seo_desc  = $portfolio['seo_description'];
    $seo_keys  = $portfolio['seo_keywords'];

} else {

    $tag = $conn->real_escape_string($key);

    $seo_title = "Portfolio – $tag";
    $seo_desc  = "Creative works tagged with $tag";
    $seo_keys  = "$tag, portfolio";

    $list = $conn->query("
        SELECT * FROM portfolio
        WHERE status = 1
          AND (FIND_IN_SET('$tag', tags) OR category = '$tag')
        ORDER BY sort_order ASC
    ");

    if (!$list) {
        $list = null;
    }
}

include BASE_PATH . '/header.php';
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= asset('assets/css/portfolio-detail.css') ?>">
<link rel="stylesheet" href="<?= asset('assets/css/style.css') ?>">

<?php if ($isId): ?>

<section class="portfolio-detail-page">
    <div class="portfolio-detail-container">

        <div class="container portfolio-wrapper">
            <div class="row g-5 align-items-start">

                <!-- IMAGE -->
                <div class="col-5">
                    <div class="portfolio-image">
                        <img src="<?= asset('assets/images/portfolio/' . $portfolio['image']) ?>"
                             alt="<?= htmlspecialchars($portfolio['title']) ?>">
                    </div>
                </div>

                <!-- CONTENT -->
                <div class="col-7">
                    <div class="portfolio-content">
                        <h1 class="portfolio-title"><?= htmlspecialchars($portfolio['title']) ?></h1>

                        <div class="portfolio-meta">
                            <?= htmlspecialchars($portfolio['category']) ?> · <?= $portfolio['views'] ?> views
                        </div>

                        <div class="portfolio-description" style="max-width: 600px;">
                           <?php
                            $allowed_tags = '<b><strong><i><em><u><br><p><ul><ol><li><a>';
                            echo nl2br(strip_tags($portfolio['description'], $allowed_tags));
                            ?>
                        </div>

                        <div class="portfolio-tags">
                            <?php foreach (explode(',', $portfolio['tags']) as $t): 
                                $tag = trim($t); ?>
                                <a href="<?= BASE_URL ?>portfolio-detail/<?= urlencode($tag) ?>">
                                    <?= htmlspecialchars($tag) ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- RELATED WORKS -->
        <div class="related-section">
            <h3 class="section-title">Related Works</h3>

            <div class="row g-4">
                <?php if ($rel && $rel->num_rows > 0): ?>
                    <?php while ($r = $rel->fetch_assoc()): ?>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <a href="<?= BASE_URL ?>portfolio-detail/<?= $r['id'] ?>" class="related-card">
                                <img src="<?= asset('assets/images/portfolio/' . $r['image']) ?>"
                                     alt="<?= htmlspecialchars($r['title']) ?>"
                                     loading="lazy">
                                <div class="related-overlay">
                                    <h6><?= htmlspecialchars($r['title']) ?></h6>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-muted">No related works found.</p>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>

<?php else: ?>

<!-- TAG / CATEGORY LIST -->
<section class="portfolio-list-page">
    <div class="portfolio-list-container">

        <h2 class="section-title text-center mb-5">
            Portfolio: <?= htmlspecialchars($tag) ?>
        </h2>

        <div class="row g-4">
            <?php if ($list && $list->num_rows > 0): ?>
                <?php while ($p = $list->fetch_assoc()): ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="<?= BASE_URL ?>portfolio-detail/<?= $p['id'] ?>" class="related-card">
                            <img src="<?= asset('assets/images/portfolio/' . $p['image']) ?>"
                                 alt="<?= htmlspecialchars($p['title']) ?>"
                                 loading="lazy">
                            <div class="related-overlay">
                                <h5><?= htmlspecialchars($p['title']) ?></h5>
                            </div>
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center text-muted">No portfolio items found.</p>
            <?php endif; ?>
        </div>

    </div>
</section>

<?php endif; ?>

<?php include BASE_PATH . '/footer.php'; ?>
