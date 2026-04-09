<?php include 'db.php'; ?>
<?php include 'partials/header.php'; ?>

<?php
// =====================
// ADD SERVICE
// =====================
if (isset($_POST['add_service'])) {

    $title      = trim($_POST['title']);
    $bg_color   = $_POST['bg_color'];
    $sort_order = (int)$_POST['sort_order'];
    $status     = isset($_POST['status']) ? 1 : 0;

    $stmt = $conn->prepare(
        "INSERT INTO services (title, bg_color, sort_order, status)
         VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("ssii", $title, $bg_color, $sort_order, $status);
    $stmt->execute();

    header("Location: services.php?success=1");
    exit;
}

// =====================
// ADD SERVICE ITEM
// =====================
if (isset($_POST['add_item'])) {

    $service_id = (int)$_POST['service_id'];
    $item_name  = trim($_POST['item_name']);
    $sort_order = (int)$_POST['item_sort'];

    if ($item_name !== '') {
        $stmt = $conn->prepare(
            "INSERT INTO service_items (service_id, item_name, sort_order)
             VALUES (?, ?, ?)"
        );
        $stmt->bind_param("isi", $service_id, $item_name, $sort_order);
        $stmt->execute();
    }

    header("Location: services.php");
    exit;
}

// =====================
// DELETE SERVICE
// =====================
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM services WHERE id=$id");
    header("Location: services.php?deleted=1");
    exit;
}

// =====================
// DELETE SERVICE ITEM
// =====================
if (isset($_GET['delete_item'])) {
    $id = (int)$_GET['delete_item'];
    $conn->query("DELETE FROM service_items WHERE id=$id");
    header("Location: services.php");
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Services</h2>
</div>

<!-- ALERTS -->
<?php if(isset($_GET['success'])): ?>
<div class="alert alert-success">Service added successfully!</div>
<?php endif; ?>

<?php if(isset($_GET['deleted'])): ?>
<div class="alert alert-warning">Service deleted!</div>
<?php endif; ?>

<!-- ADD SERVICE FORM -->
<div class="card mb-4 shadow-sm">
    <div class="card-header fw-semibold">Add New Service</div>
    <div class="card-body">
        <form method="post" class="row g-3">

            <div class="col-md-4">
                <label class="form-label">Service Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="col-md-3">
                <label class="form-label">Background Color</label>
                <input type="color" name="bg_color" class="form-control" value="#1a7f86">
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
                <button name="add_service" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add Service
                </button>
            </div>

        </form>
    </div>
</div>

<!-- SERVICE LIST -->
<?php
$services = $conn->query(
    "SELECT * FROM services ORDER BY sort_order ASC, id DESC"
);
while($s = $services->fetch_assoc()):
?>

<div class="card mb-3 shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <span class="fw-semibold"><?= htmlspecialchars($s['title']) ?></span>
            <span class="badge ms-2"
                  style="background:<?= $s['bg_color'] ?>">&nbsp;</span>

            <?php if(!$s['status']): ?>
                <span class="badge bg-secondary ms-2">Inactive</span>
            <?php endif; ?>
        </div>

        <a href="?delete=<?= $s['id'] ?>"
           onclick="return confirm('Delete this service?')"
           class="btn btn-sm btn-danger">
            <i class="fa fa-trash"></i>
        </a>
    </div>

    <div class="card-body">

        <!-- SERVICE ITEMS -->
        <ul class="mb-3">
            <?php
            $items = $conn->query(
                "SELECT * FROM service_items
                 WHERE service_id={$s['id']}
                 ORDER BY sort_order ASC"
            );
            while($i = $items->fetch_assoc()):
            ?>
            <li class="d-flex justify-content-between align-items-center">
                <?= htmlspecialchars($i['item_name']) ?>
                <a href="?delete_item=<?= $i['id'] ?>"
                   onclick="return confirm('Delete this item?')"
                   class="text-danger small">
                   <i class="fa fa-times"></i>
                </a>
            </li>
            <?php endwhile; ?>
        </ul>

        <!-- ADD ITEM FORM -->
        <form method="post" class="d-flex gap-2">
            <input type="hidden" name="service_id" value="<?= $s['id'] ?>">

            <input type="text"
                   name="item_name"
                   class="form-control"
                   placeholder="Add service item"
                   required>

            <input type="number"
                   name="item_sort"
                   class="form-control"
                   value="0"
                   style="width:100px">

            <button name="add_item" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i>
            </button>
        </form>

    </div>
</div>

<?php endwhile; ?>

<?php include 'partials/footer.php'; ?>
