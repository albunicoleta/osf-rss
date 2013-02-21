<?php

/**
 * Description of rss
 *
 * @author Nicoleta
 * @package Osf_rss
 */
class Rss extends Ci_Model {

    public function create($data)
    {
        $this->load->database();
        $this->link = $data['link'];
        $this->db->insert('rss', $this);

        return $this;
    }

    public function getRssByLink($link)
    {
        $this->load->database();
        $query = $this->db->get_where('rss', array('link' => $link));
        if ($query->num_rows()) {
            //fetch row data from db
            $row = $query->row();
            //set row data on instance props
            $this->link = $row->link;
            $this->id = $row->id;

            return $this;
        }
        return FALSE;
    }
    
    /**
     * Return an array of strings
     * 
     * @param mixed $userId
     * @return array
     */
    public function getRssListByUserId($userId)
    {
        $this->load->database();
        $collection = $this->db   
                    ->select('link')
                    ->from('rss')
                    ->join('users_rss','rss.id = users_rss.rss_id')
                    ->where('users_rss.user_id', $userId)
                    ->get()
                    ->result();
        
        $list = array();
        foreach ($collection as $rssLink){
            $list[] = $rssLink->link;
        }
        
        return $list;
        
    }

}

