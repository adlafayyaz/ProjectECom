<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo isset($title) ? $title.' | ' : ''; ?>Admin – Cardenza</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Global styles (front) -->
    <link rel="stylesheet" href="<?php echo base_url('public/assets/css/main.css'); ?>">

    <!-- Admin specific styles -->
    <link rel="stylesheet" href="<?php echo base_url('public/assets/css/admin.css'); ?>">
</head>
<body class="bg-light">

<!-- Navbar area admin -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container px-5">

        <!-- Brand Admin -->
        <a class="navbar-brand header-brand d-flex align-items-baseline"
           href="<?php echo site_url('admin/dashboard'); ?>">
            <span>CARDENZA</span>
            <span class="admin-badge ms-2">Admin</span>
        </a>

        <!-- Toggle mobile -->
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#adminNavbar"
                aria-controls="adminNavbar"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu admin -->
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav ms-4 me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('admin/products'); ?>">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('admin/categories'); ?>">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('admin/orders'); ?>">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('admin/users'); ?>">Users</a>
                </li>
            </ul>

            <!-- Info admin + tombol -->
            <div class="d-flex align-items-center gap-3">
                <?php $adminName = $this->session->userdata('name'); ?>
                <?php if (!empty($adminName)) { ?>
                    <span class="text-muted">
                        Hi, <?php echo htmlspecialchars($adminName); ?>
                    </span>
                <?php } ?>

                <a href="<?php echo site_url('auth/logout'); ?>"
                   class="btn admin-btn btn-danger text-white">
                    Logout
                </a>

                <a href="<?php echo site_url('home'); ?>"
                   class="btn admin-btn btn-secondary text-white">
                    Back to Store
                </a>
            </div>
        </div>
    </div>
</nav>

<!-- Wrapper konten admin -->
<div class="container-fluid px-5" style="padding-top: 90px;">
