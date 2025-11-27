<!-- Halaman Manage Products -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800">Manage Products</h2>
    <a href="<?php echo base_url('admin/products/create'); ?>" class="btn btn-primary shadow-sm">
        <i class="bi bi-plus-lg me-1"></i> Add New Product
    </a>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-header py-3 bg-white">
        <h6 class="m-0 font-weight-bold text-dark">Product List</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th style="width: 1%; white-space: nowrap;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products)) {
                        foreach ($products as $product) { ?>
                        <tr>
                            <td class="ps-4"><?php echo htmlspecialchars($product['id']); ?></td>
                            <td>
                                <div class="fw-bold"><?php echo htmlspecialchars($product['name']); ?></div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">
                                    <?php echo htmlspecialchars($product['category_name'] ?? 'Uncategorized'); ?>
                                </span>
                            </td>
                            <td>Rp <?php echo number_format((float) ($product['price'] ?? 0), 0, ',', '.'); ?></td>
                            <td>
                                <?php if ($product['stock'] > 10) { ?>
                                    <span class="text-success fw-bold"><?php echo htmlspecialchars($product['stock']); ?></span>
                                <?php } else { ?>
                                    <span class="text-danger fw-bold"><?php echo htmlspecialchars($product['stock']); ?> (Low)</span>
                                <?php } ?>
                            </td>
                            <td style="white-space: nowrap;">
                                <a href="<?php echo base_url('admin/products/edit/'.$product['id']); ?>"
                                   class="btn btn-sm btn-primary me-1 shadow-sm">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </a>
                                <a href="<?php echo base_url('admin/products/delete/'.$product['id']); ?>"
                                   class="btn btn-sm btn-danger shadow-sm"
                                   onclick="return confirm('Delete this product?')">
                                    <i class="bi bi-trash-fill"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php }
                        } else { ?>
                        <tr><td colspan="6" class="text-center py-4">No products available.</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
