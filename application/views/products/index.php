<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">All Products</h1>
            <p class="text-muted mb-0">Temukan outfit terbaikmu di sini.</p>
        </div>

        <?php if (!empty($categories)): ?>
            <form method="get" class="d-flex align-items-center">
                <label for="category" class="me-2 mb-0">Filter Kategori:</label>
                <select name="category" id="category" class="form-select" onchange="this.form.submit()">
                    <option value="">Semua</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>"
                            <?php echo (isset($selected_category) && $selected_category == $cat['id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        <?php endif; ?>
    </div>

    <?php if (!empty($products)): ?>
        <div class="row">
            <?php foreach ($products as $product): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img
                            src="<?php echo base_url('public/assets/images/' . ($product['image'] ?? 'placeholder.jpg')); ?>"
                            class="card-img-top"
                            alt="<?php echo htmlspecialchars($product['name'] ?? 'Product'); ?>"
                        >
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-1">
                                <?php echo htmlspecialchars($product['name'] ?? ''); ?>
                            </h5>

                            <?php if (!empty($product['category_name'])): ?>
                                <small class="text-muted d-block mb-1">
                                    <?php echo htmlspecialchars($product['category_name']); ?>
                                </small>
                            <?php endif; ?>

                            <p class="card-text mb-2 fw-bold text-success">
                                Rp <?php echo number_format($product['price'] ?? 0, 0, ',', '.'); ?>
                            </p>

                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <a href="<?php echo site_url('products/detail/' . ($product['slug'] ?? '')); ?>"
                                   class="btn btn-sm btn-outline-primary">
                                    View Detail
                                </a>

                                <div class="d-flex gap-2">
                                    <button
                                        class="btn btn-sm btn-success add-to-cart"
                                        data-product-id="<?php echo $product['id']; ?>">
                                        <i class="bi bi-cart-plus"></i> Cart
                                    </button>

                                    <button
                                        class="btn btn-sm btn-outline-danger toggle-favorite"
                                        data-product-id="<?php echo $product['id']; ?>">
                                        <i class="bi bi-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Tidak ada produk yang tersedia.</p>
    <?php endif; ?>
</div>
