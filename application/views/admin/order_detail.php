<!-- Order Detail Page -->
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Order Detail #<?php echo $order['id']; ?></h2>
        <a href="<?php echo site_url('admin/orders'); ?>" class="btn btn-secondary btn-sm">
            &larr; Back to Orders
        </a>
    </div>

    <div class="row">
        <!-- Customer & Order Info -->
        <div class="col-md-6 mb-4">
            <div class="card shadow h-100 border-0">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 font-weight-bold text-dark">Customer Information</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td style="width: 130px;"><strong>Name</strong></td>
                            <td>: <?php echo htmlspecialchars($order['recipient_name'] ?? $order['user_name'] ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>: <?php echo htmlspecialchars($order['user_email'] ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Address</strong></td>
                            <td>: <?php echo nl2br(htmlspecialchars($order['recipient_address'] ?? '')); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Payment Method</strong></td>
                            <td>: <span class="badge bg-info text-dark"><?php echo strtoupper($order['payment_method'] ?? 'N/A'); ?></span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Order Status & Proof -->
        <div class="col-md-6 mb-4">
            <div class="card shadow h-100 border-0">
                <div class="card-header py-3 bg-white">
                    <h6 class="m-0 font-weight-bold text-dark">Order Status & Proof</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Current Status:</strong>
                        <span class="badge bg-<?php echo $order['status'] == 'paid' ? 'success' : ($order['status'] == 'pending' ? 'warning' : 'secondary'); ?> fs-6">
                            <?php echo ucfirst($order['status']); ?>
                        </span>
                    </div>

                    <form action="<?php echo site_url('admin/orders/update_status/' . $order['id']); ?>" method="post" class="mb-4">
                        <label for="status" class="form-label">Update Status:</label>
                        <div class="input-group">
                            <select name="status" id="status" class="form-select">
                                <option value="pending" <?php echo $order['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="paid" <?php echo $order['status'] == 'paid' ? 'selected' : ''; ?>>Paid</option>
                                <option value="shipped" <?php echo $order['status'] == 'shipped' ? 'selected' : ''; ?>>Shipped</option>
                                <option value="completed" <?php echo $order['status'] == 'completed' ? 'selected' : ''; ?>>Completed</option>
                                <option value="cancelled" <?php echo $order['status'] == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>

                    <?php if (!empty($order['payment_proof'])) { ?>
                        <hr>
                        <strong>Payment Proof:</strong><br>
                        <a href="<?php echo base_url('public/assets/images/' . $order['payment_proof']); ?>" target="_blank">
                            <img src="<?php echo base_url('public/assets/images/' . $order['payment_proof']); ?>" 
                                 alt="Payment Proof" 
                                 class="img-thumbnail mt-2" 
                                 style="max-height: 200px;">
                        </a>
                    <?php } else { ?>
                        <div class="alert alert-warning mt-3">No payment proof uploaded yet.</div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Items -->
    <div class="card shadow mb-4 border-0">
        <div class="card-header py-3 bg-white">
            <h6 class="m-0 font-weight-bold text-dark">Order Items</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Product ID</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total = 0;
                        if (!empty($items)) { 
                            foreach ($items as $item) { 
                                $subtotal = ($item['price'] ?? 0) * ($item['quantity'] ?? 0);
                                $total += $subtotal;
                        ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['product_id']); ?></td>
                                <td>Rp <?php echo number_format((float) ($item['price'] ?? 0), 0, ',', '.'); ?></td>
                                <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                                <td>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                            </tr>
                        <?php } 
                        } else { ?>
                            <tr><td colspan="4" class="text-center">No items found.</td></tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end"><strong>Total:</strong></td>
                            <td><strong>Rp <?php echo number_format($total, 0, ',', '.'); ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
