<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
</div>

<!-- Footer Frontend -->
<?php if (empty($hide_footer)) { ?>
<footer class="cardenza-footer">
    <div class="container">
        <div class="row g-4">

            <!-- Kolom brand + deskripsi -->
            <div class="col-12 col-md-5 pe-md-5">
                <h5 class="footer-brand mb-3">CARDENZA</h5>
                <p class="footer-desc">
                    Sebagai destinasi fashion modern, Cardenza menghadirkan koleksi timeless 
                    dengan sentuhan gaya minimalis. Kami berkomitmen untuk memberikan 
                    kualitas terbaik, kenyamanan, dan gaya yang bertahan lama untuk 
                    Pria, Wanita, dan Anak-anak.
                </p>
                <p class="footer-desc mt-3">
                    <strong>Layanan Pengaduan Konsumen</strong><br>
                    Cardenza Official Store <br>
                    email : customer@id.cardenza.com <br>
                    telepon : 021-29490100 <br>
                    WhatsApp : +62 888 888 888 <br>
                </p>
            </div>

            <!-- Kolom About -->
            <div class="col-6 col-md-2">
                <h6 class="footer-title">TENTANG KAMI</h6>
                <ul class="list-unstyled footer-links">
                    <li>
                        <a href="<?php echo site_url('about'); ?>">
                            About Cardenza
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Kolom kategori utama -->
            <div class="col-6 col-md-3">
                <h6 class="footer-title">KATEGORI UTAMA</h6>
                <ul class="list-unstyled footer-links">
                    <li>
                        <a href="<?php echo site_url('products?category=men'); ?>">
                            Pria
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('products?category=women'); ?>">
                            Wanita
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('products?category=kids'); ?>">
                            Anak-anak
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('products'); ?>">
                            Lihat Semua Produk
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <hr class="footer-divider">

        <div class="row align-items-center py-3">
            <div class="col-md-6 text-center text-md-start">
                <small class="footer-copyright">
                    &copy; <?php echo date('Y'); ?> Cardenza. All rights reserved.
                </small>
            </div>
        </div>
    </div>
</footer>
<?php } ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true
    });
</script>

</body>
</html>
