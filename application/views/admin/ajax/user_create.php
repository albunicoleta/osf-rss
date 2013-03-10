<form id="admin-user-create" method="post" action="<?php echo base_url('users/add'); ?>">
    <label for="username">Username</label>
    <input type="text" name="username"/>
    <label for="password">Passwrod</label>
    <input type="password" name="password"/>
    <label for="email_adress">Email</label>
    <input type="text" name="email_adress"/>
    <input type="submit" value="Submit">
</form>
