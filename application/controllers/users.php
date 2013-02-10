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

        if ($this->user->canLogin($postData["username"], $postData["password"])) {
            /* we set user data on session */
            $loggedInUser = $this->user->getUserByUsername($postData["username"]);
            $this->session->set_userdata('username', $postData["username"]);
            $this->session->set_userdata('password', $postData["password"]);
            $this->session->set_userdata('email', $loggedInUser->email);
            $this->session->set_userdata('id', $loggedInUser->id);
        }
        redirect(base_url());
    }

}
