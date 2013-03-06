<?php

/**
 * Description of administrator
 *
 * @author Nicoleta
 * @package Osf_administrator
 */
class Administrator extends CI_Model {

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
}
