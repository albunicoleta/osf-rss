<html>
    <head>
        <style>
            body {background-color: lightblue;}
            label {display:block;}
        </style>
    </head>
    <body>
        <form action="<?php echo base_url('users/postLogin'); ?>" method="post" />
        <label for="username">Username</label>
        <input type="text" name="username"/>
        <label for="password">Password</label>
        <input type="password" name="password"/>   
        <input type="submit" name="Register" value="Log In"/>
    </form>  
    </body>    
</html>
<?php echo $this->session->userdata('username') ?>
