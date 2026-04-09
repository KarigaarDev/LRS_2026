<?php
// Prevent direct access
if (!defined('APP_START')) {
    die('No direct access allowed');
}

/**
 * BASE URL
 * Works on:
 * - localhost
 * - live server
 * - subfolders
 */
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'];
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));

define('BASE_URL', rtrim($protocol . '://' . $host . $scriptDir, '/') . '/');

/**
 * Asset helper
 */
function asset($path)
{
    return BASE_URL . ltrim($path, '/');
}
