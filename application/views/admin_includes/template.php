<html>
    <?php $this->load->view('admin_includes/header'); ?>
    <body>
        <div id="wrap">
            <div class="container">
                <div class="navbar"> 
                    <div class="navbar-inner">
                        <div class="container">
                            <?php $this->load->view('admin_includes/navbar'); ?>
                            <?php if ($this->session->flashdata('message')): ?>
                                <div class="alert">
                                    <?php echo $this->session->flashdata('message'); ?>
                                </div>
                            <?php endif; ?>
                            <?php $this->load->view($main_content); ?>
                            <div id="footer">
                                <?php $this->load->view('admin_includes/footer'); ?>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>    
</html>