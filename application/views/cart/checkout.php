<!-- Halaman Checkout -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3">
                    <h4 class="mb-0 fw-bold">Checkout</h4>
                </div>
                <div class="card-body p-4">
                    
                    <!-- Order Summary Singkat -->
                    <div class="alert alert-light border mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Total Pembayaran:</span>
                            <span class="fw-bold fs-5">Rp <?php echo number_format($total, 0, ',', '.'); ?></span>
                        </div>
                    </div>

                    <form action="<?php echo site_url('cart/process_checkout'); ?>" method="post">
                        
                        <h5 class="mb-3">Alamat Pengiriman</h5>
                        
                        <div class="mb-3">
                            <label for="recipient_name" class="form-label">Nama Penerima</label>
                            <input type="text" class="form-control" id="recipient_name" name="recipient_name" required placeholder="Nama lengkap penerima">
                        </div>
                        
                        <div class="mb-4">
                            <label for="recipient_address" class="form-label">Alamat Lengkap</label>
                            <textarea class="form-control" id="recipient_address" name="recipient_address" rows="3" required placeholder="Jalan, No. Rumah, RT/RW, Kecamatan, Kota, Kode Pos"></textarea>
                        </div>
                        
                        <h5 class="mb-3">Metode Pembayaran</h5>
                        
                        <div class="mb-4">
                            <div class="card border p-3 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="payment_qris" value="qris" required checked>
                                    <label class="form-check-label fw-semibold" for="payment_qris">
                                        QRIS (E-Wallet / Mobile Banking)
                                    </label>
                                    <div class="small text-muted mt-1">Scan kode QR untuk pembayaran instan.</div>
                                </div>
                            </div>
                            
                            <div class="card border p-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" id="payment_bank" value="bank_transfer" required>
                                    <label class="form-check-label fw-semibold" for="payment_bank">
                                        Transfer Bank (BCA)
                                    </label>
                                    <div class="small text-muted mt-1">Transfer manual ke rekening BCA kami.</div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-success py-2 fw-bold">
                                Buat Pesanan
                            </button>
                            <a href="<?php echo site_url('cart'); ?>" class="btn btn-outline-secondary py-2">
                                Kembali ke Keranjang
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
