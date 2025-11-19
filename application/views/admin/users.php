<h2>Manage Users</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($users)) {
            foreach ($users as $u) { ?>
            <tr>
                <td><?php echo htmlspecialchars($u['id']); ?></td>
                <td><?php echo htmlspecialchars($u['name']); ?></td>
                <td><?php echo htmlspecialchars($u['email']); ?></td>
                <td><?php echo htmlspecialchars($u['role']); ?></td>
            </tr>
        <?php }
            } else { ?>
            <tr><td colspan="4">No users found.</td></tr>
            <?php } ?>
    </tbody>
</table>