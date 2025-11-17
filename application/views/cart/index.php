<div class="container my-5">
    <h2>Your Cart</h2>
    <?php if (!empty($items)) { ?>
    <form method="post" action="<?php echo base_url('cart/update'); ?>">
        <div class="table-responsive">
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>Product</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
        foreach ($items as $item) {
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
            ?>
                <tr>
                    <td class="d-flex align-items-center">
                        <img src="<?php echo base_url('public/assets/images/'.$item['image']); ?>"
                             alt="<?php echo htmlspecialchars($item['name']); ?>"
                             width="50"
                             class="mr-3 rounded">
                        <?php echo htmlspecialchars($item['name']); ?>
                    </td>
                    <td class="text-center">
                        Rp <?php echo number_format($item['price'], 0, ',', '.'); ?>
                    </td>
                    <td class="text-center" style="max-width:120px;">
                        <input type="number"
                               name="quantity[<?php echo $item['product_id']; ?>]"
                               value="<?php echo $item['quantity']; ?>"
                               min="1"
                               class="form-control form-control-sm">
                    </td>
                    <td class="text-center">
                        Rp <?php echo number_format($subtotal, 0, ',', '.'); ?>
                    </td>
                    <td class="text-right">
                        <a href="<?php echo base_url('cart/remove/'.$item['product_id']); ?>"
                           class="btn btn-sm btn-outline-danger">
                            Remove
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <h4>Total: Rp <?php echo number_format($total, 0, ',', '.'); ?></h4>
            <div>
                <button type="submit" class="btn btn-primary">Update Cart</button>
                <a href="<?php echo base_url('cart/checkout'); ?>" class="btn btn-accent ml-2">Checkout</a>
            </div>
        </div>
    </form>
    <?php } else { ?>
        <p>Your cart is empty.</p>
        <a href="<?php echo base_url('products'); ?>" class="btn btn-primary">Continue Shopping</a>
    <?php } ?>
</div>
