<?php

/**
 * Description of user
 *
 * @author Nicoleta
 * @package Osf_user
 */
class User extends CI_Model {

    public function create($data)
    {

        $this->load->database();

        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->email = $data['email_adress'];

        $this->db->insert('users', $this);
    }

    /**
     * verify if the username/password pair is valid;
     * 
     * @return bool
     */
    public function canLogin($username, $password)
    {
        $this->load->database();
        $query = $this->db->get_where('users', array('username' => $username, 'password' => $password));
        /* if it founds at least one row then its valid */
        if ($query->num_rows()) {
            return TRUE;
        } 
        
        return FALSE;
    }
    
    /**
     * 
     * @TODO implemented
     */
    public function getUserByUsername($username){
        $this->username = 'alttest';
        $this->id = 'asdasd';
        $this->password = 'asads';
        $this->email = 'asdadasdasd@aaa.ro';
        //return current class instance
        return $this;
    }

}