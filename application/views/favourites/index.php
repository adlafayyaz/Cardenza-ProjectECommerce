<!-- Halaman My Favorites -->
<div class="container my-5">
    <h2 class="mb-4">My Favorites</h2>

    <?php if (!empty($items)) { ?>
        <div class="row g-4">
            <?php foreach ($items as $item) {
                $name = htmlspecialchars($item['name']);
                $slug = htmlspecialchars($item['slug']);
                $price = (int) $item['price'];
                $image = !empty($item['image']) ? $item['image'] : 'placeholder.jpg';
                ?>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <!-- Card produk favorit -->
                    <div class="card h-100 shadow-sm border-0">
                        <img
                            src="<?php echo base_url('public/assets/images/'.$image); ?>"
                            class="card-img-top"
                            alt="<?php echo $name; ?>"
                            style="height: 200px; object-fit: cover;"
                        >
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-1"><?php echo $name; ?></h5>
                            <p class="card-text text-muted mb-3">
                                Rp <?php echo number_format($price, 0, ',', '.'); ?>
                            </p>
                            <div class="mt-auto d-flex justify-content-between gap-2">
                                <a href="<?php echo base_url('products/detail/'.$slug); ?>"
                                   class="btn btn-outline-primary btn-sm">
                                    View
                                </a>
                                <a href="<?php echo base_url('favorites/toggle/'.$item['product_id']); ?>"
                                   class="btn btn-outline-danger btn-sm">
                                    Remove
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <p>You have no favorite products yet.</p>
    <?php } ?>
</div>
