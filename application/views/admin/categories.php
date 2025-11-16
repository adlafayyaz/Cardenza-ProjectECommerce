<?php $this->load->view('layouts/admin_header', ['title' => $title]); ?>
<h2>Manage Categories</h2>
<a href="<?php echo base_url('admin/categories/create'); ?>" class="btn btn-success mb-3">Add New Category</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Slug</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($categories)) {
            foreach ($categories as $cat) { ?>
        <tr>
            <td><?php echo $cat->id; ?></td>
            <td><?php echo $cat->name; ?></td>
            <td><?php echo $cat->slug; ?></td>
            <td class="text-right">
                <a href="<?php echo base_url('admin/categories/edit/'.$cat->id); ?>" class="btn btn-sm btn-primary">Edit</a>
                <a href="<?php echo base_url('admin/categories/delete/'.$cat->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this category?')">Delete</a>
            </td>
        </tr>
        <?php }
            } else { ?>
        <tr><td colspan="4">No categories.</td></tr>
        <?php } ?>
    </tbody>
</table>
<?php $this->load->view('layouts/admin_footer'); ?>
