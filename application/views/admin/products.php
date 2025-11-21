<!-- Halaman Manage Products -->
<h2>Manage Products</h2>

<!-- Tombol tambah produk -->
<a href="<?php echo base_url('admin/products/create'); ?>" class="btn btn-success mb-3">
    Add New Product
</a>

<div class="table-responsive">
    <!-- Tabel daftar produk -->
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
                    <td><?php echo htmlspecialchars($product['id']); ?></td>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo htmlspecialchars($product['category_name'] ?? ''); ?></td>
                    <td>Rp <?php echo number_format((float) ($product['price'] ?? 0), 0, ',', '.'); ?></td>
                    <td><?php echo htmlspecialchars($product['stock']); ?></td>
                    <td class="text-end">
                        <a href="<?php echo base_url('admin/products/edit/'.$product['id']); ?>"
                           class="btn btn-sm btn-primary">
                            Edit
                        </a>
                        <a href="<?php echo base_url('admin/products/delete/'.$product['id']); ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Delete this product?')">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php }
                } else { ?>
                <tr><td colspan="6">No products available.</td></tr>
            <?php } ?>
        </tbody>
    </table>
</div>
