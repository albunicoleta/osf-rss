<html>
    <?php $this->load->view('admin_includes/header'); ?>
    <body>
        <div id="wrap">
            <div class="container">
                <div class="navbar"> 
                    <div class="navbar-inner">
                        <div class="container">
                            <?php if ($this->session->flashdata('message')): ?>
                                <div class="alert">
                                    <?php echo $this->session->flashdata('message'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="form-horizontal">    
                                <?php $this->load->view($main_content); ?>
                            </div>    
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