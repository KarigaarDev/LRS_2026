<?php
include 'db.php';

/* ======================
   WEEKLY AUTO ROTATION
====================== */
$conn->query("
UPDATE homepage_stories
SET position = FLOOR(RAND()*100)
WHERE weekly_rotation=1
AND (last_rotated IS NULL OR last_rotated < CURDATE())
");

$conn->query("
UPDATE homepage_stories
SET last_rotated = CURDATE()
WHERE weekly_rotation=1
");
