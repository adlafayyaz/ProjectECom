<h2 class="mb-4">Order Detail</h2>

<?php if (!empty($order)) { ?>
    <div class="mb-3">
        <strong>Order ID:</strong> <?php echo htmlspecialchars($order['id']); ?><br>
        <strong>Customer:</strong> <?php echo htmlspecialchars($order['user_name'] ?? ($order['customer_name'] ?? '')); ?><br>
        <strong>Date:</strong> <?php echo !empty($order['order_date']) ? date('d M Y H:i', strtotime($order['order_date'])) : '-'; ?><br>
        <strong>Status:</strong> <?php echo htmlspecialchars($order['status']); ?><br>
        <strong>Total:</strong> Rp <?php echo number_format((float) ($order['total_price'] ?? 0), 0, ',', '.'); ?>
    </div>
<?php } ?>

<h4>Items</h4>
<table class="table table-striped">
    <thead>
        <tr><th>Product</th><th>Price</th><th>Quantity</th><th>Subtotal</th></tr>
    </thead>
    <tbody>
        <?php if (!empty($items)) { ?>
            <?php foreach ($items as $item) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['product_id']); ?></td>
                    <td>Rp <?php echo number_format((float) ($item['price'] ?? 0), 0, ',', '.'); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td>Rp <?php echo number_format((float) (($item['price'] ?? 0) * ($item['quantity'] ?? 0)), 0, ',', '.'); ?></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr><td colspan="4">No items found.</td></tr>
        <?php } ?>
    </tbody>
</table>

<a href="<?php echo site_url('admin/orders'); ?>" class="btn btn-secondary">Back to Orders</a>