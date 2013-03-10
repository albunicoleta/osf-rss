<table class="table">
    <thead>
    <th>ID</th>
    <th>Username</th>
    <th>Email</th>
</thead>
<tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo $user->id; ?></td>
            <td><?php echo $user->username; ?></td>
            <td><?php echo $user->email; ?></td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>

<div class="pagination">
    <?php echo $this->pagination->create_links(); ?>
</div>
