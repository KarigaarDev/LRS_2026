<?php
include '../db.php';
include 'partials/header.php';
$editData = null;

if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $editData = $conn->query("SELECT * FROM reviews WHERE id=$id")->fetch_assoc();
}

/* =====================
   ADD REVIEW
===================== */
if (isset($_POST['add'])) {

    $name   = trim($_POST['name']);
    $rating = (int)$_POST['rating'];
    $review = trim($_POST['review']);
    $active = isset($_POST['is_active']) ? 1 : 0;

    if (!empty($_FILES['image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','webp'];

        if (in_array($ext, $allowed)) {
            $img = uniqid('review_') . '.' . $ext;
            $path = "../assets/images/reviews/";

            if (!is_dir($path)) {
                mkdir($path, 0777, true);
            }

            move_uploaded_file($_FILES['image']['tmp_name'], $path . $img);

            $stmt = $conn->prepare("
                INSERT INTO reviews (name, image, rating, review, is_active)
                VALUES (?, ?, ?, ?, ?)
            ");
            $stmt->bind_param("ssisi", $name, $img, $rating, $review, $active);
            $stmt->execute();

            header("Location: reviews.php?success=1");
            exit;
        }
    }
}
/* =====================
   UPDATE REVIEW
===================== */
if (isset($_POST['update'])) {

    $id     = (int)$_POST['id'];
    $name   = trim($_POST['name']);
    $rating = (int)$_POST['rating'];
    $review = trim($_POST['review']);
    $active = isset($_POST['is_active']) ? 1 : 0;

    $imgSql = "";

    if (!empty($_FILES['image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','webp'];

        if (in_array($ext, $allowed)) {
            $img = uniqid('review_') . '.' . $ext;
            move_uploaded_file($_FILES['image']['tmp_name'], "../assets/images/reviews/".$img);
            $imgSql = ", image='$img'";
        }
    }

    $conn->query("
        UPDATE reviews SET
            name='$name',
            rating='$rating',
            review='$review',
            is_active='$active'
            $imgSql
        WHERE id=$id
    ");

    header("Location: reviews.php?updated=1");
    exit;
}


/* =====================
   DELETE REVIEW
===================== */
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];

    $img = $conn->query("SELECT image FROM reviews WHERE id=$id")->fetch_assoc();
    if ($img && file_exists("../assets/images/reviews/".$img['image'])) {
        unlink("../assets/images/reviews/".$img['image']);
    }

    $conn->query("DELETE FROM reviews WHERE id=$id");
    header("Location: reviews.php?deleted=1");
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Client Reviews</h2>
</div>

<?php if(isset($_GET['success'])): ?>
<div class="alert alert-success">Review added successfully!</div>
<?php endif; ?>

<?php if(isset($_GET['deleted'])): ?>
<div class="alert alert-warning">Review deleted!</div>
<?php endif; ?>

<!-- ADD REVIEW -->
<div class="card shadow-sm mb-4">
    <div class="card-header fw-semibold">
    <?= $editData ? 'Edit Review' : 'Add New Review' ?>
</div>

    <div class="card-body">
        <form method="post" enctype="multipart/form-data" class="row g-3">
<input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">


            <div class="col-md-6">
                <label class="form-label">Client Name</label>
                <input type="text" name="name" class="form-control"
       value="<?= $editData['name'] ?? '' ?>" required>

            </div>

            <div class="col-md-6">
                <label class="form-label">Profile Image</label>
                <input type="file" name="image" class="form-control" <?= $editData ? '' : 'required' ?>>

            </div>

            <div class="col-md-4">
                <label class="form-label">Rating</label>
               <select name="rating" class="form-select">
<?php for($i=5;$i>=1;$i--): ?>
<option value="<?= $i ?>" <?= (isset($editData) && $editData['rating']==$i) ? 'selected' : '' ?>>
    <?= str_repeat('★',$i) ?> (<?= $i ?>)
</option>
<?php endfor; ?>
</select>

            </div>

            <div class="col-md-8">
                <label class="form-label">Review Text</label>
                <textarea name="review" class="form-control" rows="3" required><?= $editData['review'] ?? '' ?></textarea>

            </div>

            <div class="col-md-4">
                <div class="form-check form-switch mt-4">
                   <input class="form-check-input" type="checkbox" name="is_active"
<?= !isset($editData) || $editData['is_active'] ? 'checked' : '' ?>>

                    <label class="form-check-label">Active</label>
                </div>
            </div>

            <div class="col-12">
               <button name="<?= $editData ? 'update' : 'add' ?>" class="btn btn-primary">
    <i class="fa fa-save"></i>
    <?= $editData ? 'Update Review' : 'Add Review' ?>
</button>

            </div>

        </form>
    </div>
</div>

<!-- REVIEW LIST -->
<div class="card shadow-sm">
    <div class="card-header fw-semibold">All Reviews</div>
    <div class="card-body table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th width="90">Image</th>
                    <th>Name</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Status</th>
                    <th width="100">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $rows = $conn->query("SELECT * FROM reviews ORDER BY id DESC");
            while($r = $rows->fetch_assoc()):
            ?>
                <tr>
                    <td>
                        <img src="../assets/images/reviews/<?= $r['image'] ?>"
                             class="rounded-circle"
                             style="width:50px;height:50px;object-fit:cover;">
                    </td>
                    <td class="fw-semibold"><?= htmlspecialchars($r['name']) ?></td>
                    <td><?= str_repeat("★", $r['rating']) ?></td>
                    <td style="max-width:300px"><?= htmlspecialchars($r['review']) ?></td>
                    <td>
                        <?= $r['is_active'] ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-secondary">Hidden</span>' ?>
                    </td>
                    <td>
    <a href="?edit=<?= $r['id'] ?>" class="btn btn-sm btn-primary">
        <i class="fa fa-edit"></i>
    </a>

    <a href="?delete=<?= $r['id'] ?>"
       onclick="return confirm('Delete this review?')"
       class="btn btn-sm btn-danger">
       <i class="fa fa-trash"></i>
    </a>
</td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
