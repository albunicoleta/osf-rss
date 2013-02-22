<script type="text/javascript" src="<?php echo base_url(); ?>bootstrap/js/jquery-1.9.1.min.js" ></script>
<script type="text/javascript" src="<?php echo base_url(); ?>bootstrap/js/jquery.validate.js"></script>
<script>
    $(document).ready(function(){
        $("#form-create").validate({
            rules: {
                field: {
                    required: true,
                    email: true
                },
                password: "required",
                confirm_password: {
                    equalTo: "#password"
                }
            }
        });
    });
</script>
<form id="form-create" class="form-center" action="<?php echo base_url('users/postCreate'); ?>" method="post">
    <label for="username">Username</label>
    <input type="text" name="username" class="required" minlength="2"/>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" class="required"/>
    <label for="confirm password">Confirm password</label>
    <input type="password" id="confirm_password" name="confirm_password" class="required" />
    <label for="email"> E-mail </label>
    <input type="text"  name="email_adress" class="required email"/>
    <input type="submit" name="Register" value="Register" />           
</form>
