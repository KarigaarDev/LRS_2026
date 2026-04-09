<?php
// includes/settings.php

if (!isset($conn)) {
    die('DB connection missing');
}

$SETTINGS = $conn
    ->query("SELECT * FROM site_settings WHERE id = 1 LIMIT 1")
    ->fetch_assoc();

if (!$SETTINGS) {
    die('Site settings not found');
}

/* ==========================
   GLOBAL HELPER FUNCTIONS
========================== */

function setting($key, $default = null) {
    global $SETTINGS;
    return $SETTINGS[$key] ?? $default;
}

function is_enabled($key) {
    return setting($key) == 1;
}
