<!-- Halaman dashboard admin -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800">Dashboard</h2>
</div>

<div class="row">
    <!-- Card jumlah produk -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100 py-2 border-start border-4 border-primary">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Products</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $product_count; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-box-seam fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card jumlah kategori -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100 py-2 border-start border-4 border-success">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Categories</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $category_count; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-tags fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card jumlah orders -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100 py-2 border-start border-4 border-warning">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Orders</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $order_count; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-cart fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card jumlah users -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-0 shadow-sm h-100 py-2 border-start border-4 border-danger">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Users</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $user_count; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="bi bi-people fs-2 text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header py-3 bg-white d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-dark">Quick Actions</h6>
            </div>
            <div class="card-body">
                <a href="<?php echo site_url('admin/products/create'); ?>" class="btn btn-primary btn-icon-split me-2 shadow-sm">
                    <span class="icon text-white-50">
                        <i class="bi bi-plus-lg"></i>
                    </span>
                    <span class="text">Add Product</span>
                </a>
                <a href="<?php echo site_url('admin/categories/create'); ?>" class="btn btn-success btn-icon-split me-2 shadow-sm">
                    <span class="icon text-white-50">
                        <i class="bi bi-plus-lg"></i>
                    </span>
                    <span class="text">Add Category</span>
                </a>
                <a href="<?php echo site_url('admin/orders'); ?>" class="btn btn-info btn-icon-split shadow-sm text-white">
                    <span class="icon text-white-50">
                        <i class="bi bi-list-check"></i>
                    </span>
                    <span class="text">Manage Orders</span>
                </a>
            </div>
        </div>
    </div>
</div>
