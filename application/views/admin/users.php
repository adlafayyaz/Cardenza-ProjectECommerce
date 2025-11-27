<!-- Halaman Manage Users -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800">Manage Users</h2>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-header py-3 bg-white">
        <h6 class="m-0 font-weight-bold text-dark">User List</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)) {
                        foreach ($users as $u) { ?>
                        <tr>
                            <td class="ps-4"><?php echo htmlspecialchars($u['id']); ?></td>
                            <td>
                                <div class="fw-bold"><?php echo htmlspecialchars($u['name']); ?></div>
                            </td>
                            <td><?php echo htmlspecialchars($u['email']); ?></td>
                            <td>
                                <span class="badge <?php echo ($u['role'] == 'admin') ? 'bg-danger' : 'bg-info text-dark'; ?>">
                                    <?php echo ucfirst($u['role']); ?>
                                </span>
                            </td>
                        </tr>
                    <?php }
                        } else { ?>
                        <tr><td colspan="4" class="text-center py-4">No users found.</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
