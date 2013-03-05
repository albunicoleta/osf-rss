<?php

/**
 * Description of rss
 *
 * @author Nicoleta
 * @package Osf_rss
 */
class Rss extends Ci_Model {

    /**
     * @var string $link
     */
    public $link;
    /** 
     * @var int $id
     */
    public $id;
    /**
     * @var bool 
     */
    public $is_read;
    /**
     * @var bool 
     */
    public $favorite;
    /**
     *
     * @var int 
     */
    private $_limit;
    /**
     *
     * @var int
     */
    private $_offset = 0;
    
    /**
     * returns the id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * return $this->_limit
     * @return int
     */
    public function getLimit()
    {
        if ($this->_limit === null){
            $this->setLimit($this->recordCount());
        }
        return $this->_limit;
    }
    
    /**
     * return $this->_offset
     * @return int
     */
    public function getOffset()
    {
        return $this->_offset;
    }
    
    /**
     * set _limit for current instance
     * @param int $limit
     * @return $this
     */
    public function setLimit($limit){
        $this->_limit = $limit;
        
        return $this;
    }
    
    /**
     * set _offset for current instance
     * @param int $offset
     * @return $this
     */
    public function setOffset($offset){
        $this->_offset = $offset;
        
        return $this;
    }
    
    /**
     * saves a new row in the 'rss' table
     * the link is unique
     * @throws Exception;
     * @return $this
     */
    public function create($data)
    {
        $this->load->database();
        $this->link = $data['link'];        
        if ($this->db->insert('rss', $this)){
            return $this;
        }
        else {
            throw new Exception('Rss already added !');   
        }
        
        return $this;
    }

    /**
     * return a rss by the provided link;
     * @return string
     */
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
     * @param int $userId
     * @return array
     */
    public function getRssListByUserId($userId)
    {
        $this->load->database();
        return $this->db
            ->select('rss_id,link,is_read,favorite')
            ->from('rss')
            ->join('users_rss', 'rss.id = users_rss.rss_id')
            ->where('users_rss.user_id', $userId)
            ->limit($this->getLimit(),$this->getOffset())
            ->get()
            ->result();

    }
    
    /**
     * returns the list with the favorite rss
     * added by the user in session
     * @throws Exception;
     * @return mixed either a result object or array
     */
    public function getFavoriteRssListForCurrentUser()
    {
        if (!$this->session->userdata('id')){
            throw new Exception('No user logged in');
        }
        $this->load->database();
        return $this->db
            ->select('rss_id,link,is_read,favorite')
            ->from('rss')
            ->join('users_rss', 'rss.id = users_rss.rss_id')
            ->where('users_rss.user_id', $this->session->userdata('id'))
            ->where('favorite',1)
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
     * returns instance with the param id
     * 
     * @param int $id
     * @return mixed either $this or FALSE
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
        
        return FALSE;
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
    
    /**
     * 
     * sets new value for link column in db 
     * for current instance
     * 
     * @param string $link
     * @return $this
     */
    public function setLink($link)
    {
        $this->load->database();
        $data = array('link' => $link);
        
        $this->db->where('id', $this->getId());
        $this->db->update('rss',$data);
        
        return $this;
    }
    
    /**
     * sets new value for 'is_read' column in db
     * for current instance
     * 
     * @param bool
     * @return $this 
     */
    public function setIsRead($value)
    {
        $this->load->database();
        $data = array('is_read' => $value);
        
        $this->db->where('id', $this->getId());
        $this->db->update('rss',$data);
        
        return $this;
    }
    
    /**
     * getter for 'favorite' property
     * 
     * @return bool
     */
    public function getFavorite()
    {
        return $this->favorite;
    }
    
    /**
     * sets new value for 'favorite' column in db
     * for current instance
     * 
     * @param bool $value
     * @return $this
     */
    public function setFavorite($value)
    {
        $this->load->database();
        $data = array('favorite' => $value);
        
        $this->db->where('id', $this->getId());
        $this->db->update('rss',$data);
        
        return $this;
    }
    
    /**
     * 
     * getter for 'is_read' property
     * 
     * @return bool
     */
    public function getIsRead()
    {
        return $this->is_read;
    }
    
    /**
     * this action will delete a row from
     * the 'rss' table
     * @param type $id;
     * @return $this
     */
    public function deleteRssById($id)
    {
        $this->load->database();
        $this->db->delete('rss', array('id' => $id));
        
        return $this;
    }
}

