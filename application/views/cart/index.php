<!-- Halaman Cart: Menampilkan daftar item yang akan dibeli pengguna. -->
<div class="container py-5">

    <h1 class="h3 mb-4 fw-bold">Your Cart</h1>

    <?php if (!empty($items)) { ?>

    <!-- Form update cart: Membungkus semua item agar perubahan quantity bisa diproses. -->
    <form id="cartForm" method="post" action="<?php echo site_url('cart/update'); ?>">

        <div class="row g-4">

            <!-- LIST ITEM: Daftar produk yang ada di keranjang. -->
            <div class="col-lg-8">
                <?php 
                $total = 0;
                foreach ($items as $item) {
                    $subtotal = $item['price'] * $item['quantity'];
                    $total   += $subtotal;
                ?>

                <div class="card border-0 shadow-sm rounded-4 mb-3 p-3">
                    <div class="d-flex align-items-center gap-3">

                        <!-- IMAGE: Gambar produk thumbnail. -->
                        <img src="<?php echo base_url('public/assets/images/'.($item['image'] ?? 'placeholder.jpg')); ?>"
                             class="rounded"
                             style="width: 90px; height: 90px; object-fit: cover;">

                        <div class="flex-grow-1">

                            <h6 class="mb-1"><?php echo htmlspecialchars($item['name']); ?></h6>

                            <p class="text-muted small mb-1">
                                Rp <?php echo number_format($item['price'], 0, ',', '.'); ?>
                            </p>

                            <!-- QTY WITH BUTTON: Tombol plus minus untuk mengatur jumlah. -->
                            <div class="quantity-box d-flex align-items-center gap-2">

                                <!-- MINUS -->
                                <button type="button" 
                                        class="btn btn-sm btn-outline-dark qty-btn minus"
                                        data-id="<?php echo $item['product_id']; ?>">−</button>

                                <!-- INPUT QTY -->
                                <input
                                    type="number"
                                    name="quantity[<?php echo $item['product_id']; ?>]"
                                    value="<?php echo (int)$item['quantity']; ?>"
                                    min="1"
                                    class="form-control form-control-sm text-center qty-input"
                                    style="width: 60px;"
                                    data-id="<?php echo $item['product_id']; ?>">

                                <!-- PLUS -->
                                <button type="button" 
                                        class="btn btn-sm btn-outline-dark qty-btn plus"
                                        data-id="<?php echo $item['product_id']; ?>">+</button>

                            </div>
                        </div>

                        <div class="text-end">
                            <p class="fw-semibold mb-2">
                                Rp <?php echo number_format($subtotal, 0, ',', '.'); ?>
                            </p>

                            <!-- Tombol Hapus Item -->
                            <a href="<?php echo site_url('cart/remove/'.$item['product_id']); ?>"
                               class="btn btn-sm btn-outline-danger px-3">
                                Remove
                            </a>
                        </div>
                    </div>
                </div>

                <?php } ?>
            </div>

            <!-- SUMMARY: Ringkasan total belanja dan tombol checkout. -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 p-4">

                    <h5 class="fw-bold mb-3">Order Summary</h5>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Total</span>
                        <span class="fw-bold">
                            Rp <?php echo number_format($total, 0, ',', '.'); ?>
                        </span>
                    </div>

                    <hr>

                    <!-- Tombol Checkout: Mengarahkan ke halaman pengisian alamat. -->
                    <a href="<?php echo site_url('cart/checkout'); ?>" 
                       class="btn btn-success w-100 py-2">
                        Checkout
                    </a>

                </div>
            </div>

        </div>
    </form>

    <?php } else { ?>

    <!-- Jika cart kosong -->
    <div class="text-center py-5">
        <p class="text-muted mb-3">Keranjang Anda masih kosong.</p>
        <a href="<?php echo site_url('products'); ?>" class="btn btn-primary px-4 py-2">
            Continue Shopping
        </a>
    </div>

    <?php } ?>
</div>

<!-- Script JS untuk handle tombol plus minus quantity -->
<script>
document.querySelectorAll(".qty-btn.minus").forEach(btn => {
    btn.addEventListener("click", () => {
        let id = btn.dataset.id;
        let input = document.querySelector(`input[data-id='${id}']`);
        let value = parseInt(input.value);
        if (value > 1) input.value = value - 1;
        document.getElementById("cartForm").submit();
    });
});

document.querySelectorAll(".qty-btn.plus").forEach(btn => {
    btn.addEventListener("click", () => {
        let id = btn.dataset.id;
        let input = document.querySelector(`input[data-id='${id}']`);
        let value = parseInt(input.value);
        input.value = value + 1;
        document.getElementById("cartForm").submit();
    });
});

document.querySelectorAll(".qty-input").forEach(input => {
    input.addEventListener('change', () => {
        if (input.value < 1) input.value = 1;
        document.getElementById("cartForm").submit();
    });
});
</script>