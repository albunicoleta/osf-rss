<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends OSF_Controller {

    public function index()
    {
        $this->loadMainContent('welcome/index');
    }

}
