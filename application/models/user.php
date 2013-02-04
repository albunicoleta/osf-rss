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

    /*
     * login by username and password
     */

    public function login($username, $password)
    {
        $this->load->database();
        $query = $this->db->get_where('users', array('username' => $username, 'password' => $password));
        if ($query->num_rows()) {
            echo "exista";
        } else {
            echo "nu exista";
        }
    }

}