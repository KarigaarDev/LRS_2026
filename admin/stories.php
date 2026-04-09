<?php include '../db.php'; ?>
<?php include 'partials/header.php'; ?>

<?php
/* ============================
   SAVE STORY SETTINGS
============================ */
if (isset($_POST['save'])) {
    $ids = $_POST['story'] ?? [];

    foreach ($ids as $wp_id => $data) {
        $wp_id = (int)$wp_id;
        $active = isset($data['active']) ? 1 : 0;
        $featured = isset($data['featured']) ? 1 : 0;
        $cat = (int)$data['category'];

        $check = $conn->query("SELECT id FROM story_controls WHERE wp_post_id=$wp_id");
        if ($check->num_rows) {
            $conn->query("
                UPDATE story_controls SET
                is_active=$active,
                is_featured=$featured,
                wp_category_id=$cat
                WHERE wp_post_id=$wp_id
            ");
        } else {
            $conn->query("
                INSERT INTO story_controls
                (wp_post_id, wp_category_id, is_active, is_featured)
                VALUES ($wp_id,$cat,$active,$featured)
            ");
        }
    }
    header("Location: stories.php");
    exit;
}

/* ============================
   LOAD WP POSTS
============================ */
$wpApi = "https://livingroomstoriez.co.in/wp-json/wp/v2/posts?_embed&per_page=100";
$wpPosts = json_decode(@file_get_contents($wpApi), true);

/* ============================
   DB DATA
============================ */
$dbData = [];
$res = $conn->query("SELECT * FROM story_controls");
while ($r = $res->fetch_assoc()) {
    $dbData[$r['wp_post_id']] = $r;
}
?>

<h2 class="mb-4">Stories Manager</h2>

<div class="card mb-4">
<form method="post">
<div class="story-admin-grid">

<?php foreach ($wpPosts as $post):
    $id = $post['id'];
    $img = $post['_embedded']['wp:featuredmedia'][0]['source_url'] ?? '';
    $cat = $post['categories'][0] ?? 0;

    $row = $dbData[$id] ?? [];
?>
<div class="story-admin-card">
    <img src="<?= $img ?>" alt="">

    <div class="story-admin-body">
        <h6><?= strip_tags($post['title']['rendered']) ?></h6>
        <small class="text-muted">
    <?= $post['_embedded']['wp:term'][0][0]['name'] ?? '' ?>
</small>


        <input type="hidden" name="story[<?= $id ?>][category]" value="<?= $cat ?>">

        <div class="form-check form-switch">
            <input class="form-check-input"
                   type="checkbox"
                   name="story[<?= $id ?>][active]"
                   <?= ($row['is_active'] ?? 0) ? 'checked' : '' ?>>
            <label class="form-check-label">Active</label>
        </div>

        <div class="form-check form-switch">
            <input class="form-check-input"
                   type="checkbox"
                   name="story[<?= $id ?>][featured]"
                   <?= ($row['is_featured'] ?? 0) ? 'checked' : '' ?>>
            <label class="form-check-label">Featured</label>
        </div>
    </div>
</div>
<?php endforeach; ?>

</div>

<div class="p-3 border-top d-flex gap-2">
    <button name="save" class="btn btn-primary">Save Changes</button>
    <a href="stories.php" class="btn btn-secondary">Refresh</a>
</div>
</form>
</div>

<?php include 'partials/footer.php'; ?>

<style>
/* ===============================
   STORY ADMIN GRID
================================ */
.story-admin-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px,1fr));
    gap: 18px;
    padding: 16px;
}

.story-admin-card {
    background: var(--bs-body-bg);
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,.12);
    transition: transform .2s;
    border: 1px solid var(--bs-border-color);
}

.story-admin-card:hover {
    transform: translateY(-4px);
}

.story-admin-card img {
    width: 100%;
    height: 140px;
    object-fit: cover;
}

.story-admin-body {
    padding: 12px;
}

.story-admin-body h6 {
    font-size: 14px;
    margin-bottom: 10px;
}

/* Dark mode safe */
[data-bs-theme="dark"] .story-admin-card {
    box-shadow: 0 10px 30px rgba(0,0,0,.6);
}
</style>
