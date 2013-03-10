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
        $this->login();
    }
    
    public function login()
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
        redirect(base_url('admin'));
    }   
    
    public function register()
    {
        $this->loadAdminContent('admin/register');
    }
    
    public function postRegister()
    {
        $postData = $this->input->post();
        if(!$postData){
            redirect(base_url('admin/register'));            
        }
        $this->load->model('administrator');
        $this->administrator->setUsername($postData["username"])->setPassword($postData["password"]);
        try{
            $this->administrator->save();
            $this->session->set_flashdata('message','Admin account succesfully created!');
        }
        catch (Exception $e){
            $this->session->set_flashdata('message','This username already exists in the database!');
        }
        redirect(base_url('admin/register'));
    }
    
}

