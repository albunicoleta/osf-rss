<?php

/**
 * Description of admin
 *
 * @author Nicoleta
 * @package Osf_admin
 */
class Admin extends OSF_Controller {
    
    /**
     * render the admin login form
     */
    public function index()
    {
        $this->loadMainContent('admin/login');
    }    
    
    public function postLogin()
    {
        
    }    
}

