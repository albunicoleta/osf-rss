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

}

