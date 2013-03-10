<?php if ($this->session->userdata(Admin::SESSION_KEY)): ?>
    <div class="navbar-text pull-right"> 
        <a class="btn" href="<?php echo base_url('admin/register') ?>">Register new admin</a> 
        <a class="btn" href="<?php echo base_url('admin/logout') ?>">Logout</a> 
    </div>
<?php endif; ?>