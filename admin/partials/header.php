<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<link rel="shortcut icon" href="assets/images/logo-thumb.png">
<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- Custom CSS -->
<link rel="stylesheet" href="assets/css/admin.css">
</head>

<body data-bs-theme="dark">

<div class="container-fluid">
  <div class="row min-vh-100">

    <!-- SIDEBAR -->
    <aside class="col-auto sidebar px-3 py-4" style="color: var(--bs-body-color)">
      <h5 class="mb-4" style="color: var(--bs-theme-color)">LivingRoomStoriez</h5>

      <nav class="nav flex-column gap-1">
        <a class="nav-link" href="dashboard.php" style="color: var(--bs-body-color)"><i class="fa fa-home me-2"></i>Dashboard</a>
        <a class="nav-link" href="site-analytics.php" style="color: var(--bs-body-color)"><i class="fa fa-chart-line me-2"></i>Site Analytics</a>
        <!-- <a class="nav-link" href="heroSection.php" style="color: var(--bs-body-color)"><i class="fa fa-image me-2"></i>HeroSection</a> -->
        <a class="nav-link" href="services.php" style="color: var(--bs-body-color)"><i class="fa fa-briefcase me-2"></i>Services</a>
        <a class="nav-link" href="portfolio.php" style="color: var(--bs-body-color)"><i class="fa fa-briefcase me-2"></i>Portfolio</a>
        <a class="nav-link" href="clients.php" style="color: var(--bs-body-color)"><i class="fa fa-users me-2"></i>Clients</a>
        <a class="nav-link" href="celebrities.php" style="color: var(--bs-body-color)"><i class="fa fa-star me-2"></i>Celebrities</a>
        <a class="nav-link" href="reviews.php" style="color: var(--bs-body-color)"><i class="fa fa-star me-2"></i>Reviews</a>
        <a class="nav-link" href="shorts_reels.php" style="color: var(--bs-body-color)"><i class="fa fa-video me-2"></i>Shorts & Reels</a>
        <a class="nav-link" href="team.php" style="color: var(--bs-body-color)"><i class="fa fa-users-gear me-2"></i>Team</a>
        <a class="nav-link" href="stories.php" style="color: var(--bs-body-color)"><i class="fa fa-pen-nib me-2"></i>Blogs</a>
        <a class="nav-link" href="leads.php" style="color: var(--bs-body-color)"><i class="fa fa-address-book me-2"></i>Project Leads</a>
        <!-- <a class="nav-link" href="users.php" style="color: var(--bs-body-color)"><i class="fa fa-user me-2"></i>Users</a> -->
        <a class="nav-link" href="settings.php" style="color: var(--bs-body-color)"><i class="fa fa-gear me-2"></i>Settings</a>
        <a class="nav-link text-danger" href="logout.php" style="color: var(--bs-theme-color)"><i class="fa fa-right-from-bracket me-2"></i>Logout</a>
      </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="col px-4 py-4 overflow-hidden" style="background-color: var(--bs-body-bg)">
    
<button id="themeToggle" class="btn btn-sm btn-outline-light position-absolute top-0 end-0 mt-2 me-2 text-dark bg-light">
  <i class="fa-solid fa-moon"></i> Dark Mode
</button>
