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
        $this->loadAdminContent('admin/login');
    }    
    
    public function postLogin()
    {
        //1. get post data
        $postData = $this->input->post();
        $this->load->model('administrator');
        
        if ($this->administrator->canLogin($postData["username"], $postData["password"])) {
            /* we set user data on session */
            $this->session->set_flashdata('message', 'Welcome admin!');
        } else {
            $this->session->set_flashdata('message', 'Your username or password is incorrect!');
        }
        redirect(base_url());
        
        
    }    
}

