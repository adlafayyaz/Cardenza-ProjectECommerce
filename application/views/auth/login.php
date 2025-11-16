<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger">
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php } ?>

            <h1 class="h3 mb-4 text-center">Login</h1>

            <form method="post" action="<?php echo site_url('auth/login'); ?>">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                           value="<?php echo set_value('email'); ?>" required>
                    <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                    <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>

            <p class="text-center mt-3">
                Belum punya akun?
                <a href="<?php echo site_url('auth/register'); ?>">Register</a>
            </p>
        </div>
    </div>
</div>
