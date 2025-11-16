<?php $this->load->view('layouts/header', ['title' => $product->name]); ?>
<div class="container my-5">
    <div class="row">
        <!-- Gambar besar -->
        <div class="col-md-6 mb-4">
            <img src="<?php echo base_url('public/assets/images/'.$product->image); ?>" class="img-fluid rounded shadow" alt="<?php echo $product->name; ?>">
        </div>
        <!-- Detail produk -->
        <div class="col-md-6">
            <h2><?php echo $product->name; ?></h2>
            <p class="text-muted">Category: <?php echo $product->category_name; ?></p>
            <h4 class="text-primary">Rp <?php echo number_format($product->price, 0, ',', '.'); ?></h4>
            <p><?php echo nl2br(htmlspecialchars($product->description)); ?></p>
            <p>Stock: <?php echo $product->stock; ?></p>
            <div class="d-flex mt-4">
                <a href="<?php echo base_url('cart/add/'.$product->id); ?>" class="btn btn-accent mr-3">Add to Cart</a>
                <a href="<?php echo base_url('favorites/toggle/'.$product->id); ?>" class="btn btn-outline-danger"><span class="oi oi-heart"></span> Favorite</a>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layouts/footer'); ?>
