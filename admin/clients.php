<?php include 'db.php'; ?>
<?php include 'partials/header.php'; ?>

<?php
// =====================
// ADD CLIENT
// =====================
if (isset($_POST['add'])) {
    $name = trim($_POST['name']);

    if (!empty($_FILES['logo']['name'])) {
        $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
        $allowed = ['jpg','jpeg','png','webp'];

        if (in_array(strtolower($ext), $allowed)) {
            $logo = uniqid('client_') . '.' . $ext;
            $uploadPath = "../assets/images/clients/";

            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            move_uploaded_file($_FILES['logo']['tmp_name'], $uploadPath . $logo);

            $stmt = $conn->prepare("INSERT INTO clients (name, logo) VALUES (?, ?)");
            $stmt->bind_param("ss", $name, $logo);
            $stmt->execute();

            header("Location: clients.php?success=1");
            exit;
        }
    }
}

// =====================
// DELETE CLIENT
// =====================
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];

    // Remove image file
    $img = $conn->query("SELECT logo FROM clients WHERE id=$id")->fetch_assoc();
    if ($img && file_exists("../assets/images/clients/".$img['logo'])) {
        unlink("../assets/images/clients/".$img['logo']);
    }

    $conn->query("DELETE FROM clients WHERE id=$id");
    header("Location: clients.php?deleted=1");
    exit;
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
  <h2 class="mb-0">Clients</h2>
</div>

<!-- SUCCESS ALERT -->
<?php if(isset($_GET['success'])): ?>
<div class="alert alert-success">Client added successfully!</div>
<?php endif; ?>

<?php if(isset($_GET['deleted'])): ?>
<div class="alert alert-warning">Client deleted successfully!</div>
<?php endif; ?>

<!-- ADD CLIENT FORM -->
<div class="card mb-4 shadow-sm">
  <div class="card-header fw-semibold">Add New Client</div>
  <div class="card-body">
    <form method="post" enctype="multipart/form-data" class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Client Name</label>
        <input type="text" name="name" class="form-control" required>
      </div>

      <div class="col-md-6">
        <label class="form-label">Client Logo</label>
        <input type="file" name="logo" class="form-control" accept="image/*" required>
      </div>

      <div class="col-12">
        <button name="add" class="btn btn-primary">
          <i class="fa fa-plus"></i> Add Client
        </button>
      </div>
    </form>
  </div>
</div>

<!-- CLIENT LIST -->
<div class="card shadow-sm">
  <div class="card-header fw-semibold">Client List</div>
  <div class="card-body table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th width="120">Logo</th>
          <th>Name</th>
          <th width="120">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $data = $conn->query("SELECT * FROM clients ORDER BY id DESC");
        while($c = $data->fetch_assoc()):
        ?>
        <tr>
          <td>
            <img src="../assets/images/clients/<?= $c['logo'] ?>"
                 class="img-thumbnail"
                 style="max-height:60px;">
          </td>
          <td class="fw-semibold"><?= htmlspecialchars($c['name']) ?></td>
          <td>
            <a href="?delete=<?= $c['id'] ?>"
               onclick="return confirm('Delete this client?')"
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
