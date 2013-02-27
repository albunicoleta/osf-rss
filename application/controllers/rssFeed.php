<?php

/**
 * Description of rssFeed
 *
 * @author Nicoleta
 * @package Osf_rssFeed
 */
class rssFeed extends OSF_Controller {

    public function rssSources()
    {
        $this->loadMainContent('rss/rssSources');
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', 'You must be logged in to perform this action!');
            redirect(base_url());
        }
    }

    public function addRss()
    {
        $this->loadMainContent('rss/addRss');
    }

    public function postAddRss()
    {
        $this->load->model('rss');
        $this->rss->create($this->input->post());
        $postData = $this->input->post();

        $this->load->model('users_rss');
        $this->users_rss->create($this->rss->getRssByLink($postData["link"])->id);
        foreach ($this->rss->getRssListByUserId($this->session->userdata('id')) as $rssLink) {
            echo $rssLink . '<br/>';
        }
        die();
    }
    
    public function listRss()
    {
        $this->load->model('rss');
        $this->load->library("pagination");
        try{
            $config = array();
            $config["base_url"] = base_url('rssFeed/listRss');
            $config["total_rows"] = $this->rss->recordCountForCurrentUser();
            $config["per_page"] = 10;
            $config["uri_segment"] = 3;	 
            $config['num_links'] = 3;

            $this->pagination->initialize($config);	 

            $data = $this->rss
                        ->setOffset($this->uri->segment(3))
                        ->setLimit($config['per_page'])
                        ->getRssListForCurrentUser();

            $this->loadMainContent(array('rss/listRss', $data));
        } catch (Exception $e){
            $this->session->set_flashdata('message',$e->getMessage());
            redirect(base_url());
        }
    }

    public function viewRss($arg)
    {
        $this->load->model('rss');
        
        $this->load->library('rssparser');
        if ($this->rss->getRssById($arg)) {
            try {
                $this->rssparser->set_feed_url($this->rss->getRssById($arg)->link);
                $rssData = $this->rssparser->getFeed(6);

                echo $this->email->print_debugger();
            } catch (Exception $e) {
                echo 'stupid link';
            }
            //var_dump();
            //die();
        }
    }
    
    public function changeRss()
    {
        $this->listRss();
    }

}

