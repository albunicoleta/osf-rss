<?php

/**
 * Description of admin
 *
 * @author Nicoleta
 * @package Osf_admin
 */
class Admin extends OSF_Controller {
    
    const SESSION_KEY = 'admin_username';
    
    public function __construct()
    {
        parent::__construct();
        if(!$this->_isAdminLoggedIn() 
            && $this->router->fetch_method()!= 'login' 
            && $this->router->fetch_method()!= 'postLogin'){
            $this->session->set_flashdata('message', 'You must be logged in to perform this action!');
            redirect(base_url('admin/login'));
        }
    }
    
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
            $this->_loginAdmin();
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
    
    private function _loginAdmin()
    {
        $this->load->model('administrator');
        $this->session->set_userdata(self::SESSION_KEY, $this->administrator->getUsername());
    }
    
    private function _clearSession()
    {
        $this->session->unset_userdata(self::SESSION_KEY);
    }
    
    private function _isAdminLoggedIn()
    {
        if($this->session->userdata(self::SESSION_KEY)){
            return TRUE;            
        }
        return FALSE;
    }
}

