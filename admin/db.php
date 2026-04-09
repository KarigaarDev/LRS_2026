<?php
declare(strict_types=1);

/**
 * ----------------------------------------------------
 * Session Init (Safe)
 * ----------------------------------------------------
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * ----------------------------------------------------
 * Database Configuration
 * ----------------------------------------------------
 */
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "livingroom_db";
 /* ----------------------------------------------------
 * Database Configuration
 * ----------------------------------------------------
 */
$dbHost2 = "localhost";
$dbUser2 = "u970188659_LRS";
$dbPass2 = "Kolkata1237";
$dbName2 = "u970188659_LRS";
/**
 * ----------------------------------------------------
 * Database Connection
 * ----------------------------------------------------
 */
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
// $conn = new mysqli($dbHost2, $dbUser2, $dbPass2, $dbName2);

/* Handle Connection Error */
if ($conn->connect_errno) {
    error_log("DB Connection Failed: " . $conn->connect_error);
    die("Service temporarily unavailable.");
}

/**
 * ----------------------------------------------------
 * Charset (IMPORTANT)
 * ----------------------------------------------------
 */
$conn->set_charset("utf8mb4");
