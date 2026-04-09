<?php include 'db.php'; ?>
<?php include 'partials/header.php'; ?>

<?php
/* =====================
   ADD YOUTUBE SHORT
   ===================== */
if (isset($_POST['add_yt'])) {

    $title = trim($_POST['title']);
    $video_id = trim($_POST['video_id']);
    $sort = (int) $_POST['sort_order'];
    $status = isset($_POST['status']) ? 1 : 0;

    $stmt = $conn->prepare(
        "INSERT INTO youtube_shorts (title, video_id, sort_order, status)
         VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("ssii", $title, $video_id, $sort, $status);
    $stmt->execute();

    header("Location: shorts_reels.php?success=1");
    exit;
}

/* =====================
   ADD INSTAGRAM REEL
   ===================== */
if (isset($_POST['add_ig'])) {

    $title = trim($_POST['title']);
    $url = trim($_POST['reel_url']);
    $sort = (int) $_POST['sort_order'];
    $status = isset($_POST['status']) ? 1 : 0;

    $stmt = $conn->prepare(
        "INSERT INTO instagram_reels (title, reel_url, sort_order, status)
         VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("ssii", $title, $url, $sort, $status);
    $stmt->execute();

    header("Location: shorts_reels.php?success=1");
    exit;
}

/* =====================
   DELETE
   ===================== */
if (isset($_GET['delete']) && isset($_GET['type'])) {

    $id = (int) $_GET['delete'];
    $table = ($_GET['type'] === 'yt') ? 'youtube_shorts' : 'instagram_reels';

    $conn->query("DELETE FROM $table WHERE id=$id");
    header("Location: shorts_reels.php?deleted=1");
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Shorts & Reels</h2>
</div>

<?php if(isset($_GET['success'])): ?>
<div class="alert alert-success">Saved successfully!</div>
<?php endif; ?>

<?php if(isset($_GET['deleted'])): ?>
<div class="alert alert-warning">Deleted successfully!</div>
<?php endif; ?>

<!-- ================= YOUTUBE SHORTS ================= -->
<div class="card mb-4 shadow-sm">
    <div class="card-header fw-semibold">Add YouTube Short</div>
    <div class="card-body">
        <form method="post" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control">
            </div>

            <div class="col-md-4">
                <label class="form-label">YouTube Video ID</label>
                <input type="text" name="video_id" class="form-control" required>
            </div>

            <div class="col-md-2">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="0">
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="status" checked>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

            <div class="col-12">
                <button name="add_yt" class="btn btn-danger">
                    <i class="fab fa-youtube"></i> Add YouTube Short
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= INSTAGRAM REELS ================= -->
<div class="card mb-4 shadow-sm">
    <div class="card-header fw-semibold">Add Instagram Reel</div>
    <div class="card-body">
        <form method="post" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control">
            </div>

            <div class="col-md-4">
                <label class="form-label">Instagram Reel URL</label>
                <input type="url" name="reel_url" class="form-control" required>
            </div>

            <div class="col-md-2">
                <label class="form-label">Sort Order</label>
                <input type="number" name="sort_order" class="form-control" value="0">
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="status" checked>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

            <div class="col-12">
                <button name="add_ig" class="btn btn-primary">
                    <i class="fab fa-instagram"></i> Add Instagram Reel
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= LISTS ================= -->
<div class="row">
    <!-- YOUTUBE -->
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header fw-semibold">YouTube Shorts</div>
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle">
                    <tr>
                        <th>Video</th>
                        <th>Status</th>
                        <th>Order</th>
                        <th></th>
                    </tr>
                    <?php
                    $yt = $conn->query("SELECT * FROM youtube_shorts ORDER BY sort_order ASC");
                    while($v = $yt->fetch_assoc()):
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($v['video_id']) ?></td>
                        <td><?= $v['status'] ? 'Active' : 'Inactive' ?></td>
                        <td><?= $v['sort_order'] ?></td>
                        <td>
                            <a href="?delete=<?= $v['id'] ?>&type=yt"
                               onclick="return confirm('Delete?')"
                               class="btn btn-sm btn-danger">
                               <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </div>

    <!-- INSTAGRAM -->
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header fw-semibold">Instagram Reels</div>
            <div class="card-body table-responsive">
                <table class="table table-hover align-middle">
                    <tr>
                        <th>URL</th>
                        <th>Status</th>
                        <th>Order</th>
                        <th></th>
                    </tr>
                    <?php
                    $ig = $conn->query("SELECT * FROM instagram_reels ORDER BY sort_order ASC");
                    while($r = $ig->fetch_assoc()):
                    ?>
                    <tr>
                        <td class="text-truncate" style="max-width:200px;">
                            <?= htmlspecialchars($r['reel_url']) ?>
                        </td>
                        <td><?= $r['status'] ? 'Active' : 'Inactive' ?></td>
                        <td><?= $r['sort_order'] ?></td>
                        <td>
                            <a href="?delete=<?= $r['id'] ?>&type=ig"
                               onclick="return confirm('Delete?')"
                               class="btn btn-sm btn-danger">
                               <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
