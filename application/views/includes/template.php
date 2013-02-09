<html>
    <?php $this->load->view('includes/header'); ?>
    <body>
        <div class="navbar"> 
            <div class="navbar-inner">
                <div class="container">
                    <h3 class="brand"> OSF Global </h3>
                    <form class="navbar-form pull-right" action="<?php echo base_url('users/postLogin'); ?>" method="post">
                        <input type="text" name="username" placeholder="Username"/>
                        <input type="password" name="password" placeholder="Password"/>
                        <input type="submit" value="Sign In"/>
                    </form>    
                </div>
                
            </div>    
        </div>
        <div class="container">
            <?php $this->load->view($main_content); ?>
        </div>
        <div class="footer">
        <?php $this->load->view('includes/footer'); ?>
        </div>    
    </body>
    
</html>