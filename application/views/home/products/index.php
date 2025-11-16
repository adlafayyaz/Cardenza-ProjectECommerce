<?php $this->load->view('layouts/header', ['title' => $title]); ?>
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Products</h2>
        <!-- Filter kategori -->
        <form method="get" class="form-inline">
            <select name="category" class="form-control mr-2" onchange="this.form.submit()">
                <option value="">All Categories</option>
                <?php foreach ($categories as $cat) { ?>
                    <option value="<?php echo $cat->slug; ?>" <?php echo ($selected == $cat->slug) ? 'selected' : ''; ?>><?php echo $cat->name; ?></option>
                <?php } ?>
            </select>
            <noscript><button type="submit" class="btn btn-primary">Filter</button></noscript>
        </form>
    </div>
    <div class="row">
        <?php if (!empty($products)) {
            foreach ($products as $product) { ?>
            <div class="col-sm-6 col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?php echo base_url('public/assets/images/'.$product->image); ?>" class="card-img-top" alt="<?php echo $product->name; ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo $product->name; ?></h5>
                        <p class="card-text text-muted">Rp <?php echo number_format($product->price, 0, ',', '.'); ?></p>
                        <div class="mt-auto d-flex justify-content-between">
                            <a href="<?php echo base_url('products/detail/'.$product->slug); ?>" class="btn btn-outline-primary btn-sm">Detail</a>
                            <a href="<?php echo base_url('favorites/toggle/'.$product->id); ?>" class="btn btn-outline-danger btn-sm"><span class="oi oi-heart"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
            } else { ?>
            <p>No products available.</p>
        <?php } ?>
    </div>
</div>
<?php $this->load->view('layouts/footer'); ?>
