<!-- Hero Section -->
<section class="hero-section position-relative">
    <!-- Ganti URL gambar dengan gambar fashion berkualitas -->
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
<section class="py-5 text-center">
    <h2 class="mb-4 fw-bold">Find Your Look</h2>
    <div class="row g-4 px-3 justify-content-center">
        <!-- Women Card -->
        <div class="col-md-4">
            <div class="look-card rounded-4 overflow-hidden position-relative"
                 style="background-image: url('<?php echo base_url('public/assets/images/women.jpg'); ?>');">
                <a href="<?php echo site_url('products/category/women'); ?>"
                   class="badge bg-white text-dark rounded-pill position-absolute bottom-3 end-3 p-2 px-3 fw-semibold">
                    Women
                </a>
            </div>
        </div>
        <!-- Men Card -->
        <div class="col-md-4">
            <div class="look-card rounded-4 overflow-hidden position-relative"
                 style="background-image: url('<?php echo base_url('public/assets/images/men.jpg'); ?>');">
                <a href="<?php echo site_url('products/category/men'); ?>"
                   class="badge bg-white text-dark rounded-pill position-absolute bottom-3 end-3 p-2 px-3 fw-semibold">
                    Men
                </a>
            </div>
        </div>
        <!-- Kids Card -->
        <div class="col-md-4">
            <div class="look-card rounded-4 overflow-hidden position-relative"
                 style="background-image: url('<?php echo base_url('public/assets/images/kids.jpg'); ?>');">
                <a href="<?php echo site_url('products/category/kids'); ?>"
                   class="badge bg-white text-dark rounded-pill position-absolute bottom-3 end-3 p-2 px-3 fw-semibold">
                    Kids
                </a>
            </div>
        </div>
    </div>
</section>
