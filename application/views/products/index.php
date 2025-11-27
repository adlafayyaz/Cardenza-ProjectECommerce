<!-- Halaman List Produk -->
<div class="container py-5">
    <!-- Header + filter kategori -->
    <div class="d-flex justify-content-between align-items-center mb-4">
    <div data-aos="fade-up">
        <h1 class="h3 mb-1">All Products</h1>
        <p class="text-muted mb-0">Temukan outfit terbaikmu di sini.</p>
    </div>

        <?php if (!empty($categories)) { ?>
            <form method="get" class="d-flex align-items-center gap-2">
                <label for="category" class="mb-0">Filter Kategori:</label>

                <select
                    name="category"
                    id="category"
                    class="form-select"
                    style="width: auto; min-width: 150px;"
                    onchange="this.form.submit()"
                >
                    <option value="">Semua</option>
                    <?php foreach ($categories as $cat) { ?>
                        <option
                            value="<?php echo $cat['slug']; ?>"
                            <?php echo (!empty($selected_category) && $selected_category === $cat['slug']) ? 'selected' : ''; ?>
                        >
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </option>
                    <?php } ?>
                </select>
            </form>
        <?php } ?>
    </div>

    <!-- Grid produk -->
    <?php if (!empty($products)) { ?>
        <div class="row">
            <?php foreach ($products as $product) { ?>
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100">
                        <img
                            src="<?php echo base_url('public/assets/images/'.($product['image'] ?? 'placeholder.jpg')); ?>"
                            class="card-img-top product-list-image"
                            alt="<?php echo htmlspecialchars($product['name'] ?? 'Product'); ?>"
                        >
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-1">
                                <?php echo htmlspecialchars($product['name'] ?? ''); ?>
                            </h5>

                            <?php if (!empty($product['category_name'])) { ?>
                                <small class="text-muted d-block mb-1">
                                    <?php echo htmlspecialchars($product['category_name']); ?>
                                </small>
                            <?php } ?>

                            <p class="card-text mb-2 fw-bold text-success">
                                Rp <?php echo number_format($product['price'] ?? 0, 0, ',', '.'); ?>
                            </p>

                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <a
                                    href="<?php echo site_url('products/detail/'.($product['slug'] ?? '')); ?>"
                                    class="btn btn-sm btn-outline-primary"
                                >
                                    View Detail
                                </a>

                                <div class="d-flex gap-2">
                                    <?php if (($product['stock'] ?? 0) > 0) { ?>
                                        <a
                                            href="<?php echo site_url('cart/add/'.$product['id']); ?>"
                                            class="btn btn-sm btn-success"
                                        >
                                            <i class="bi bi-cart-plus"></i> Cart
                                        </a>
                                    <?php } else { ?>
                                        <button class="btn btn-sm btn-secondary" disabled>
                                            <i class="bi bi-cart-plus"></i> Habis
                                        </button>
                                    <?php } ?>

                                    <a
                                        href="<?php echo site_url('favorites/toggle/'.$product['id']); ?>"
                                        class="btn btn-sm btn-outline-danger"
                                    >
                                        <i class="bi bi-heart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } else { ?>
        <!-- Jika tidak ada produk -->
        <p>Tidak ada produk yang tersedia.</p>
    <?php } ?>
</div>
