<!-- Hero Section -->
<section class="hero-section position-relative">
    <div class="hero-bg"
         style="background-image: url('<?php echo base_url('public/assets/images/hero.jpg'); ?>');">
    </div>
    <div class="hero-overlay"></div>

    <div class="hero-content text-left text-white">
        <h1 class="display-4 fw-bold mb-3">
            Timeless Fashion,<br>
            <em>Conscious Choices.</em>
        </h1>
        <p class="lead mb-4">
            Sustainably designed, effortlessly worn. Our pieces are made with premium materials,
            and wardrobe that stands the test of time.
        </p>

        <a href="<?php echo site_url('products'); ?>" class="btn btn-light btn-lg rounded-pill px-4">
            Explore the Collections
        </a>
    </div>
</section>

<!-- Section: Find Your Look -->
<section class="py-5 text-center find-look-section">
    <div class="container">
        <h2 class="mb-4 fw-bold" data-aos="fade-up">Find Your Look</h2>

        <div class="row g-4">

            <!-- WOMEN -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <a href="<?php echo site_url('products?category=women'); ?>" class="look-box">
                    <div class="look-img"
                         style="background-image:url('<?php echo base_url('public/assets/images/women.jpg'); ?>');">
                    </div>
                    <span class="look-label">Women</span>
                </a>
            </div>

            <!-- MEN -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <a href="<?php echo site_url('products?category=men'); ?>" class="look-box">
                    <div class="look-img"
                         style="background-image:url('<?php echo base_url('public/assets/images/men.jpg'); ?>');">
                    </div>
                    <span class="look-label">Men</span>
                </a>
            </div>

            <!-- KIDS -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <a href="<?php echo site_url('products?category=kids'); ?>" class="look-box">
                    <div class="look-img"
                         style="background-image:url('<?php echo base_url('public/assets/images/kids.jpg'); ?>');">
                    </div>
                    <span class="look-label">Kids</span>
                </a>
            </div>

        </div>
    </div>
</section>

<!-- Best Sellers Section -->
<section class="py-5 best-seller-section">
    <div class="container">

        <!-- Header Best Seller -->
        <div class="d-flex justify-content-between align-items-end mb-5" data-aos="fade-up">
            <div>
                <h2 class="fw-bold mb-1">NEW ARRIVALS</h2>
                <p class="text-muted mb-0">Top picks for the season.</p>
            </div>
            <a href="<?php echo site_url('products'); ?>" class="view-all-link">
                View All <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>

        <!-- Grid best seller -->
        <?php if (!empty($best_sellers)) { ?>
            <div class="row g-4">
                <?php foreach ($best_sellers as $item) { ?>
                    <div class="col-6 col-md-3" data-aos="fade-up" data-aos-delay="100">
                        <a href="<?php echo site_url('products/detail/'.($item['slug'] ?? $item['id'])); ?>"
                           class="product-card">
                            
                            <!-- Gambar produk + badge kategori -->
                            <div class="product-img-wrap">
                                <?php if (!empty($item['category_name'])) { ?>
                                    <span class="badge-category">
                                        <?php echo htmlspecialchars($item['category_name']); ?>
                                    </span>
                                <?php } ?>

                                <img src="<?php echo base_url('public/assets/images/'.($item['image'] ?? 'placeholder.jpg')); ?>"
                                     alt="<?php echo htmlspecialchars($item['name']); ?>"
                                     class="product-img">

                                <!-- Tombol hover -->
                                <div class="product-action">
                                    <button class="btn btn-light btn-sm rounded-0 px-3">
                                        View Details
                                    </button>
                                </div>
                            </div>

                            <!-- Info produk singkat -->
                            <div class="product-info mt-3">
                                <h5 class="product-title text-truncate">
                                    <?php echo htmlspecialchars($item['name']); ?>
                                </h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="product-price">
                                        Rp <?php echo number_format($item['price'], 0, ',', '.'); ?>
                                    </span>
                                    <i class="bi bi-heart text-muted small-icon"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</section>
