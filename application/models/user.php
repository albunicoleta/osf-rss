<?php

/**
 * Description of user
 *
 * @author Nicoleta
 * @package Osf_user
 */
class User extends CI_Model {

    public $id;
    public $username;
    public $password;
    public $email;

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
     * returns an User instance that has the provided username;
     * if no user with the provided username has been found it
     * will return false;
     * 
     * @return User
     */
    public function getUserByUsername($username)
    {
        $this->load->database();
        $query = $this->db->get_where('users', array('username' => $username));
        //verify that at least one result was found
        if ($query->num_rows()) {
            //fetch row data from db
            $row = $query->row();
            //set row data on instance props
            $this->username = $row->username;
            $this->password = $row->password;
            $this->email = $row->email;
            $this->id = $row->id;

            return $this;
        }

        return FALSE;
    }

    public function getUserByEmail($email)
    {
        $this->load->database();
        $query = $this->db->get_where('users', array('email' => $email));
    }

}