<div class="container py-5">
    <h1 class="h3 mb-4">My Account</h1>

    <div class="row">
        <!-- Profile -->
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    Profile Information
                </div>
                <div class="card-body">
                    <p class="mb-1">
                        <strong>Name:</strong><br>
                        <?php
                        echo htmlspecialchars(
                            $current_user['name'] ?? ($user['name'] ?? '-')
                        );
                        ?>
                    </p>
                    <p class="mb-1">
                        <strong>Email:</strong><br>
                        <?php
                        echo htmlspecialchars(
                            $current_user['email'] ?? ($user['email'] ?? '-')
                        );
                        ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Order history -->
        <div class="col-md-8 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    Order History
                </div>
                <div class="card-body">
                    <?php if (!empty($orders)) { ?>
                        <div class="table-responsive">
                            <table class="table table-sm align-middle">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $order) { ?>
                                        <tr>
                                            <td>#<?php echo (int) $order['id']; ?></td>
                                            <td>
                                                <?php
                                                echo !empty($order['order_date'])
                                                    ? date('d M Y H:i', strtotime($order['order_date']))
                                                    : '-';
                                        ?>
                                            </td>
                                            <td>
                                                Rp <?php echo number_format($order['total_price'] ?? 0, 0, ',', '.'); ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary text-capitalize">
                                                    <?php echo htmlspecialchars($order['status'] ?? 'pending'); ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    <?php } else { ?>
                        <p>You have no orders yet.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-outline-danger">
            Logout
        </a>
    </div>
</div>
