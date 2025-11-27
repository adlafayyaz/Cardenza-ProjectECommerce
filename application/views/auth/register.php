<!-- Halaman Register -->
<div class="auth-page">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <!-- Card di tengah -->
            <div class="col-md-6 col-lg-5">
                
                <div class="card glass-card p-4 p-sm-5">
                    <div class="mb-4 text-center">
                        <h1 class="h2 mb-2">Create Account</h1>
                        <p class="mb-0">Join us and start shopping today</p>
                    </div>

                    <!-- Flash success -->
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                            <?php echo $this->session->flashdata('success'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>

                    <!-- Flash error -->
                    <?php if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                            <?php echo $this->session->flashdata('error'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>

                    <!-- Form register -->
                    <form method="post" action="<?php echo site_url('auth/register'); ?>">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name" class="form-control py-2"
                                   value="<?php echo set_value('name'); ?>" placeholder="John Doe" required>
                            <?php echo form_error('name', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control py-2"
                                   value="<?php echo set_value('email'); ?>" placeholder="mail@abc.com" required>
                            <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control py-2"
                                   placeholder="Min. 6 characters" required>
                            <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" name="password_confirm" class="form-control py-2"
                                   placeholder="Re-type password" required>
                            <?php echo form_error('password_confirm', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            Register
                        </button>

                        <div class="text-center">
                            <p class="mb-0 small">
                                Already have an account?
                                <a href="<?php echo site_url('auth/login'); ?>" class="fw-bold text-dark">Login</a>
                            </p>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
