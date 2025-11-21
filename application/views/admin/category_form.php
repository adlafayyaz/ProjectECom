<!-- Form tambah/edit kategori -->
<h2 class="mb-4">
    <?php echo isset($category) ? 'Edit Category' : 'Add Category'; ?>
</h2>

<!-- Pesan error validasi -->
<?php if (validation_errors()) { ?>
    <div class="alert alert-danger"><?php echo validation_errors(); ?></div>
<?php } ?>

<form action="<?php echo isset($category)
    ? site_url('admin/categories/update/'.$category['id'])
    : site_url('admin/categories/store'); ?>"
      method="post">

    <!-- Input nama kategori -->
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input
            type="text"
            name="name"
            id="name"
            class="form-control"
            value="<?php echo isset($category['name'])
                ? htmlspecialchars($category['name'])
                : set_value('name'); ?>">
    </div>

    <!-- Input deskripsi kategori -->
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea
            name="description"
            id="description"
            class="form-control"
            rows="4"><?php echo isset($category['description'])
                ? htmlspecialchars($category['description'])
                : set_value('description'); ?></textarea>
    </div>

    <!-- Tombol submit & cancel -->
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="<?php echo site_url('admin/categories'); ?>" class="btn btn-secondary">Cancel</a>
</form>
