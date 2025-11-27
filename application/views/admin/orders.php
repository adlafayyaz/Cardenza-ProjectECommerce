<!-- Halaman Manage Orders -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800">Manage Orders</h2>
</div>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-header py-3 bg-white">
        <h6 class="m-0 font-weight-bold text-dark">Order List</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Order ID</th>
                        <th>User</th>
                        <th>Date</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th style="width: 1%; white-space: nowrap;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($orders)) {
                        foreach ($orders as $order) { ?>
                        <tr>
                            <td class="ps-4">#<?php echo htmlspecialchars($order['id']); ?></td>
                            <td>
                                <div class="fw-bold"><?php echo htmlspecialchars($order['user_name']); ?></div>
                                <small class="text-muted"><?php echo htmlspecialchars($order['user_email']); ?></small>
                            </td>
                            <td><?php echo date('d M Y H:i', strtotime($order['order_date'])); ?></td>
                            <td class="fw-bold">Rp <?php echo number_format($order['total_price'], 0, ',', '.'); ?></td>
                            <td>
                                <?php 
                                    $statusClass = 'bg-secondary';
                                    if ($order['status'] == 'pending') $statusClass = 'bg-warning text-dark';
                                    elseif ($order['status'] == 'paid') $statusClass = 'bg-info text-dark';
                                    elseif ($order['status'] == 'shipped') $statusClass = 'bg-primary';
                                    elseif ($order['status'] == 'completed') $statusClass = 'bg-success';
                                    elseif ($order['status'] == 'cancelled') $statusClass = 'bg-danger';
                                ?>
                                <span class="badge <?php echo $statusClass; ?> rounded-pill px-3 py-2">
                                    <?php echo ucfirst($order['status']); ?>
                                </span>
                            </td>
                            <td style="white-space: nowrap;">
                                <a href="<?php echo base_url('admin/orders/show/'.$order['id']); ?>" 
                                   class="btn btn-sm btn-primary shadow-sm me-1">
                                    <i class="bi bi-eye-fill me-1"></i> Detail
                                </a>
                                <a href="<?php echo base_url('admin/orders/delete/'.$order['id']); ?>" 
                                   class="btn btn-sm btn-danger shadow-sm"
                                   onclick="return confirm('Are you sure you want to delete this order?');">
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </td>
                        </tr>
                    <?php }
                        } else { ?>
                        <tr><td colspan="6" class="text-center py-4">No orders found.</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
