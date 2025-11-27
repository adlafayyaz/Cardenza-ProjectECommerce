<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo isset($title) ? $title.' | ' : ''; ?>Cardenza</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          crossorigin="anonymous">

    <!-- Bootstrap icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('public/assets/css/main.css'); ?>">

    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
</head>
<body class="bg-light">

<!-- Navbar utama -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container px-5">

        <!-- Logo / brand -->
        <a class="navbar-brand header-brand" href="<?php echo site_url('home'); ?>">
            CARDENZA
        </a>

        <!-- Toggle mobile -->
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar"
                aria-controls="mainNavbar"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu utama -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('home'); ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('products'); ?>">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo site_url('about'); ?>">About</a>
                </li>
            </ul>

            <!-- Ikon cart, favorites, akun -->
            <div class="d-flex align-items-center gap-3">

                <!-- Cart icon -->
                <a href="<?php echo site_url('cart'); ?>" class="text-decoration-none text-dark position-relative d-flex align-items-center">
                    <i class="bi bi-cart3 fs-5"></i>
                    <?php if (!empty($cart_count)) { ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success" style="font-size: 0.6rem;">
                            <?php echo $cart_count; ?>
                        </span>
                    <?php } ?>
                </a>

                <!-- Favorites icon -->
                <a href="<?php echo site_url('favorites'); ?>" class="text-decoration-none text-dark d-flex align-items-center"> 
                    <i class="bi bi-heart fs-5"></i>
                </a>

                <!-- Logic user login -->
                <?php if (!empty($current_user)) { ?>

                    <!-- Shortcut admin dashboard -->
                    <?php if (isset($current_user['role']) && $current_user['role'] === 'admin') { ?>
                        <a href="<?php echo site_url('admin/dashboard'); ?>" class="text-decoration-none text-dark d-flex align-items-center" title="Admin Dashboard">
                            <i class="bi bi-speedometer2 fs-5"></i>
                        </a>
                    <?php } ?>

                    <!-- Link ke halaman akun -->
                    <a href="<?php echo site_url('account'); ?>" class="text-decoration-none text-dark d-flex align-items-center">
                        <i class="bi bi-person fs-5 me-1"></i>
                        <span class="fw-medium"><?php echo htmlspecialchars($current_user['name']); ?></span>
                    </a>

                    <!-- Tombol logout -->
                    <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-sm btn-outline-danger ms-2">
                        Logout
                    </a>

                <?php } else { ?>
                    <!-- Tombol login kalau belum login -->
                    <a href="<?php echo site_url('auth/login'); ?>" class="btn btn-sm btn-outline-dark ms-2">
                        Login
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>

<!-- Wrapper konten utama -->
<div class="container-fluid px-0">
