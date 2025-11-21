<!-- Halaman Detail Produk -->
<div class="container py-5">
    <?php if (!empty($product)) { ?>
        <div class="row">
            <!-- Gambar produk -->
            <div class="col-md-6 mb-4">
                <div class="card border-0 shadow-sm">
                    <img
                        src="<?php echo base_url('public/assets/images/'.($product['image'] ?? 'placeholder.jpg')); ?>"
                        class="card-img-top product-detail-image"
                        alt="<?php echo htmlspecialchars($product['name'] ?? 'Product'); ?>"
                    >
                </div>
            </div>

            <!-- Info produk -->
            <div class="col-md-6">
                <h1 class="h3 mb-2">
                    <?php echo htmlspecialchars($product['name'] ?? ''); ?>
                </h1>

                <?php if (!empty($product['category_name'])) { ?>
                    <p class="text-muted mb-1">
                        Kategori: <?php echo htmlspecialchars($product['category_name']); ?>
                    </p>
                <?php } ?>

                <p class="h4 text-success mb-3">
                    Rp <?php echo number_format($product['price'] ?? 0, 0, ',', '.'); ?>
                </p>

                <p class="mb-2">
                    Stok:
                    <?php if (($product['stock'] ?? 0) > 0) { ?>
                        <span class="text-success fw-bold"><?php echo (int) $product['stock']; ?></span>
                    <?php } else { ?>
                        <span class="text-danger fw-bold">Habis</span>
                    <?php } ?>
                </p>

                <?php if (!empty($product['description'])) { ?>
                    <p class="mb-4">
                        <?php echo nl2br(htmlspecialchars($product['description'])); ?>
                    </p>
                <?php } ?>

                <!-- Tombol aksi -->
                <div class="d-flex gap-3 mb-4">
                    <?php if (($product['stock'] ?? 0) > 0) { ?>
                        <a
                            href="<?php echo site_url('cart/add/'.$product['id']); ?>"
                            class="btn btn-success"
                        >
                            <i class="bi bi-cart-plus"></i> Add to Cart
                        </a>
                    <?php } else { ?>
                        <button class="btn btn-secondary" disabled>
                            <i class="bi bi-cart-plus"></i> Stok Habis
                        </button>
                    <?php } ?>

                    <a
                        href="<?php echo site_url('favorites/toggle/'.$product['id']); ?>"
                        class="btn btn-outline-danger"
                    >
                        <i class="bi bi-heart"></i> Add to Favorites
                    </a>
                </div>

                <!-- Link kembali -->
                <a href="<?php echo site_url('products'); ?>"
                   class="d-inline-flex align-items-center text-decoration-none">
                    <i class="bi bi-arrow-left me-2"></i>
                    <span class="fw-medium">Kembali ke daftar produk</span>
                </a>
            </div>
        </div>
    <?php } else { ?>
        <!-- Jika produk tidak ditemukan -->
        <p>Produk tidak ditemukan.</p>
        <a href="<?php echo site_url('products'); ?>"
           class="d-inline-flex align-items-center text-decoration-none">
            <i class="bi bi-arrow-left me-2"></i>
            <span class="fw-medium">Kembali ke daftar produk</span>
        </a>
    <?php } ?>
</div>
