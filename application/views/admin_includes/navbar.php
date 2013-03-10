<?php if ($adminUsername = $this->session->userdata(Admin::SESSION_KEY)): ?>
    <div style="float:left;margin-top:10px;">Logged in as <span style="color:blue;"><?php echo $adminUsername; ?></span></div>
    <div class="navbar-text pull-right"> 
        <a class="btn" href="<?php echo base_url('admin/register') ?>">Register new admin</a> 
        <a class="btn" href="<?php echo base_url('admin/logout') ?>">Logout</a> 
    </div>
<?php endif; ?>