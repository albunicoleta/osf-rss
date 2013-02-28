<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends OSF_Controller {

    public function index()
    {
        $this->load->model('rss');
        $data = '';
        if ($this->session->userdata('id')){
            $data = $this->rss->getFavoriteRssListForCurrentUser();
        }        
        $this->loadMainContent(array('welcome/index',$data));
    }

}
