<?php

/**
 * Description of user
 *
 * @author Nicoleta
 * @package Osf_user
 */
class Users extends OSF_Controller {

    /**
     * render the registration form;
     */
    public function create()
    {
        $this->load->helper('url');
        $this->loadMainContent('user/create');
    }

    /**
     * action will only be used for 
     * saving data from the registration form;
     */
    public function postCreate()
    {
        $this->load->model('user');
        $this->user->create($this->input->post());
    }
    
    /**
     * render login form;
     */
    public function login()
    {
        $this->load->helper('url');
        $this->loadMainContent('user/login');
    }
    
    /**
     * action will only be used for 
     * logging in valid users;
     */
    public function postLogin()
    {
        $postData = $this->input->post();
        $this->load->model('user');
        if ($this->user->canLogin($postData["username"], $postData["password"])){
            /* we set user data on session */
            $this->session->set_userdata('username',$postData['username']);
            /** @TODO set email/user_id on session as well */
        }
    }

}
