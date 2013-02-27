<?php

/**
 * Description of rss
 *
 * @author Nicoleta
 * @package Osf_rss
 */
class Rss extends Ci_Model {

    public $link;
    public $id;
    
    private $_limit;
    private $_offset = 0;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getLimit()
    {
        if ($this->_limit === null){
            $this->setLimit($this->recordCount());
        }
        return $this->_limit;
    }
    
    public function getOffset()
    {
        return $this->_offset;
    }
    
    public function setLimit($limit){
        $this->_limit = $limit;
        
        return $this;
    }
    
    public function setOffset($offset){
        $this->_offset = $offset;
        
        return $this;
    }
    
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
        return $this->db
            ->select('rss_id,link')
            ->from('rss')
            ->join('users_rss', 'rss.id = users_rss.rss_id')
            ->where('users_rss.user_id', $userId)
            ->limit($this->getLimit(),$this->getOffset())
            ->get()
            ->result();

    }
    
    /**
     * Returns an array of rss for currently logged in user
     * 
     * @return array
     * @throws Exception
     */
    public function getRssListForCurrentUser()
    {
        if (!$this->session->userdata('id')){
            throw new Exception('No user logged in');
        }
        return $this->getRssListByUserId($this->session->userdata('id'));
    }

    /**
     * @return object
     */
    public function getRssById($id)
    {
        $this->load->database();
        $query = $this->db->get_where('rss', array('id' => $id));

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->id = $row->id;
            $this->link = $row->link;
            return $this;
        }
    }
    
    /**
     * Returns total rows number
     * 
     * @return int
     */
    public function recordCount()
    {
        return $this->db->count_all('rss');
    }
    
    /**
     * Return total rows number for current user
     * 
     * @return int
     */
    public function recordCountForCurrentUser()
    {
        $this->load->database();
        return $this->db
            ->select('link')
            ->from('rss')
            ->join('users_rss', 'rss.id = users_rss.rss_id')
            ->where('users_rss.user_id', $this->session->userdata('id'))
            ->count_all_results();
    }
    
    public function setLink($link)
    {
        $this->load->database();
        $data = array('link' => $link);
        
        $this->db->where('id', $this->getId());
        $this->db->update('rss',$data);
        
        return $this;
    }
    
    public function deleteRssById($id)
    {
        $this->load->database();
        $this->db->delete('rss', array('id' => $id)); 
    }
}

