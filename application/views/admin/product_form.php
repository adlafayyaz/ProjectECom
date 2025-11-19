<h2 class="mb-4">
    <?php echo isset($product) ? 'Edit Product' : 'Add Product'; ?>
</h2>

<?php if (validation_errors()) { ?>
    <div class="alert alert-danger"><?php echo validation_errors(); ?></div>
<?php } ?>

<?php if ($this->session->flashdata('error')) { ?>
    <div class="alert alert-danger">
        <?php echo $this->session->flashdata('error'); ?>
    </div>
<?php } ?>

<form action="<?php echo isset($product)
        ? site_url('admin/products/update/'.$product['id'])
        : site_url('admin/products/store'); ?>"
      method="post" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control"
               value="<?php echo isset($product['name']) ? htmlspecialchars($product['name']) : set_value('name'); ?>">
    </div>

    <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select name="category_id" id="category_id" class="form-select">
            <option value="">Select category</option>
            <?php if (!empty($categories)) { ?>
                <?php foreach ($categories as $cat) { ?>
                    <option value="<?php echo $cat['id']; ?>"
                        <?php
                        $selected = '';
                    if (set_value('category_id') === (string) $cat['id']) {
                        $selected = 'selected';
                    } elseif (isset($product['category_id']) && (int) $product['category_id'] === (int) $cat['id']) {
                        $selected = 'selected';
                    }
                    echo $selected;
                    ?>>
                        <?php echo htmlspecialchars($cat['name']); ?>
                    </option>
                <?php } ?>
            <?php } ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="number" name="price" id="price" class="form-control"
               value="<?php echo isset($product['price']) ? htmlspecialchars($product['price']) : set_value('price'); ?>">
    </div>

    <div class="mb-3">
        <label for="stock" class="form-label">Stock</label>
        <input type="number" name="stock" id="stock" class="form-control"
               value="<?php echo isset($product['stock']) ? htmlspecialchars($product['stock']) : set_value('stock'); ?>">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control" rows="4"><?php
            echo isset($product['description'])
                ? htmlspecialchars($product['description'])
                : set_value('description');
    ?></textarea>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <?php if (isset($product) && !empty($product['image'])) { ?>
            <div class="mb-2">
                <img src="<?php echo base_url('public/assets/images/'.$product['image']); ?>"
                     alt="Product Image" class="img-thumbnail" width="150">
            </div>
        <?php } ?>
        <input type="file" name="image" id="image" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <a href="<?php echo site_url('admin/products'); ?>" class="btn btn-secondary">Cancel</a>
</form>
