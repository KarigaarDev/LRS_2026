<?php include 'db.php'; ?>
<?php include 'partials/header.php'; ?>

<?php
// SAVE (ADD / UPDATE)
if (isset($_POST['save'])) {

    $id = $_POST['id'] ?? null;
    $name = trim($_POST['name']);
    $designation = trim($_POST['designation']);
    $sort_order = (int)$_POST['sort_order'];
    $status = isset($_POST['status']) ? 1 : 0;

    $image = $_POST['old_image'] ?? '';

    if (!empty($_FILES['image']['name'])) {
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg','jpeg','png','webp'])) {
            $image = uniqid('team_').'.'.$ext;
            $path = "../assets/images/team/";
            if (!is_dir($path)) mkdir($path, 0777, true);
            move_uploaded_file($_FILES['image']['tmp_name'], $path.$image);

            if (!empty($_POST['old_image']) && file_exists($path.$_POST['old_image'])) {
                unlink($path.$_POST['old_image']);
            }
        }
    }

    if ($id) {
        $stmt = $conn->prepare("
            UPDATE team SET 
            name=?, designation=?, image=?, 
            sort_order=?, status=? WHERE id=?
        ");
        $stmt->bind_param("sssiii",
            $name,$designation,$image,$sort_order,$status,$id
        );
    } else {
        $stmt = $conn->prepare("
            INSERT INTO team (name, designation, image, sort_order, status)
            VALUES (?,?,?,?,?)
        ");
        $stmt->bind_param("sssii",
            $name,$designation,$image,$sort_order,$status
        );
    }

    $stmt->execute();
    header("Location: team.php");
    exit;
}

// EDIT
$edit = null;
if (isset($_GET['edit'])) {
    $edit = $conn->query("SELECT * FROM team WHERE id=".(int)$_GET['edit'])->fetch_assoc();
}

// DELETE
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $img = $conn->query("SELECT image FROM team WHERE id=$id")->fetch_assoc();
    if ($img && file_exists("../assets/images/team/".$img['image'])) {
        unlink("../assets/images/team/".$img['image']);
    }
    $conn->query("DELETE FROM team WHERE id=$id");
    header("Location: team.php");
    exit;
}
?>

<h2 class="mb-4"><?= $edit ? 'Edit Team Member' : 'Add Team Member' ?></h2>

<div class="card mb-4">
<form method="post" enctype="multipart/form-data" class="row g-3 p-3">
    <input type="hidden" name="id" value="<?= $edit['id'] ?? '' ?>">
    <input type="hidden" name="old_image" value="<?= $edit['image'] ?? '' ?>">

    <div class="col-md-4">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required value="<?= $edit['name'] ?? '' ?>">
    </div>

    <div class="col-md-4">
        <label>Designation</label>
        <input type="text" name="designation" class="form-control" required value="<?= $edit['designation'] ?? '' ?>">
    </div>

    <div class="col-md-4">
        <label>Image</label>
        <input type="file" name="image" class="form-control" <?= $edit ? '' : 'required' ?>>
    </div>

    <div class="col-md-2">
        <label>Sort Order</label>
        <input type="number" name="sort_order" class="form-control" value="<?= $edit['sort_order'] ?? 0 ?>">
    </div>

    <div class="col-md-2 d-flex align-items-end">
        <div class="form-check">
            <input type="checkbox" name="status" class="form-check-input" <?= (!isset($edit) || $edit['status']) ? 'checked' : '' ?>>
            <label class="form-check-label">Active</label>
        </div>
    </div>

    <div class="col-12">
        <button name="save" class="btn btn-primary">Save</button>
        <?php if($edit): ?><a href="team.php" class="btn btn-secondary">Cancel</a><?php endif; ?>
    </div>
</form>
</div>

<div class="card">
<table class="table align-middle">
<thead>
<tr>
    <th>Image</th><th>Name</th><th>Designation</th><th>Order</th><th>Status</th><th>Action</th>
</tr>
</thead>
<tbody>
<?php
$team = $conn->query("SELECT * FROM team ORDER BY sort_order ASC");
while($t = $team->fetch_assoc()):
?>
<tr>
    <td><img src="../assets/images/team/<?= $t['image'] ?>" height="60"></td>
    <td><?= htmlspecialchars($t['name']) ?></td>
    <td><?= htmlspecialchars($t['designation']) ?></td>
    <td><?= $t['sort_order'] ?></td>
    <td><?= $t['status'] ? 'Active' : 'Inactive' ?></td>
    <td>
        <a href="?edit=<?= $t['id'] ?>" class="btn btn-sm btn-info">Edit</a>
        <a href="?delete=<?= $t['id'] ?>" class="btn btn-sm btn-danger"
           onclick="return confirm('Delete?')">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>

<?php include 'partials/footer.php'; ?>
