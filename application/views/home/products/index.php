<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="fw-bold mb-1">All Products</h2>
            <p class="text-muted mb-0">Temukan outfit terbaikmu di sini.</p>
        </div>

        <?php if (!empty($categories)) { ?>
            <!-- Filter kategori -->
            <form method="get" class="d-flex align-items-center gap-2">
                <label class="mb-0 me-1 fw-semibold">Filter Kategori:</label>
                <select name="category" class="form-select" onchange="this.form.submit()">
                    <option value="" <?php echo ($selected_category === '') ? 'selected' : ''; ?>>Semua</option>
                    <?php foreach ($categories as $cat) { ?>
                        <option value="<?php echo htmlspecialchars($cat['slug']); ?>"
                            <?php echo ($selected_category === $cat['slug']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </option>
                    <?php } ?>
                </select>
            </form>
        <?php } ?>
    </div>

    <?php if (empty($products)) { ?>

        <div class="alert alert-light border text-center mt-4">
            Belum ada produk untuk kategori ini.
        </div>

    <?php } else { ?>

        <div class="row g-4">
            <?php foreach ($products as $product) { ?>
                <div class="col-md-4">
                    <div class="card product-card h-100">
                        <img
                            src="<?php echo base_url('public/assets/images/'.($product['image'] ?? 'placeholder.jpg')); ?>"
                            class="card-img-top"
                            alt="<?php echo htmlspecialchars($product['name'] ?? 'Product'); ?>"
                        >

                        <div class="card-body d-flex flex-column">
                            <div class="product-card-title mb-1">
                                <?php echo htmlspecialchars($product['name'] ?? ''); ?>
                            </div>

                            <div class="product-card-category mb-1 text-muted">
                                <?php echo htmlspecialchars($product['category_name'] ?? ''); ?>
                            </div>

                            <div class="product-card-price mb-3 fw-bold text-success">
                                Rp <?php echo number_format($product['price'] ?? 0, 0, ',', '.'); ?>
                            </div>

                            <div class="mt-auto d-flex justify-content-between">
                                <a href="<?php echo site_url('products/detail/'.($product['slug'] ?? '')); ?>"
                                   class="btn btn-outline-primary btn-sm">
                                    View Detail
                                </a>

                                <div class="d-flex gap-2">
                                    <a
                                        href="<?php echo site_url('cart/add/'.$product['id']); ?>"
                                        class="btn btn-success btn-sm <?php echo ((int) ($product['stock'] ?? 0) <= 0) ? 'disabled' : ''; ?>">
                                        <i class="bi bi-cart"></i> Cart
                                    </a>

                                    <a
                                        href="<?php echo site_url('favorites/toggle/'.$product['id']); ?>"
                                        class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-heart"></i>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

    <?php } ?>
</div>
