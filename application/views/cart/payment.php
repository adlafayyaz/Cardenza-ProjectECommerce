<!-- Halaman Pembayaran: Menampilkan detail tagihan dan instruksi pembayaran. -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h4 class="mb-0">Payment Details</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        Order ID: #<?php echo $order['id']; ?><br>
                        Total Amount: <strong>Rp <?php echo number_format($order['total_price'], 0, ',', '.'); ?></strong>
                    </div>

                    <!-- Bagian Instruksi Bayar: Menampilkan QRIS atau nomor rekening sesuai metode yang dipilih. -->
                    <div class="mb-4 text-center">
                        <?php if ($order['payment_method'] == 'qris') { ?>
                            <h5>Scan QRIS to Pay</h5>
                            <!-- Placeholder for QRIS Image -->
                            <img src="<?php echo base_url('public/assets/images/qris.jpg'); ?>" 
                                 alt="QRIS Code" 
                                 class="img-fluid border p-2" 
                                 style="max-width: 300px;">
                            <p class="mt-2 text-muted">Scan using your favorite e-wallet or banking app.</p>
                        <?php } else { ?>
                            <h5>Bank Transfer</h5>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <p class="mb-1">Bank: <strong>BCA</strong></p>
                                    <p class="mb-1">Nomor Rekening: <strong>1234567890</strong></p>
                                    <p class="mb-0">Nama Pemilik: <strong>Cardenza</strong></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <hr>

                    <!-- Form Upload Bukti: Area untuk mengunggah gambar bukti transfer. -->
                    <h5 class="mb-3">Upload Payment Proof</h5>
                    <?php if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php } ?>

                    <form action="<?php echo site_url('cart/upload_proof/' . $order['id']); ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="payment_proof" class="form-label">Select Image</label>
                            <input type="file" class="form-control" id="payment_proof" name="payment_proof" required>
                            <div class="form-text">Allowed formats: JPG, JPEG, PNG. Max size: 2MB.</div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Submit Payment Proof</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
