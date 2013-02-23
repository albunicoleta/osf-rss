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
//        var_dump($this->user->canCreate($this->input->post()));
//        die();
        try{
            //if the validation doesn't pass it will throw an exception 
            //and jump to catch
            $this->_validatePostCreate();
            $this->user->create($this->input->post());
            $this->session->set_flashdata('message', 'You have succesfully registered! Please login to continue.');
            redirect(base_url());
        } catch(Exception $e) {
            $this->session->set_flashdata('message', $e->getMessage());
            redirect(base_url('users/create'));
        }
                
    }
    
    /**
     * builds an error string for the registration form
     * @throws Exception
     */
    protected function _validatePostCreate()
    {
        $_errorString = '';
        $postData = $this->input->post();
        
        if (!$postData['username']){
            $_errorString .= '<p>Please enter a username!</p>';
        } 
        if (!$postData['password']){
            $_errorString .= '<p>Please enter a password!</p>';
        }
        if (!$postData['confirm_password'] || $postData['confirm_password'] != $postData['password']){
            $_errorString .= '<p>Please enter the same password!</p>';
        }
        if (!$postData['email_adress']){
            $_errorString .= '<p>Please enter an email adress!</p>';
        }
        if ($_errorString){
            throw new Exception ($_errorString);
        }
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
            $this->session->set_userdata('email', $loggedInUser->email);
            $this->session->set_userdata('id', $loggedInUser->id);
        }else{
            $this->session->set_flashdata('message', 'Your username or password is incorrect!');
        }
        redirect(base_url());      
    }

    public function logout()
    {
        if ($this->session->userdata('username')) {
            //unset manually all user data because 
            //session destroy disabled flash functionallity
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('email');
            $this->session->unset_userdata('id');
            $this->session->set_flashdata('message', 'You have succesfully logged out!');
        }
        redirect(base_url());
    }

    public function edit()
    {
        $this->loadMainContent('user/edit');
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', 'You must be logged in to perform this action!');
            redirect(base_url());
        }
    }

    public function postEdit()
    {
        $this->load->model('user');
        $this->user->update($this->input->post());
        redirect(base_url());
            
    }
        
    public function homepage()
    {
        redirect(base_url());
    }    
    

}
