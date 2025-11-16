<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title.' – ' : ''; ?>Admin | E‑Shop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('public/assets/css/admin.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css">
</head>
<body>
<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-dark border-right" id="sidebar-wrapper">
        <div class="sidebar-heading text-white">Admin Panel</div>
        <div class="list-group list-group-flush">
            <a href="<?php echo base_url('admin/dashboard'); ?>" class="list-group-item list-group-item-action bg-dark text-white">Dashboard</a>
            <a href="<?php echo base_url('admin/products'); ?>" class="list-group-item list-group-item-action bg-dark text-white">Products</a>
            <a href="<?php echo base_url('admin/categories'); ?>" class="list-group-item list-group-item-action bg-dark text-white">Categories</a>
            <a href="<?php echo base_url('admin/orders'); ?>" class="list-group-item list-group-item-action bg-dark text-white">Orders</a>
            <a href="<?php echo base_url('admin/users'); ?>" class="list-group-item list-group-item-action bg-dark text-white">Users</a>
            <a href="<?php echo base_url('auth/logout'); ?>" class="list-group-item list-group-item-action bg-dark text-white">Logout</a>
        </div>
    </div>
    <!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>
            <span class="navbar-text ml-3">Welcome, <?php echo $this->session->userdata('name'); ?></span>
        </nav>
        <div class="container-fluid mt-4">
