<?php

/**
 * Description of user
 *
 * @author Nicoleta
 * @package Osf_user
 */
class User extends OSF_Model {

    protected $_tableName = 'users';
    
    public $username;
    public $password;
    public $email;
    
    /**
     * creates a new user in the table 'users'
     * @return $this
     * @throws Exception
     */
    public function create($data)
    {
       
        $this->username = $data['username'];
        $this->password = md5($data['password']);
        $this->email = $data['email_adress'];

        if (!$this->db->insert($this->getTableName(), $this)) {
            throw new Exception('Username or email is already in use!');
        }
        return $this;
    }

    /**
     * verify if the username/password pair is valid;
     * 
     * @return bool
     */
    public function canLogin($username, $password)
    {
        $this->load->database();
        $query = $this->db->get_where('users', array('username' => $username, 'password' => md5($password)));
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
     * @return $this
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

    /**
     * returns an User instance that has the provided email;
     * if no user with the provided email has been found it
     * will return false;
     * @return $this
     */
    public function getUserByEmail($email)
    {
        $this->load->database();
        $query = $this->db->get_where('users', array('email' => $email));
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

    /**
     * verifies if the new data is valid
     * @return $this
     */
    public function update($data)
    {
        $this->load->database();
        unset($data['submit']);
        foreach ($data as $key => $value) {
            if (!trim($value)) {
                unset($data[$key]);
            }
        }
        $this->db->where('id', $this->session->userdata('id'));
        if (isset($data['password'])) {
            $data['password'] = md5($data['password']);
        }
        if ($this->db->update('users', $data)) {
            $this->session->set_flashdata('message', 'You have succesfully edited the account!');
            if (isset($data['password'])) {
                unset($data['password']);
            }
            $this->session->set_userdata($data);
        } else {
            $this->session->set_flashdata('message', 'The username or email is already in use!');
        }
        return $this;
    }

    /**
     * return the username
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * 
     * @param string $newPass
     * @return $this
     */
    public function setPassword($newPass)
    {
        $data = array('password' => md5($newPass));

        $this->db->where('id', $this->getId());
        $this->db->update('users',$data);

        return $this;
        
    }

}
