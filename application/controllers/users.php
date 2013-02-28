<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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
        $this->load->library('email');
        try {
            //if the validation doesn't pass it will throw an exception 
            //and jump to catch
            $this->_validatePostCreate();
            $postData = $this->input->post();
            $this->user->create($postData);
            $this->session->set_flashdata('message', 'You have succesfully registered! Please login to continue.');

            $this->email->from('osf-rss@email.com', 'Admin');
            $this->email->to($postData['email_adress']);

            $this->email->subject('Thank you for registering with osf-rss');
            $this->email->message("Welcome to your web app .This is your registration data:Username:" . $postData['username'] ."/Password:" . $postData['password']);
            $this->email->send();
            redirect(base_url());
        } catch (Exception $e) {
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

        if (!$postData['username']) {
            $_errorString .= '<p>Please enter a username!</p>';
        }
        if (!$postData['password']) {
            $_errorString .= '<p>Please enter a password!</p>';
        }
        if (!$postData['confirm_password'] || $postData['confirm_password'] != $postData['password']) {
            $_errorString .= '<p>Please enter the same password!</p>';
        }
        if (!$postData['email_adress']) {
            $_errorString .= '<p>Please enter an email address!</p>';
        }
        if ($_errorString) {
            throw new Exception($_errorString);
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
        } else {
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

    public function retrievePass()
    {
        $this->loadMainContent('user/retrievePass');
    }

    public function postRetrieve()
    {
        $this->load->model('user');
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';
        for ($i = 0; $i < 9; $i++) {
            $string .= $characters[rand(0, strlen($characters) - 1)];
        }
        $this->load->library('email');

        $this->email->from('osf-rss@email.com', 'Admin');
        $this->email->to($this->input->post('email'));

        $this->email->subject("Reset your Password!");
        $this->email->message("This is your new password: $string");
        try{
            $this->email->send();
        }
        catch(Exception $e){ 
            $this->session->set_flashdata('message', 'Unable to send email.Please try again later!');
        }
        
        if($user = $this->user->getUserByEmail($this->input->post('email'))){
           $user->setPassword($string);
           $this->session->set_flashdata('message', 'The new password has been sent. Please check your email!');        
        }else{
           $this->session->set_flashdata('message', 'The email has not been found!');
        }
        
        redirect(base_url());
        
         
    }
     
}