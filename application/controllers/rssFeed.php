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

        $this->load->library('rssparser');
        $this->rssparser->set_feed_url('http://www.feedforall.com/sample.xml');
        $this->rssparser->set_cache_life(30);
        $rss = $this->rssparser->getFeed(6);
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
    }    
}


