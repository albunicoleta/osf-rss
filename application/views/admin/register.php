<script>
    $(document).ready(function(){
        $("#admin-register").validate({
            rules: {
                password: "required",
                confirm_password: {
                    equalTo: "#password"
                }
            }
        });
    });
</script>
<div class="form-horizontal"> 
    <form id="admin-register" action="<?php echo base_url('admin/postRegister'); ?>" method="post" >
        <label for="username">Username</label>
        <input type="text" name="username" class="required" minlength="2"/>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="required"/>
        <label for="confirm password">Confirm password</label>
        <input type="password" id="confirm_password" name="confirm_password" class="required" />
        <input type="submit" name="Register" value="Register" />          
    </form>
</div>