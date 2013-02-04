<?php

/**
 * Description of user
 *
 * @author Nicoleta
 * @package Osf_user
 */
class Users extends OSF_Controller {

    public function create()
    {
        $this->load->helper('url');
        $this->load->view("user/create");
    }

    /*
     * action will only be used for 
     * saving data from the registration form;
     */

    public function postCreate()
    {
        $this->load->model('user');
        $this->user->create($this->input->post());
    }

    public function postUse()
    {
        $this->load->model('user');
    }

}
