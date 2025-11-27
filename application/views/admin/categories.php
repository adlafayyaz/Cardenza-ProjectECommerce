<!-- Halaman list categories -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800">Manage Categories</h2>
    <a href="<?php echo base_url('admin/categories/create'); ?>" class="btn btn-primary shadow-sm">
        <i class="bi bi-plus-lg me-1"></i> Add New Category
    </a>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-header py-3 bg-white">
        <h6 class="m-0 font-weight-bold text-dark">Category List</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th style="width: 1%; white-space: nowrap;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($categories)) {
                        foreach ($categories as $cat) { ?>
                        <tr>
                            <td class="ps-4"><?php echo htmlspecialchars($cat['id']); ?></td>
                            <td>
                                <div class="fw-bold"><?php echo htmlspecialchars($cat['name']); ?></div>
                            </td>
                            <td>
                                <span class="badge bg-light text-secondary border">
                                    <?php echo htmlspecialchars($cat['slug']); ?>
                                </span>
                            </td>
                            <td style="white-space: nowrap;">
                                <a href="<?php echo base_url('admin/categories/edit/'.$cat['id']); ?>" class="btn btn-sm btn-primary me-1 shadow-sm">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </a>
                                <a href="<?php echo base_url('admin/categories/delete/'.$cat['id']); ?>"
                                   class="btn btn-sm btn-danger shadow-sm"
                                   onclick="return confirm('Delete this category?')">
                                    <i class="bi bi-trash-fill"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php }
                        } else { ?>
                        <tr>
                            <td colspan="4" class="text-center py-4">No categories found.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
