<?php
include 'db.php';

if (!isset($_POST['id'])) exit;

$id = (int)$_POST['id'];
$conn->query("UPDATE homepage_stories SET clicks = clicks + 1 WHERE wp_post_id=$id");
