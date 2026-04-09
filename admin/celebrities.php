<?php include 'db.php'; ?>
<?php include 'partials/header.php'; ?>

<?php
// =====================
// ADD / UPDATE CELEBRITY
// =====================
if (isset($_POST['save'])) {

    $id          = $_POST['id'] ?? null;
    $name        = trim($_POST['name']);
    $designation = trim($_POST['designation']);
    $instagram   = trim($_POST['instagram']);
    $website     = trim($_POST['website']);
    $sort_order  = (int)($_POST['sort_order'] ?? 0);
    $status      = isset($_POST['status']) ? 1 : 0;

    $image = $_POST['old_image'] ?? null;

    // IMAGE UPLOAD
    if (!empty($_FILES['image']['name'])) {

        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','webp'];

        if (in_array($ext, $allowed)) {

            $image = uniqid('celeb_') . '.' . $ext;
            $uploadPath = "../assets/images/celebs/";

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath . $image);

            // delete old image on update
            if (!empty($_POST['old_image']) && file_exists($uploadPath.$_POST['old_image'])) {
                unlink($uploadPath.$_POST['old_image']);
            }
        }
    }

    if ($id) {
        // UPDATE
        $stmt = $conn->prepare(
            "UPDATE celebrities 
             SET name=?, designation=?, image=?, instagram=?, website=?, sort_order=?, status=? 
             WHERE id=?"
        );
        $stmt->bind_param("sssssiii",
            $name, $designation, $image, $instagram, $website, $sort_order, $status, $id
        );
        $stmt->execute();

        header("Location: celebrities.php?updated=1");
        exit;

    } else {
        // INSERT
        $stmt = $conn->prepare(
            "INSERT INTO celebrities (name, designation, image, instagram, website, sort_order, status)
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssssssi",
            $name, $designation, $image, $instagram, $website, $sort_order, $status
        );
        $stmt->execute();

        header("Location: celebrities.php?success=1");
        exit;
    }
}

// =====================
// EDIT LOAD
// =====================
$edit = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $edit = $conn->query("SELECT * FROM celebrities WHERE id=$id")->fetch_assoc();
}

// =====================
// DELETE
// =====================
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];

    $img = $conn->query("SELECT image FROM celebrities WHERE id=$id")->fetch_assoc();
    if ($img && file_exists("../assets/images/celebs/".$img['image'])) {
        unlink("../assets/images/celebs/".$img['image']);
    }

    $conn->query("DELETE FROM celebrities WHERE id=$id");
    header("Location: celebrities.php?deleted=1");
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><?= $edit ? 'Edit Celebrity' : 'Add Celebrity' ?></h2>
</div>

<!-- ALERTS -->
<?php if(isset($_GET['success'])): ?><div class="alert alert-success">Celebrity added!</div><?php endif; ?>
<?php if(isset($_GET['updated'])): ?><div class="alert alert-info">Celebrity updated!</div><?php endif; ?>
<?php if(isset($_GET['deleted'])): ?><div class="alert alert-warning">Celebrity deleted!</div><?php endif; ?>

<!-- FORM -->
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data" class="row g-3">

            <input type="hidden" name="id" value="<?= $edit['id'] ?? '' ?>">
            <input type="hidden" name="old_image" value="<?= $edit['image'] ?? '' ?>">

            <div class="col-md-4">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required
                       value="<?= $edit['name'] ?? '' ?>">
            </div>

            <div class="col-md-4">
                <label>Designation</label>
                <input type="text" name="designation" class="form-control"
                       value="<?= $edit['designation'] ?? '' ?>">
            </div>

            <div class="col-md-4">
                <label>Image <?= $edit ? '(optional)' : '' ?></label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

            <div class="col-md-4">
                <label>Instagram URL</label>
                <input type="url" name="instagram" class="form-control"
                       value="<?= $edit['instagram'] ?? '' ?>">
            </div>

            <div class="col-md-4">
                <label>Website</label>
                <input type="url" name="website" class="form-control"
                       value="<?= $edit['website'] ?? '' ?>">
            </div>

            <div class="col-md-2">
                <label>Sort Order</label>
                <input type="number" name="sort_order" class="form-control"
                       value="<?= $edit['sort_order'] ?? 0 ?>">
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <div class="form-check">
                    <input type="checkbox" name="status" class="form-check-input"
                           <?= (!isset($edit) || $edit['status']) ? 'checked' : '' ?>>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

            <div class="col-12">
                <button name="save" class="btn btn-primary">
                    <i class="fa fa-save"></i> <?= $edit ? 'Update' : 'Save' ?>
                </button>
                <?php if($edit): ?>
                    <a href="celebrities.php" class="btn btn-secondary">Cancel</a>
                <?php endif; ?>
            </div>

        </form>
    </div>
</div>

<!-- LIST -->
<div class="card shadow-sm">
    <div class="card-body table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th width="140">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $data = $conn->query("SELECT * FROM celebrities ORDER BY sort_order ASC, id DESC");
                while($c = $data->fetch_assoc()):
                ?>
                <tr>
                    <td><img src="../assets/images/celebs/<?= $c['image'] ?>" height="60"></td>
                    <td><?= htmlspecialchars($c['name']) ?></td>
                    <td><?= htmlspecialchars($c['designation']) ?></td>
                    <td><?= $c['sort_order'] ?></td>
                    <td>
                        <span class="badge <?= $c['status'] ? 'bg-success' : 'bg-secondary' ?>">
                            <?= $c['status'] ? 'Active' : 'Inactive' ?>
                        </span>
                    </td>
                    <td>
                        <a href="?edit=<?= $c['id'] ?>" class="btn btn-sm btn-info">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="?delete=<?= $c['id'] ?>"
                           onclick="return confirm('Delete this celebrity?')"
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
