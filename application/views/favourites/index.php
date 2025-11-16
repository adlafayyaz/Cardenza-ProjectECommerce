<?php $this->load->view('layouts/header', ['title' => $title]); ?>
<div class="container my-5">
    <h2>My Favorites</h2>
    <div class="row mt-4">
        <?php if (!empty($items)) {
            foreach ($items as $item) { ?>
            <div class="col-sm-6 col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="<?php echo base_url('public/assets/images/'.$item->image); ?>" class="card-img-top" alt="<?php echo $item->name; ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo $item->name; ?></h5>
                        <p class="card-text text-muted">Rp <?php echo number_format($item->price, 0, ',', '.'); ?></p>
                        <div class="mt-auto d-flex justify-content-between">
                            <a href="<?php echo base_url('products/detail/'.$item->slug); ?>" class="btn btn-outline-primary btn-sm">View</a>
                            <a href="<?php echo base_url('favorites/toggle/'.$item->product_id); ?>" class="btn btn-outline-danger btn-sm"><span class="oi oi-trash"></span> Remove</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
            } else { ?>
            <p>You have no favorite products yet.</p>
        <?php } ?>
    </div>
</div>
<?php $this->load->view('layouts/footer'); ?>
