<?php $this->load->view('layouts/admin_header', ['title' => $title]); ?>
<h2>Manage Users</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($users)) {
            foreach ($users as $u) { ?>
        <tr>
            <td><?php echo $u->id; ?></td>
            <td><?php echo $u->name; ?></td>
            <td><?php echo $u->email; ?></td>
            <td><?php echo $u->role; ?></td>
        </tr>
        <?php }
            } else { ?>
        <tr><td colspan="4">No users found.</td></tr>
        <?php } ?>
    </tbody>
</table>
<?php $this->load->view('layouts/admin_footer'); ?>
