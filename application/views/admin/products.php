<?php $this->load->view('layouts/admin_header', ['title' => $title]); ?>
<h2>Manage Products</h2>
<a href="<?php echo base_url('admin/products/create'); ?>" class="btn btn-success mb-3">Add New Product</a>
<div class="table-responsive">
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($products)) {
            foreach ($products as $product) { ?>
        <tr>
            <td><?php echo $product->id; ?></td>
            <td><?php echo $product->name; ?></td>
            <td><?php echo $product->category_name ?? ''; ?></td>
            <td>Rp <?php echo number_format($product->price, 0, ',', '.'); ?></td>
            <td><?php echo $product->stock; ?></td>
            <td class="text-right">
                <a href="<?php echo base_url('admin/products/edit/'.$product->id); ?>" class="btn btn-sm btn-primary">Edit</a>
                <a href="<?php echo base_url('admin/products/delete/'.$product->id); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</a>
            </td>
        </tr>
        <?php }
            } else { ?>
        <tr><td colspan="6">No products available.</td></tr>
        <?php } ?>
    </tbody>
</table>
</div>
<?php $this->load->view('layouts/admin_footer'); ?>
