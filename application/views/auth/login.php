<!-- Halaman Login -->
<!-- Wrapper khusus untuk halaman auth agar background full screen -->
<div class="auth-page">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <!-- Card di tengah (col-md-5) -->
            <div class="col-md-6 col-lg-5">
                
                <div class="card glass-card p-4 p-sm-5">
                    <div class="mb-4 text-center">
                        <h1 class="h2 mb-2">Welcome Back</h1>
                        <p class="mb-0">Please login to your account</p>
                    </div>

                    <!-- Flash error -->
                    <?php if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                            <?php echo $this->session->flashdata('error'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>

                    <!-- Form login -->
                    <form method="post" action="<?php echo site_url('auth/login'); ?>">
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" id="email" class="form-control py-2"
                                   value="<?php echo set_value('email'); ?>" placeholder="mail@abc.com" required>
                            <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" id="password" class="form-control py-2" 
                                   placeholder="................" required>
                            <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4 small">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember Me</label>
                            </div>
                            <a href="#" class="text-decoration-none text-muted">Forgot Password?</a>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            Login
                        </button>
                        
                        <!-- Register Link -->
                        <div class="text-center">
                             <p class="mb-0 small">
                                Don't have an account? 
                                <a href="<?php echo site_url('auth/register'); ?>" class="fw-bold text-dark">Register</a>
                            </p>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
