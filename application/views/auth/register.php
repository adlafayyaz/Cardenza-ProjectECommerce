<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php } ?>

            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger">
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php } ?>

            <h1 class="h3 mb-4 text-center">Register</h1>

            <form method="post" action="<?php echo site_url('auth/register'); ?>">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="<?php echo set_value('name'); ?>"
                        required
                    >
                    <?php echo form_error('name', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="<?php echo set_value('email'); ?>"
                        required
                    >
                    <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        required
                    >
                    <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password Confirmation</label>
                    <input
                        type="password"
                        name="password_confirm"
                        class="form-control"
                        required
                    >
                    <?php echo form_error('password_confirm', '<small class="text-danger">', '</small>'); ?>
                </div>

                <button type="submit" class="btn btn-success w-100">Register</button>
            </form>

            <p class="text-center mt-3">
                Already have an account?
                <a href="<?php echo site_url('auth/login'); ?>">Login</a>
            </p>
        </div>
    </div>
</div>
