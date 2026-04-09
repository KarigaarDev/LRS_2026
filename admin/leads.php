<?php
include 'db.php';

/* ======================
   UPDATE LEAD
====================== */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lead_id'])) {
    $id = (int)$_POST['lead_id'];
    $status = $conn->real_escape_string($_POST['status']);
    $remarks = $conn->real_escape_string($_POST['remarks']);

    $conn->query("
        UPDATE project_leads
        SET status='$status', remarks='$remarks'
        WHERE id=$id
    ");

    header("Location: leads.php?updated=1");
    exit;
}

/* ======================
   DELETE LEAD
====================== */
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM project_leads WHERE id=$id");
    header("Location: leads.php?deleted=1");
    exit;
}

/* ======================
   SEARCH & SORT
====================== */
$search = $_GET['search'] ?? '';
$allowedSort = ['id','name','service_type','status','created_at'];
$sort = in_array($_GET['sort'] ?? '', $allowedSort) ? $_GET['sort'] : 'id';

$where = $search
    ? "WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR phone LIKE '%$search%'"
    : "";

$data = $conn->query("
    SELECT * FROM project_leads
    $where
    ORDER BY $sort DESC
");

include 'partials/header.php';
?>

<h2 class="mb-4">Project Leads</h2>

<?php if(isset($_GET['updated'])): ?>
<div class="alert alert-success">Lead updated successfully.</div>
<?php endif; ?>

<?php if(isset($_GET['deleted'])): ?>
<div class="alert alert-warning">Lead deleted.</div>
<?php endif; ?>

<form class="mb-3">
    <input type="text" name="search" class="form-control"
           value="<?= htmlspecialchars($search) ?>"
           placeholder="Search name, email or phone">
</form>

<div class="card">
<div class="table-responsive">
<table class="table table-hover align-middle mb-0">

<thead class="table-light">
<tr>
    <th>#</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Service</th>
    <th>Status</th>
    <th>Date</th>
    <th width="120">Action</th>
</tr>
</thead>

<tbody>
<?php while($l = $data->fetch_assoc()): ?>
<tr>
    <td><?= $l['id'] ?></td>
    <td><?= htmlspecialchars($l['name']) ?></td>
    <td><?= htmlspecialchars($l['email']) ?></td>
    <td><?= htmlspecialchars($l['phone']) ?></td>
    <td><?= htmlspecialchars($l['service_type']) ?></td>
    <td><?= htmlspecialchars($l['status']) ?></td>
    <td><?= date('d M Y', strtotime($l['created_at'])) ?></td>
    <td>
        <button class="btn btn-sm btn-warning"
    data-id="<?= $l['id'] ?>"
    data-name="<?= htmlspecialchars($l['name']) ?>"
    data-business="<?= htmlspecialchars($l['business_name']) ?>"
    data-email="<?= htmlspecialchars($l['email']) ?>"
    data-phone="<?= htmlspecialchars($l['phone']) ?>"
    data-service="<?= htmlspecialchars($l['service_type']) ?>"
    data-time="<?= htmlspecialchars($l['preferred_time']) ?>"
    data-source="<?= htmlspecialchars($l['source_page']) ?>"
    data-ip="<?= htmlspecialchars($l['ip_address']) ?>"
    data-status="<?= htmlspecialchars($l['status']) ?>"
    data-remarks="<?= htmlspecialchars($l['remarks']) ?>"
    onclick="openEditModal(this)">
    <i class="fa fa-edit"></i>
</button>


        <a href="?delete=<?= $l['id'] ?>"
           class="btn btn-sm btn-danger"
           onclick="return confirm('Delete this lead?')">
            <i class="fa fa-trash"></i>
        </a>
    </td>
</tr>
<?php endwhile; ?>
</tbody>

</table>
</div>
</div>

<!-- ================= EDIT MODAL ================= -->
<div class="edit-modal" id="editModal">
    <div class="edit-backdrop" onclick="closeEditModal()"></div>

    <div class="edit-card">

        <h4 class="mb-3">Lead Details</h4>

        <!-- READ ONLY DETAILS -->
        <div class="mb-3">
            <p><b>Name:</b> <span id="m_name"></span></p>
            <p><b>Business:</b> <span id="m_business"></span></p>
            <p><b>Email:</b> <span id="m_email"></span></p>
            <p><b>Phone:</b> <span id="m_phone"></span></p>
            <p><b>Service:</b> <span id="m_service"></span></p>
            <p><b>Preferred Time:</b> <span id="m_time"></span></p>
            <p class="text-muted small">
                Source: <span id="m_source"></span> |
                IP: <span id="m_ip"></span>
            </p>
        </div>

        <hr>

        <!-- EDIT FORM -->
        <form method="POST">

            <input type="hidden" name="lead_id" id="edit_lead_id">

            <label class="fw-semibold">Status</label>
            <select name="status" id="edit_status" class="form-select mb-3">
                <option>New</option>
                <option>Contacted</option>
                <option>InProgress</option>
                <option>Closed</option>
                <option>Spam</option>
            </select>

            <label class="fw-semibold">Remarks</label>
            <textarea name="remarks" id="edit_remarks"
                      rows="4"
                      class="form-control mb-3"></textarea>

            <button type="submit" class="btn btn-primary w-100">
                <i class="fa fa-save me-1"></i> Save Changes
            </button>
        </form>

        <button class="edit-close" onclick="closeEditModal()">×</button>
    </div>
</div>


<style>
.edit-modal{
    position:fixed;
    inset:0;
    display:none;
    z-index:9999;
}
.edit-modal.active{
    display:flex;
    align-items:center;
    justify-content:center;
}
.edit-backdrop{
    position:absolute;
    inset:0;
    background:rgba(0,0,0,.45);
}
.edit-card{
    position:relative;
    width:480px;
    max-width:95%;
    background: var(--bs-body-bg);
    padding:22px;
    border-radius:12px;
    box-shadow:0 30px 70px rgba(0,0,0,.35);
    z-index:1;
}
.edit-close{
    position:absolute;
    top:12px;
    right:14px;
    border:none;
    background:none;
    font-size:26px;
    cursor:pointer;
}

@media(max-width:768px){
    .edit-card{width:calc(100% - 40px)}
}
</style>

<script>
function openEditModal(btn){

    edit_lead_id.value = btn.dataset.id;

    document.getElementById('m_name').innerText = btn.dataset.name;
    document.getElementById('m_business').innerText = btn.dataset.business;
    document.getElementById('m_email').innerText = btn.dataset.email;
    document.getElementById('m_phone').innerText = btn.dataset.phone;
    document.getElementById('m_service').innerText = btn.dataset.service;
    document.getElementById('m_time').innerText = btn.dataset.time;
    document.getElementById('m_source').innerText = btn.dataset.source;
    document.getElementById('m_ip').innerText = btn.dataset.ip;

    edit_status.value = btn.dataset.status;
    edit_remarks.value = btn.dataset.remarks;

    editModal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeEditModal(){
    editModal.classList.remove('active');
    document.body.style.overflow = '';
}
</script>


<?php include 'partials/footer.php'; ?>
