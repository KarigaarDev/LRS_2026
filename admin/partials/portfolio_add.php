<?php include 'db.php'; ?>
<?php include 'partials/header.php'; ?>

<?php
if ($_POST) {
    $title = $_POST['title'];
    $cat = $_POST['category'];

    $img = time() . $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'],
        "../assets/images/portfolio/$img");

    $conn->query("INSERT INTO portfolio (title,category,image)
                  VALUES ('$title','$cat','$img')");
}
?>

<div class="card">
<h2>Add Portfolio</h2>

<form method="post" enctype="multipart/form-data">
    <input name="title" placeholder="Title" required><br><br>

    <select name="category">
        <option value="branding">Branding</option>
        <option value="design">Design</option>
        <option value="video">Video</option>
    </select><br><br>

    <input type="file" name="image" required><br><br>
    <button>Add Portfolio</button>
</form>
</div>

<?php include 'partials/footer.php'; ?>
