<?php

/**
 * Description of admin
 *
 * @author Nicoleta
 * @package Osf_admin
 */
class Admin extends OSF_Controller {
    
    public function login()
    {
        $this->loadMainContent('admin/login');
    }    
    
}

