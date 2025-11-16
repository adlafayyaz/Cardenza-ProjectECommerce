<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo isset($title) ? $title.' | ' : ''; ?>E-shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('public/assets/css/main.css'); ?>">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg bg-white shadow-sm">
    <div class="container-fluid px-5">

        <!-- Logo -->
        <a class="navbar-brand fw-bold" href="<?php echo site_url('home'); ?>">
            E-Shop
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

        <!-- Menu -->
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

            <div class="d-flex align-items-center gap-3">
                <a href="<?php echo site_url('cart'); ?>" class="text-decoration-none position-relative">
                    <i class="bi bi-cart3 fs-5"></i>
                    <?php if (!empty($cart_count)) { ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                            <?php echo $cart_count; ?>
                        </span>
                    <?php } ?>
                </a>

                <a href="<?php echo site_url('favorites'); ?>" class="text-decoration-none">
                    <i class="bi bi-heart fs-5"></i>
                </a>

                <?php if (!empty($current_user)) { ?>
                    <?php if ($current_user['role'] === 'admin') { ?>
                        <a href="<?php echo site_url('admin/dashboard'); ?>" class="text-decoration-none">
                            <i class="bi bi-speedometer2 fs-5"></i>
                        </a>
                    <?php } ?>

                    <a href="<?php echo site_url('account'); ?>" class="text-decoration-none">
                        <i class="bi bi-person fs-5 me-1"></i> <?php echo htmlspecialchars($current_user['name']); ?>
                    </a>

                    <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-sm btn-outline-danger">
                        Logout
                    </a>
                <?php } else { ?>
                    <a href="<?php echo site_url('auth/login'); ?>" class="btn btn-sm btn-outline-dark">
                        Login
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid px-0">
