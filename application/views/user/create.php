<script type="text/javascript" src="<?php echo base_url(); ?>bootstrap/js/jquery-1.9.1.min.js" ></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>bootstrap/js/jquery.validate.js"></script>
		<script type="text/javascript">
			 $(document).ready(function(){
				$("#form-create").validate();
			 });
</script>
<form id="form-create" class="form-center" action="<?php echo base_url('users/postCreate'); ?>" method="post">
    <label for="username">Username</label>
    <input type="text" name="username" class="required" minlength="2"/>
    <label for="password">Password</label>
    <input type="password" name="password" class="required"/>
    <label for="confirm password">Confirm password</label>
    <input type="password" name="confirm_password" class="required"/>
    <label for="email"> E-mail </label>
    <input type="text" name="email_adress" class="required" />
    <input type="submit" name="Register" value="Register" />           
</form>
