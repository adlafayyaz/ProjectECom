<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="container py-5">
    <?php if (!empty($product)) { ?>
        <div class="row g-5 align-items-start">
            <div class="col-md-5">
                <div class="product-detail-image">
                    <img
                        src="<?php echo base_url('public/assets/images/'.($product['image'] ?? 'placeholder.jpg')); ?>"
                        alt="<?php echo htmlspecialchars($product['name'] ?? 'Product'); ?>"
                    >
                </div>
            </div>

            <div class="col-md-7">
                <h2 class="fw-bold mb-2">
                    <?php echo htmlspecialchars($product['name'] ?? ''); ?>
                </h2>

                <?php if (!empty($product['category_name'])) { ?>
                    <p class="text-muted mb-1">
                        Kategori: <?php echo htmlspecialchars($product['category_name']); ?>
                    </p>
                <?php } ?>

                <div class="mb-2 text-success fw-bold">
                    Rp <?php echo number_format($product['price'] ?? 0, 0, ',', '.'); ?>
                </div>

                <p class="mb-1">
                    Stok:
                    <strong><?php echo (int) ($product['stock'] ?? 0); ?></strong>
                </p>

                <?php if (!empty($product['description'])) { ?>
                    <p class="text-muted mb-4">
                        <?php echo nl2br(htmlspecialchars($product['description'])); ?>
                    </p>
                <?php } ?>

                <div class="d-flex gap-3 mb-4">
                    <a
                        href="<?php echo site_url('cart/add/'.$product['id']); ?>"
                        class="btn btn-success <?php echo ((int) ($product['stock'] ?? 0) <= 0) ? 'disabled' : ''; ?>">
                        <i class="bi bi-cart"></i> Add to Cart
                    </a>

                    <a
                        href="<?php echo site_url('favorites/toggle/'.$product['id']); ?>"
                        class="btn btn-outline-danger">
                        <i class="bi bi-heart"></i> Add to Favorites
                    </a>
                </div>

                <a href="<?php echo site_url('products'); ?>" class="text-decoration-none">
                    &larr; Kembali ke daftar produk
                </a>
            </div>
        </div>
    <?php } else { ?>
        <p>Produk tidak ditemukan.</p>
        <a href="<?php echo site_url('products'); ?>" class="btn btn-link">
            &larr; Kembali ke daftar produk
        </a>
    <?php } ?>
</div>
