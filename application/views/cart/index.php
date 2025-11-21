<!-- Halaman Cart -->
<div class="container py-5">
    <h1 class="h3 mb-4">Your Cart</h1>

    <?php if (!empty($items)) { ?>
        <!-- Form update cart -->
        <form method="post" action="<?php echo site_url('cart/update'); ?>">
            <table class="table cart-table align-middle">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th style="width: 120px;">Price</th>
                        <th style="width: 120px;">Quantity</th>
                        <th style="width: 140px;">Subtotal</th>
                        <th style="width: 110px;"></th>
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
                            <td>
                                <div class="cart-product-info">
                                    <img
                                        src="<?php echo base_url('public/assets/images/'.($item['image'] ?? 'placeholder.jpg')); ?>"
                                        alt="<?php echo htmlspecialchars($item['name']); ?>"
                                    >
                                    <span><?php echo htmlspecialchars($item['name']); ?></span>
                                </div>
                            </td>
                            <td>
                                Rp <?php echo number_format($item['price'], 0, ',', '.'); ?>
                            </td>
                            <td>
                                <input
                                    type="number"
                                    name="quantity[<?php echo $item['product_id']; ?>]"
                                    value="<?php echo (int) $item['quantity']; ?>"
                                    min="1"
                                    class="form-control form-control-sm"
                                >
                            </td>
                            <td>
                                Rp <?php echo number_format($subtotal, 0, ',', '.'); ?>
                            </td>
                            <td>
                                <a href="<?php echo site_url('cart/remove/'.$item['product_id']); ?>"
                                   class="btn btn-sm btn-outline-danger">
                                    Remove
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- Total + tombol update & checkout -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <p class="mb-0 fw-bold">
                    Total: Rp <?php echo number_format($total, 0, ',', '.'); ?>
                </p>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Update Cart
                    </button>

                    <!-- Tombol buka modal checkout -->
                    <button type="button"
                            class="btn btn-success"
                            data-bs-toggle="modal"
                            data-bs-target="#checkoutModal">
                        Checkout
                    </button>
                </div>
            </div>
        </form>

        <!-- Modal konfirmasi checkout -->
        <div class="modal fade checkout-modal" id="checkoutModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title">Konfirmasi Pembelian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-2">
                            Apakah Anda yakin ingin menyelesaikan pembelian ini?
                        </p>
                        <p class="mb-0 text-muted">
                            Semua item di keranjang akan dianggap sudah dipesan dan diteruskan ke admin untuk diproses.
                        </p>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <a href="<?php echo site_url('cart/checkout'); ?>" class="btn btn-success">
                            Ya, Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <!-- Jika cart kosong -->
        <p>Keranjang Anda masih kosong.</p>
        <a href="<?php echo site_url('products'); ?>" class="btn btn-primary">
            Continue Shopping
        </a>
    <?php } ?>
</div>
