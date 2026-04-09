<?php
session_start();
include '../db.php';
include 'partials/header.php';

// 🔐 BASIC AUTH CHECK
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

/* ==========================
   SAVE (ADD / UPDATE USER)
========================== */
if (isset($_POST['save_user'])) {

    $id       = $_POST['id'] ?? null;
    $username = trim($_POST['username']);
    $role     = $_POST['role'];
    $active   = isset($_POST['is_active']) ? 1 : 0;
    $password = $_POST['password'] ?? '';

    if ($id) {
        // UPDATE
        if (!empty($password)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("
                UPDATE users 
                SET username=?, password=?, role=?, is_active=? 
                WHERE id=?
            ");
            $stmt->bind_param("sssii", $username, $hash, $role, $active, $id);
        } else {
            $stmt = $conn->prepare("
                UPDATE users 
                SET username=?, role=?, is_active=? 
                WHERE id=?
            ");
            $stmt->bind_param("ssii", $username, $role, $active, $id);
        }
    } else {
        // INSERT
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("
            INSERT INTO users (username, password, role, is_active)
            VALUES (?,?,?,?)
        ");
        $stmt->bind_param("sssi", $username, $hash, $role, $active);
    }

    $stmt->execute();
    header("Location: users.php");
    exit;
}

/* ==========================
   DELETE USER
========================== */
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM users WHERE id=$id");
    header("Location: users.php");
    exit;
}

/* ==========================
   EDIT USER
========================== */
$editUser = null;
if (isset($_GET['edit'])) {
    $id = (int)$_GET['edit'];
    $editUser = $conn->query("SELECT * FROM users WHERE id=$id")->fetch_assoc();
}

/* ==========================
   FETCH USERS
========================== */
$users = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>

<h2 class="mb-4">Users Management</h2>

<!-- ================= ADD / EDIT FORM ================= -->
<div class="card mb-4">
<form method="post" class="row g-3 p-3">
    <input type="hidden" name="id" value="<?= $editUser['id'] ?? '' ?>">

    <div class="col-md-4">
        <label class="form-label">Username</label>
        <input type="text"
               name="username"
               class="form-control"
               required
               value="<?= htmlspecialchars($editUser['username'] ?? '') ?>">
    </div>

    <div class="col-md-4">
        <label class="form-label">
            Password <?= $editUser ? '(leave blank to keep)' : '' ?>
        </label>
        <input type="password"
               name="password"
               class="form-control"
               <?= $editUser ? '' : 'required' ?>>
    </div>

    <div class="col-md-2">
        <label class="form-label">Role</label>
        <select name="role" class="form-select">
            <option value="admin" <?= (($editUser['role'] ?? '') === 'admin') ? 'selected' : '' ?>>Admin</option>
            <option value="editor" <?= (($editUser['role'] ?? '') === 'editor') ? 'selected' : '' ?>>Editor</option>
        </select>
    </div>

    <div class="col-md-2 d-flex align-items-end">
        <div class="form-check form-switch">
            <input class="form-check-input"
                   type="checkbox"
                   name="is_active"
                   <?= (!isset($editUser) || ($editUser['is_active'] ?? 1)) ? 'checked' : '' ?>>
            <label class="form-check-label">Active</label>
        </div>
    </div>

    <div class="col-12">
        <button name="save_user" class="btn btn-primary">
            <?= $editUser ? 'Update User' : 'Add User' ?>
        </button>
        <?php if ($editUser): ?>
            <a href="users.php" class="btn btn-secondary">Cancel</a>
        <?php endif; ?>
    </div>
</form>
</div>

<!-- ================= USERS LIST ================= -->
<div class="card">
<table class="table align-middle mb-0">
<thead>
<tr>
    <th>ID</th>
    <th>Username</th>
    <th>Role</th>
    <th>Status</th>
    <th>Created</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
<?php while ($u = $users->fetch_assoc()): ?>
<tr>
    <td><?= $u['id'] ?></td>
    <td><?= htmlspecialchars($u['username']) ?></td>
    <td>
        <span class="badge bg-info text-dark">
            <?= ucfirst($u['role']) ?>
        </span>
    </td>
    <td>
        <?= $u['is_active']
            ? '<span class="badge bg-success">Active</span>'
            : '<span class="badge bg-secondary">Inactive</span>' ?>
    </td>
    <td><?= date('d M Y', strtotime($u['created_at'])) ?></td>
    <td>
        <a href="?edit=<?= $u['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
        <a href="?delete=<?= $u['id'] ?>"
           class="btn btn-sm btn-danger"
           onclick="return confirm('Delete this user?')">
           Delete
        </a>
    </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>

<?php include 'partials/footer.php'; ?>
