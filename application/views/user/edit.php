<script>
    $(document).ready(function(){
        $("#form-edit").validate();
    });
</script>
<form id="form-edit" action="<?php echo base_url('users/postEdit'); ?>" method="post">
    <label for="username"> New username </label>
    <input type="text" name="username"/>
    <label for="password>"> New password </label>
    <input type="password" name="password"/>
    <label for="email>"> New email </label>
    <input type="text" name="email" class="email"/>
    <input type="submit" name="submit" value="Submit"/>
</form>
