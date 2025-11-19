<h2>Manage Orders</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Date</th>
            <th>Total</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($orders)) {
            foreach ($orders as $order) { ?>
            <tr>
                <td><?php echo htmlspecialchars($order['id']); ?></td>
                <td><?php echo htmlspecialchars($order['user_name'] ?? ''); ?></td>
                <td><?php echo !empty($order['order_date']) ? date('d M Y', strtotime($order['order_date'])) : '-'; ?></td>
                <td>Rp <?php echo number_format((float) ($order['total_price'] ?? 0), 0, ',', '.'); ?></td>
                <td><?php echo ucfirst($order['status'] ?? ''); ?></td>
                <td class="text-end">
                    <a href="<?php echo base_url('admin/orders/show/'.$order['id']); ?>" class="btn btn-sm btn-info">Detail</a>
                </td>
            </tr>
        <?php }
            } else { ?>
            <tr><td colspan="6">No orders found.</td></tr>
            <?php } ?>
    </tbody>
</table>