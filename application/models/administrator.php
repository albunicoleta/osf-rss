<?php

/**
 * Description of administrator
 *
 * @author Nicoleta
 * @package Osf_administrator
 */
class Administrator extends CI_Model {

    /**
     * db table name
     */
    const TABLE_NAME = 'administrators';
    /**
     * @var int 
     */
    private $_id;
    
    /**
     * @var string 
     */
    private $_username;
    
    /**
     * @var string 
     */
    private $_password;
 
    /**
     * checks if $username in combination with $password
     * is valid for login
     * @param string $username
     * @param string $password
     * @return boolean
     */
    public function canLogin($username, $password)
    {
        $this->load->database();
        $query = $this->db->get_where('administrators', array('username' => $username, 'password' => $password));
        /* if it founds at least one row then its valid */
        if ($query->num_rows()) {
            $this->setUsername($username)->setPassword($password);
            return TRUE;
        }
        
        return FALSE;
    }

    /**
     * returns id property
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * returns username property
     * @return string
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * returns password property
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }
    
    /**
     * sets id property
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }
    
    /**
     * sets username property
     * @param string $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->_username = $username;
        return $this;
    }
    
    /**
     * sets password property
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->_password = $password;
        return $this;
    }
    
    /**
     * create a new administrator =
     * insert new row in 'administrators' table
     * 
     * @return $this
     */
    public function save()
    {
        $data = array(
            'username' => $this->_username,
            'password' => md5($this->_password)
        );
        
        if (!$this->db->insert(self::TABLE_NAME, $data)){
            throw new Exception('Could not save new administrator');
        }
        
        return $this;
    }
}
