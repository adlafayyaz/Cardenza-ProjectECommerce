<div class="container py-5">
    <?php if (!empty($product)) { ?>
        <div class="row">
            <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <img
                    src="<?php echo base_url('public/assets/images/'.($product['image'] ?? 'placeholder.jpg')); ?>"
                    class="card-img-top"
                    alt="<?php echo htmlspecialchars($product['name'] ?? 'Product'); ?>"
                >
            </div>
            </div>

            <div class="col-md-6">
                <h1 class="h3 mb-2">
                    <?php echo htmlspecialchars($product['name'] ?? ''); ?>
                </h1>

                <?php if (!empty($product['category_name'])) { ?>
                    <p class="text-muted mb-1">
                        Kategori: <?php echo htmlspecialchars($product['category_name']); ?>
                    </p>
                <?php } ?>

                <p class="h4 text-success mb-3">
                    Rp <?php echo number_format($product['price'] ?? 0, 0, ',', '.'); ?>
                </p>

                <p class="mb-2">
                    Stok:
                    <?php if (($product['stock'] ?? 0) > 0) { ?>
                        <span class="text-success fw-bold"><?php echo (int) $product['stock']; ?></span>
                    <?php } else { ?>
                        <span class="text-danger fw-bold">Habis</span>
                    <?php } ?>
                </p>

                <?php if (!empty($product['description'])) { ?>
                    <p class="mb-4">
                        <?php echo nl2br(htmlspecialchars($product['description'])); ?>
                    </p>
                <?php } ?>

                <div class="d-flex gap-3 mb-3">
                    <button
                        class="btn btn-success add-to-cart"
                        data-product-id="<?php echo $product['id']; ?>"
                        <?php echo (($product['stock'] ?? 0) <= 0) ? 'disabled' : ''; ?>
                    >
                        <i class="bi bi-cart-plus"></i> Add to Cart
                    </button>

                    <button
                        class="btn btn-outline-danger toggle-favorite"
                        data-product-id="<?php echo $product['id']; ?>">
                        <i class="bi bi-heart"></i> Add to Favorites
                    </button>
                </div>

                <a href="<?php echo site_url('products'); ?>" class="btn btn-link">
                    &larr; Kembali ke daftar produk
                </a>
            </div>
        </div>
    <?php } else { ?>
        <p>Produk tidak ditemukan.</p>
        <a href="<?php echo site_url('products'); ?>" class="btn btn-link">
            &larr; Kembali ke daftar produk
        </a>
    <?php } ?>
</div>
