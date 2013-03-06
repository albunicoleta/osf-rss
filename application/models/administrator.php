<?php

/**
 * Description of administrator
 *
 * @author Nicoleta
 * @package Osf_administrator
 */
class Administrator extends CI_Model{
    
    public function canLogin($username, $password)
    {
        $this->load->database();
        $query = $this->db->get_where('administrators', array('username'=> $username, 'password'=>$password));
        /* if it founds at least one row then its valid */
        if ($query->num_rows()) {
            return TRUE;
        }

        return FALSE;
    }
}

