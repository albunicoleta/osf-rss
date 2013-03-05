<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Description of rssFeed
 *
 * @author Nicoleta
 * @package Osf_rssFeed
 */
class rssFeed extends OSF_Controller {

    /**
     * render Rss Sources;
     */
    public function rssSources()
    {
        $this->loadMainContent('rss/rssSources');
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', 'You must be logged in to perform this action!');
            redirect(base_url());
        }
    }

    /**
     * render the adding rss form;
     */
    public function addRss()
    {
        $this->loadMainContent('rss/addRss');
    }

    /**
     * action will be used to save the rss link
     * in the table 'rss'
     * @throws Exception;
     */
    public function postAddRss()
    {
        try {
            $this->load->model('rss');
            $this->rss->create($this->input->post());
            $postData = $this->input->post();

            $this->load->model('users_rss');
            $this->users_rss->create($this->rss->getRssByLink($postData["link"])->id);
            $this->session->set_flashdata('message', 'Succesfully added!');
        } catch (Exception $e) {
            $this->session->set_flashdata('message', $e->getMessage());
        }
        redirect('rssFeed/listRss');
    }

    /**
     * action will be used to list all the rss links
     * added by the user in session;
     */
    public function listRss()
    {
        $this->load->model('rss');
        $this->load->library("pagination");
        try {
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
        } catch (Exception $e) {
            $this->session->set_flashdata('message', $e->getMessage());
            redirect(base_url());
        }
    }

    /**
     * displays the rss feed
     * action will be used to validate the rss link
     * @param type $arg
     * @throws Exception;
     */
    public function viewRss($arg)
    {
        $this->load->model('rss');

        $this->load->library('rssparser');
        if ($this->rss->getRssById($arg)) {
            try {
                $this->rssparser->set_feed_url($this->rss->getRssById($arg)->link);
                $rssData = $this->rssparser->getFeed(1000);
            } catch (Exception $e) {
                $this->session->set_flashdata('message', 'Invalid rss link or unable to access at the moment. Please try another');
                redirect(base_url('rssFeed/listRss'));
            }
            $this->loadMainContent(array('rss/viewRss', $rssData));
        } else {
            $this->session->set_flashdata('message', 'Unable to retrieve rss from database');
            redirect(base_url('rssFeed/listRss'));
        }
    }

    /**
     * display output of listRss action;
     */
    public function changeRss()
    {
        $this->listRss();
    }

    /**
     * AJAX method
     */
    public function updateRssLink()
    {
        //we only want this action to be used in AJAX calls
        //so redirect to homepage is there is no post data
        if (!($postData = $this->input->post())) {
            redirect(base_url());
        }
        $this->load->model('rss');
        $this->rss->getRssById($postData['id'])->setLink($postData['value']);
    }

    /**
     * AJAX method
     */
    public function deleteRss()
    {
        //we only want this action to be used in AJAX calls
        //so redirect to homepage is there is no post data
        if (!($postData = $this->input->post())) {
            redirect(base_url());
        }
        $this->load->model('rss');
        $this->rss->deleteRssById($postData['id']);
    }
    
    /**
     * AJAX method
     */
    public function setIsRead()
    {
        //we only want this action to be used in AJAX calls
        //so redirect to homepage is there is no post data
        if (!($postData = $this->input->post())) {
            redirect(base_url());
        }
        $this->load->model('rss');
        $this->rss->getRssById($postData['id'])->setIsRead($postData['status']);
    }
    
    /**
     * ajax method
     * action will set a favorite link
     * for the user in session;
     */
    public function setFavorite()
    {
        if (!($postData = $this->input->post())) {
            redirect(base_url());
        }
        $this->load->model('rss');
        $this->rss->getRssById($postData['id'])->setFavorite($postData['status']);
    }    

}

