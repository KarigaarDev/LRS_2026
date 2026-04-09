<?php include 'db.php'; ?>
<?php include 'partials/header.php'; ?>

<div class="card">
<h2>Portfolio Items</h2>

<table width="100%" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Image</th>
    <th>Title</th>
    <th>Category</th>
    <th>Action</th>
</tr>

<?php
$data = $conn->query("SELECT * FROM portfolio ORDER BY id DESC");
while ($row = $data->fetch_assoc()):
?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><img src="../assets/images/portfolio/<?= $row['image'] ?>" width="80"></td>
    <td><?= $row['title'] ?></td>
    <td><?= $row['category'] ?></td>
    <td>
        <a href="?delete=<?= $row['id'] ?>">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>
</div>

<?php
if (isset($_GET['delete'])) {
    $conn->query("DELETE FROM portfolio WHERE id=".$_GET['delete']);
    header("Location: portfolio_list.php");
}
?>

<?php include 'partials/footer.php'; ?>
