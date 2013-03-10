<?php if (count($users)): ?>
    <table class="table">
        <thead>
        <th></th>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td>
                    <i class="icon-remove-sign" onclick="deleteUser(<?php echo $user->id; ?>,this)"></i>
                    <i class="icon-pencil"></i>
                </td>
                <td><span class="user-id"><?php echo $user->id; ?></span></td>
                <td><input class="user-username" type="text" name="username" value="<?php echo $user->username; ?>"/></td>
                <td><input class="user-email" type="text" name="email" value="<?php echo $user->email; ?>"/></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>

    <div class="pagination">
        <?php echo $this->pagination->create_links(); ?>
    </div>
<?php else: ?>
    <p>There are currently no registered users</p>
<?php endif; ?>

