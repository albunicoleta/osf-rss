<?php

/**
 * Description of users_rss
 *
 * @author Nicoleta
 * @package Osf_users_rss
 */
class Users_rss extends CI_Model {

    public $id;
    public $user_id;
    public $rss_id;

    /*  
     * this method saves a new row in the users_rss table
     */
    public function create($rssId, $userId = null)
    {
        $this->load->database();

        if ($userId === null) {
            $this->user_id = $this->session->userdata('id');
        } else {
            $this->user_id = $userId;
        }
        
        $this->rss_id = $rssId['rssId'];
        
        $this->db->insert('users_rss', $this);    
    }

}

