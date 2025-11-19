<!-- Hero Section -->
<section class="hero-section position-relative">
    <div class="hero-bg"
         style="background-image: url('<?php echo base_url('public/assets/images/hero.jpg'); ?>');">
    </div>
    <div class="hero-overlay"></div>

    <div class="hero-content text-left text-white">
        <h1 class="display-4 fw-bold mb-3">
            Timeless Fashion,<br>
            <em>Conscious Choices.</em>
        </h1>
        <p class="lead mb-4">
            Sustainably designed, effortlessly worn. Our pieces are made with premium materials,
            and wardrobe that stands the test of time.
        </p>

        <a href="<?php echo site_url('products'); ?>" class="btn btn-light btn-lg rounded-pill px-4">
            Explore the Collections
        </a>
    </div>
</section>

<!-- Section: Find Your Look -->
<section class="py-5 text-center find-look-section">
    <div class="container">
        <h2 class="mb-4 fw-bold">Find Your Look</h2>

        <div class="row g-4">

            <!-- WOMEN -->
            <div class="col-md-4">
                <a href="<?php echo site_url('products?category=2'); ?>" class="look-box">
                    <div class="look-img"
                         style="background-image:url('<?php echo base_url('public/assets/images/women.jpg'); ?>');">
                    </div>
                    <span class="look-label">Women</span>
                </a>
            </div>

            <!-- MEN -->
            <div class="col-md-4">
                <a href="<?php echo site_url('products?category=1'); ?>" class="look-box">
                    <div class="look-img"
                         style="background-image:url('<?php echo base_url('public/assets/images/men.jpg'); ?>');">
                    </div>
                    <span class="look-label">Men</span>
                </a>
            </div>

            <!-- KIDS -->
            <div class="col-md-4">
                <a href="<?php echo site_url('products?category=3'); ?>" class="look-box">
                    <div class="look-img"
                         style="background-image:url('<?php echo base_url('public/assets/images/kids.jpg'); ?>');">
                    </div>
                    <span class="look-label">Kids</span>
                </a>
            </div>

        </div>
    </div>
</section>
