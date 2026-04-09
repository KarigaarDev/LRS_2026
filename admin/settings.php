<?php
session_start();
include '../db.php';
include 'partials/header.php';

if (isset($_POST['save'])) {

    /* ---------- HERO ---------- */
    $particles = isset($_POST['particles_enabled']) ? 1 : 0;
    $heroImage = $_POST['old_hero_image'];

    if (!empty($_FILES['hero_image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['hero_image']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg','jpeg','png','webp'])) {
            $heroImage = 'hero_' . time() . '.' . $ext;
            move_uploaded_file(
                $_FILES['hero_image']['tmp_name'],
                "../assets/images/" . $heroImage
            );
        }
    }

    /* ---------- CHECKBOX FLAGS (FUNCTION) ---------- */
    function flag($name) {
        return isset($_POST[$name]) ? 1 : 0;
    }

    /* ---------- CHECKBOX FLAGS (VARIABLES) ---------- */
    $facebook_enabled   = flag('facebook_enabled');
    $instagram_enabled  = flag('instagram_enabled');
    $linkedin_enabled   = flag('linkedin_enabled');
    $youtube_enabled    = flag('youtube_enabled');
    $twitter_enabled    = flag('twitter_enabled');

    $activity_logs      = flag('activity_logs');
    $maintenance_mode   = flag('maintenance_mode');


    $enable_hero          = flag('enable_hero');
    $enable_services      = flag('enable_services');
    $enable_clients       = flag('enable_clients');
    $enable_celebrities   = flag('enable_celebrities');
    $enable_video_gallery = flag('enable_video_gallery');
    $enable_portfolio     = flag('enable_portfolio');
    $enable_instafeed     = flag('enable_instafeed');
    $enable_reviews       = flag('enable_reviews');
    $enable_stories       = flag('enable_stories');
    $enable_featured_in   = flag('enable_featured_in');
    $enable_team          = flag('enable_team');
    $enable_cta           = flag('enable_cta');

    /* ---------- PREPARE QUERY ---------- */
    $stmt = $conn->prepare("
        UPDATE site_settings SET
        short_tagline=?,
        hero_image=?,
        particles_enabled=?,
        business_email=?,
        phone=?,
        whatsapp=?,
        address=?,
        facebook_url=?, facebook_enabled=?,
        instagram_url=?, instagram_enabled=?,
        linkedin_url=?, linkedin_enabled=?,
        youtube_url=?, youtube_enabled=?,
        twitter_url=?, twitter_enabled=?,
        meta_title=?, meta_description=?, meta_keywords=?,
        google_verification=?, facebook_pixel=?, google_analytics=?,
        activity_logs=?, maintenance_mode=?, maintenance_message=?,
        enable_hero=?, enable_services=?, enable_clients=?,
        enable_celebrities=?, enable_video_gallery=?, enable_portfolio=?,
        enable_instafeed=?, enable_reviews=?, enable_stories=?,
        enable_featured_in=?, enable_team=?, enable_cta=?
        WHERE id=1
    ");

    /* ---------- BIND ---------- */
    $stmt->bind_param(
        "ssisssssssssssssssssssssssssssssssssss",
        $_POST['short_tagline'],
        $heroImage,
        $particles,
        $_POST['business_email'],
        $_POST['phone'],
        $_POST['whatsapp'],
        $_POST['address'],
        $_POST['facebook_url'],   $facebook_enabled,
        $_POST['instagram_url'],  $instagram_enabled,
        $_POST['linkedin_url'],   $linkedin_enabled,
        $_POST['youtube_url'],    $youtube_enabled,
        $_POST['twitter_url'],    $twitter_enabled,
        $_POST['meta_title'],
        $_POST['meta_description'],
        $_POST['meta_keywords'],
        $_POST['google_verification'],
        $_POST['facebook_pixel'],
        $_POST['google_analytics'],
        $activity_logs,
        $maintenance_mode,
        $_POST['maintenance_message'],
        $enable_hero,
        $enable_services,
        $enable_clients,
        $enable_celebrities,
        $enable_video_gallery,
        $enable_portfolio,
        $enable_instafeed,
        $enable_reviews,
        $enable_stories,
        $enable_featured_in,
        $enable_team,
        $enable_cta
    );

    $stmt->execute();
    header("Location: settings.php?success=1");
    exit;
}


/* ==========================
   LOAD SETTINGS
========================== */
$data = $conn->query("SELECT * FROM site_settings WHERE id=1")->fetch_assoc();
?>

<h2 class="mb-4">Website Settings</h2>

<?php if (isset($_GET['success'])): ?>
<div class="alert alert-success">Settings saved successfully</div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">

<!-- HERO -->
<h4>Hero & Branding</h4>
<div class="card p-3 mb-4">
<input type="hidden" name="old_hero_image"  value="<?= htmlspecialchars($data['hero_image']) ?>">

<label>Short Tagline</label>
<input class="form-control mb-3" name="short_tagline"
       value="<?= htmlspecialchars($data['short_tagline']) ?>">

<label>Hero Background Image</label>
<input type="file" name="hero_image" class="form-control mb-2">
<img src="../assets/images/<?= $data['hero_image'] ?>" height="80px" width="80px" alt="Hero Image">

<div class="form-check form-switch mt-3">
<input class="form-check-input" type="checkbox" name="particles_enabled"
<?= $data['particles_enabled'] ? 'checked' : '' ?>>
<label>Enable Particle Effect</label>
</div>
</div>

<!-- CONTACT -->
<h4>Contact Information</h4>
<div class="card p-3 mb-4">
<input class="form-control mb-2" name="business_email" value="<?= $data['business_email'] ?>" placeholder="Email">
<input class="form-control mb-2" name="phone" value="<?= $data['phone'] ?>" placeholder="Phone">
<input class="form-control mb-2" name="whatsapp" value="<?= $data['whatsapp'] ?>" placeholder="WhatsApp">
<textarea class="form-control" name="address"><?= $data['address'] ?></textarea>
</div>

<!-- SOCIAL -->
<h4>Social Media</h4>
<div class="card p-3 mb-4">
<?php foreach (['facebook','instagram','linkedin','youtube','twitter'] as $s): ?>
<input class="form-control mb-2" name="<?= $s ?>_url"
       value="<?= $data[$s.'_url'] ?>" placeholder="<?= ucfirst($s) ?> URL">
<div class="form-check form-switch mb-3">
<input class="form-check-input" type="checkbox" name="<?= $s ?>_enabled"
<?= $data[$s.'_enabled'] ? 'checked' : '' ?>>
<label><?= ucfirst($s) ?> Enabled</label>
</div>
<?php endforeach; ?>
</div>

<!-- SEO -->
<h4>SEO Defaults</h4>
<div class="card p-3 mb-4">
<input class="form-control mb-2" name="meta_title" value="<?= $data['meta_title'] ?>">
<textarea class="form-control mb-2" name="meta_description"><?= $data['meta_description'] ?></textarea>
<textarea class="form-control" name="meta_keywords"><?= $data['meta_keywords'] ?></textarea>
</div>

<!-- SYSTEM -->
<h4>System & Tracking</h4>
<div class="card p-3 mb-4">
<input class="form-control mb-2" name="google_verification" value="<?= $data['google_verification'] ?>">
<input class="form-control mb-2" name="facebook_pixel" value="<?= $data['facebook_pixel'] ?>">
<input class="form-control mb-2" name="google_analytics" value="<?= $data['google_analytics'] ?>">

<div class="form-check form-switch">
<input class="form-check-input" type="checkbox" name="activity_logs" <?= $data['activity_logs']?'checked':'' ?>>
<label>Enable Activity Logs</label>
</div>

<div class="form-check form-switch mt-2">
<input class="form-check-input" type="checkbox" name="maintenance_mode" <?= $data['maintenance_mode']?'checked':'' ?>>
<label>Maintenance Mode</label>
</div>

<textarea class="form-control mt-2" name="maintenance_message" placeholder="Maintenance Message"><?= $data['maintenance_message'] ?></textarea>
</div>

<!-- SECTIONS -->
<h4>Homepage Sections</h4>
<div class="card p-3 mb-4">
<?php
$sections = [
'enable_hero'=>'Hero',
'enable_services'=>'Services',
'enable_clients'=>'Clients',
'enable_celebrities'=>'Celebrities',
'enable_video_gallery'=>'Video Gallery',
'enable_portfolio'=>'Portfolio',
'enable_instafeed'=>'Instagram Feed',
'enable_reviews'=>'Reviews',
'enable_stories'=>'Stories',
'enable_featured_in'=>'Featured In',
'enable_team'=>'Team',
'enable_cta'=>'CTA'
];
foreach ($sections as $k=>$v):
?>
<div class="form-check form-switch">
<input class="form-check-input" type="checkbox" name="<?= $k ?>" <?= $data[$k]?'checked':'' ?>>
<label><?= $v ?></label>
</div>
<?php endforeach; ?>
</div>

<button name="save" class="btn btn-primary">Save Settings</button>
</form>

<?php include 'partials/footer.php'; ?>
