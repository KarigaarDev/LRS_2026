<?php
$conn = new mysqli("localhost", "root", "", "livingroom_db");
// $conn = new mysqli("localhost", "u970188659_LRS", "Kolkata1237", "u970188659_LRS");
if ($conn->connect_error) {
    die("Database connection failed");
}
?>
