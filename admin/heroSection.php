<?php
include '../db.php';
include 'partials/header.php';

/* ==========================
   SAVE HERO SETTINGS
========================== */
if (isset($_POST['save'])) {

    $particles = isset($_POST['particles']) ? 1 : 0;
    $image = $_POST['old_image'];

    if (!empty($_FILES['hero_image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['hero_image']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg','jpeg','png','webp'])) {
            $image = 'hero_'.time().'.'.$ext;
            $path = "../assets/images/";
            move_uploaded_file($_FILES['hero_image']['tmp_name'], $path.$image);
        }
    }

    $stmt = $conn->prepare("
        UPDATE hero_settings 
        SET hero_image=?, particles_enabled=? 
        WHERE id=1
    ");
    $stmt->bind_param("si", $image, $particles);
    $stmt->execute();

    header("Location: heroSection.php");
    exit;
}

/* LOAD */
$data = $conn->query("SELECT * FROM hero_settings WHERE id=1")->fetch_assoc();
?>

<h2 class="mb-4">Hero Section Settings</h2>

<div class="card">
<form method="post" enctype="multipart/form-data" class="row g-3 p-3">

    <input type="hidden" name="old_image" value="<?= $data['hero_image'] ?>">

    <div class="col-md-6">
        <label>Hero Background Image</label>
        <input type="file" name="hero_image" class="form-control">
        <small class="text-muted">Leave empty to keep current</small>
    </div>

    <div class="col-md-6 d-flex align-items-end">
        <div class="form-check form-switch">
            <input class="form-check-input"
                   type="checkbox"
                   name="particles"
                   <?= $data['particles_enabled'] ? 'checked' : '' ?>>
            <label class="form-check-label">Enable Particle Effect</label>
        </div>
    </div>

    <div class="col-12">
        <button name="save" class="btn btn-primary">Save Changes</button>
        <a href="heroSection.php" class="btn btn-secondary">Refresh</a>
    </div>
</form>
</div>

<?php include 'partials/footer.php'; ?>
