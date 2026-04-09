<?php include 'db.php'; ?>
<?php include 'partials/header.php'; ?>

<?php
// =====================
// ADD / UPDATE PORTFOLIO
// =====================
if (isset($_POST['save'])) {

    $id          = $_POST['id'] ?? null;
    $title       = trim($_POST['title']);
    $slug        = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
    $category    = trim($_POST['category']);
    $description = trim($_POST['description']);
    $tags        = trim($_POST['tags']);

    $seo_title = trim($_POST['seo_title']);
    $seo_desc  = trim($_POST['seo_description']);
    $seo_keys  = trim($_POST['seo_keywords']);

    $sort_order = (int)($_POST['sort_order'] ?? 0);
    $status = isset($_POST['status']) ? 1 : 0;

    $image = $_POST['old_image'] ?? null;

    // IMAGE UPLOAD
    if (!empty($_FILES['image']['name'])) {

        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','webp'];

        if (in_array($ext, $allowed)) {

            $uploadPath = "../assets/images/portfolio/";
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            $image = uniqid('portfolio_') . '.' . $ext;
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
            "UPDATE portfolio SET 
                title=?, slug=?, category=?, description=?, image=?, tags=?,
                seo_title=?, seo_description=?, seo_keywords=?,
                status=?, sort_order=?
             WHERE id=?"
        );

        $stmt->bind_param(
            "ssssssssiiii",
            $title, $slug, $category, $description, $image, $tags,
            $seo_title, $seo_desc, $seo_keys,
            $status, $sort_order, $id
        );
        $stmt->execute();

        header("Location: portfolio.php?updated=1");
        exit;

    } else {
        // INSERT
        $stmt = $conn->prepare(
            "INSERT INTO portfolio
            (title, slug, category, description, image, tags,
             seo_title, seo_description, seo_keywords, status, sort_order)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );

        $stmt->bind_param(
            "ssssssssiii",
            $title, $slug, $category, $description, $image, $tags,
            $seo_title, $seo_desc, $seo_keys,
            $status, $sort_order
        );
        $stmt->execute();

        header("Location: portfolio.php?success=1");
        exit;
    }
}

// =====================
// EDIT LOAD
// =====================
$edit = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $edit = $conn->query("SELECT * FROM portfolio WHERE id=$id")->fetch_assoc();
}
?>

<h2 class="mb-4"><?= $edit ? 'Edit Portfolio' : 'Add Portfolio' ?></h2>

<?php if(isset($_GET['success'])): ?><div class="alert alert-success">Portfolio added!</div><?php endif; ?>
<?php if(isset($_GET['updated'])): ?><div class="alert alert-info">Portfolio updated!</div><?php endif; ?>

<!-- FORM -->
<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data" class="row g-3">

            <input type="hidden" name="id" value="<?= $edit['id'] ?? '' ?>">
            <input type="hidden" name="old_image" value="<?= $edit['image'] ?? '' ?>">

            <div class="col-md-6">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required
                       value="<?= $edit['title'] ?? '' ?>">
            </div>

            <div class="col-md-6">
                <label>Category</label>
                <select name="category" class="form-control">
                    <?php
                    $cats = ['social','print','logo','menu'];
                    foreach ($cats as $cat):
                    ?>
                        <option value="<?= $cat ?>"
                            <?= (isset($edit) && $edit['category']==$cat) ? 'selected' : '' ?>>
                            <?= ucfirst($cat) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-12">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="4"><?= $edit['description'] ?? '' ?></textarea>
            </div>

            <div class="col-md-6">
                <label>Tags</label>
                <input type="text" name="tags" class="form-control"
                       value="<?= $edit['tags'] ?? '' ?>">
            </div>

            <div class="col-md-6">
                <label>Image <?= $edit ? '(optional)' : '' ?></label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

            <!-- SEO -->
            <div class="col-md-6">
                <label>SEO Title</label>
                <input type="text" name="seo_title" class="form-control"
                       value="<?= $edit['seo_title'] ?? '' ?>">
            </div>

            <div class="col-md-6">
                <label>SEO Keywords</label>
                <input type="text" name="seo_keywords" class="form-control"
                       value="<?= $edit['seo_keywords'] ?? '' ?>">
            </div>

            <div class="col-md-12">
                <label>SEO Description</label>
                <textarea name="seo_description" class="form-control" rows="2"><?= $edit['seo_description'] ?? '' ?></textarea>
            </div>

            <div class="col-md-2">
                <label>Sort Order</label>
                <input type="number" name="sort_order" class="form-control"
                       value="<?= $edit['sort_order'] ?? 0 ?>">
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <div class="form-check">
                    <input type="checkbox" name="status" class="form-check-input"
                        <?= (!isset($edit) || $edit['status']) ? 1 : 0 ?>>
                    <label class="form-check-label">Active</label>
                </div>
            </div>

            <div class="col-12">
                <button name="save" class="btn btn-primary">
                    <i class="fa fa-save"></i> <?= $edit ? 'Update' : 'Save' ?>
                </button>
                <?php if($edit): ?>
                    <a href="portfolio.php" class="btn btn-secondary">Cancel</a>
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
                    <th>Title</th>
                    <th>Category</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th width="120">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $list = $conn->query("SELECT * FROM portfolio ORDER BY sort_order ASC, id DESC");
                while($p = $list->fetch_assoc()):
                ?>
                <tr>
                    <td><img src="../assets/images/portfolio/<?= $p['image'] ?>" height="60"></td>
                    <td><?= htmlspecialchars($p['title']) ?></td>
                    <td><?= ucfirst($p['category']) ?></td>
                    <td><?= $p['sort_order'] ?></td>
                    <td>
                        <span class="badge <?= $p['status'] ? 'bg-success' : 'bg-secondary' ?>">
                            <?= $p['status'] ? 'Active' : 'Inactive' ?>
                        </span>
                    </td>
                    <td>
                        <a href="?edit=<?= $p['id'] ?>" class="btn btn-sm btn-info">
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'partials/footer.php'; ?>
