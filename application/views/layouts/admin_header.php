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
    <style>
        .navbar-dark .navbar-nav .nav-link:hover {
            color: #ffffff !important;
        }
        .navbar-dark .navbar-nav .nav-link.active {
            color: #ffffff !important;
            font-weight: bold;
        }
    </style>
</head>
<body class="bg-light">

<!-- Navbar area admin -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow fixed-top">
    <div class="container-fluid px-4">

        <!-- Brand Admin -->
        <a class="navbar-brand d-flex align-items-center gap-2"
           href="<?php echo site_url('admin/dashboard'); ?>">
            <i class="bi bi-shield-lock-fill fs-4"></i>
            <span class="fw-bold">CARDENZA ADMIN</span>
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
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->uri->segment(2) == 'dashboard') ? 'active' : ''; ?>" 
                       href="<?php echo site_url('admin/dashboard'); ?>">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->uri->segment(2) == 'products') ? 'active' : ''; ?>" 
                       href="<?php echo site_url('admin/products'); ?>">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->uri->segment(2) == 'categories') ? 'active' : ''; ?>" 
                       href="<?php echo site_url('admin/categories'); ?>">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->uri->segment(2) == 'orders') ? 'active' : ''; ?>" 
                       href="<?php echo site_url('admin/orders'); ?>">Orders</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($this->uri->segment(2) == 'users') ? 'active' : ''; ?>" 
                       href="<?php echo site_url('admin/users'); ?>">Users</a>
                </li>
                
                <li class="nav-item ms-lg-3">
                    <div class="dropdown">
                        <a class="btn btn-outline-light dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle me-1"></i>
                            <?php echo htmlspecialchars($this->session->userdata('name') ?? 'Admin'); ?>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="<?php echo site_url('home'); ?>"><i class="bi bi-shop me-2"></i>View Store</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?php echo site_url('auth/logout'); ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Wrapper konten admin -->
<div class="container-fluid px-4" style="padding-top: 100px; padding-bottom: 40px;">
