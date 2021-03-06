<html>
    <?php $this->load->view('includes/header'); ?>
    <body>
        <div id="wrap">
            <div class="container">
                <div class="navbar"> 
                    <div class="navbar-inner">
                        <div class="container">
                            <a class="brand" href="<?php echo base_url('users/homepage') ?>">OSF Global</a>
                            <!--                    <h3 class="brand"> OSF Global </h3>-->
                            <?php /* if username exists in session then we have a logged in user */ ?>
                            <?php if ($this->session->userdata('username')): ?>
                                <div class="navbar-text pull-right">
                                    Hello <?php echo $this->session->userdata('username') ?>!
                                    <a class="btn" href="<?php echo base_url('users/edit') ?>">Edit account</a>
                                    <a class="btn" href="<?php echo base_url('rssFeed/rssSources') ?>">Rss Sources</a>
                                    <a class="btn" href="<?php echo base_url('users/logout') ?>">Logout</a>                          
                                </div>

                            <?php else: ?>
                                <form class="navbar-form pull-right" action="<?php echo base_url('users/postLogin'); ?>" method="post">
                                    <input type="text" name="username" placeholder="Username"/>
                                    <input type="password" name="password" placeholder="Password"/>
                                    <input class="btn" type="submit" value="Sign In"/>                                   
                                    <a class="btn" href="<?php echo base_url('users/create') ?>"> Register </a>
                                    <a class="btn" href="<?php echo base_url('users/retrievePass') ?>">Forgot password </a>
                                </form>
                            <?php endif; ?>   
                        </div>

                    </div>    
                </div>
                <div class="container">
                    <?php if ($this->session->flashdata('message')): ?>
                        <div class="alert"><?php echo $this->session->flashdata('message'); ?></div>
                    <?php endif; ?>
                    <?php $this->load->view($main_content); ?>
                </div>
            </div>
            <div id="push"></div>
        </div>
        <div id="footer">
            <?php $this->load->view('includes/footer'); ?>
        </div>    
    </body>

</html>