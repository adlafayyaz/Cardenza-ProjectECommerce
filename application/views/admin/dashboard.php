<?php $this->load->view('layouts/admin_header', ['title' => $title]); ?>
<h2>Dashboard</h2>
<div class="row mt-4">
    <div class="col-sm-6 col-lg-3 mb-4">
        <div class="card text-white bg-primary h-100">
            <div class="card-body">
                <h5 class="card-title">Products</h5>
                <p class="card-text display-4"><?php echo $product_count; ?></p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-4">
        <div class="card text-white bg-success h-100">
            <div class="card-body">
                <h5 class="card-title">Categories</h5>
                <p class="card-text display-4"><?php echo $category_count; ?></p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-4">
        <div class="card text-white bg-warning h-100">
            <div class="card-body">
                <h5 class="card-title">Orders</h5>
                <p class="card-text display-4"><?php echo $order_count; ?></p>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3 mb-4">
        <div class="card text-white bg-danger h-100">
            <div class="card-body">
                <h5 class="card-title">Users</h5>
                <p class="card-text display-4"><?php echo $user_count; ?></p>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layouts/admin_footer'); ?>
