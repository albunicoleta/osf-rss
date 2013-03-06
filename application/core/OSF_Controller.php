<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

abstract class OSF_Controller extends CI_Controller {

    static public $dbCreated;

    public function __construct()
    {
        parent::__construct();

        $this->_createDb();

        $this->load->library('migration');
        if (!$this->migration->current()) {
            show_error($this->migration->error_string());
        }
    }

    private function _createDb()
    {
        /* if database is not created */
        if (!self::$dbCreated) {
            /*
             * load the database library 
             * to fetch the variables from 
             * database.php config file;
             * disabled the autoinit param 
             * to not complain about missing database;
             */
            $this->load->database();
            $mysqli = new mysqli(
                    $this->db->hostname,
                    $this->db->username,
                    $this->db->password
            );
            /*
             * if connection to mysql failes
             * display error and exit;
             */
            if ($mysqli->connect_errno) {
                printf("Connect failed: %s\n", $mysqli->connect_error);
                exit();
            }

            /* if database does not exist; */
            if (!mysqli_select_db($mysqli, $this->db->database)) {
                /* create database; */
                if ($mysqli->query("CREATE DATABASE {$this->db->database}") === FALSE) {
                    throw new Exception('Database could not be automatically created');
                }
            }
            self::$dbCreated = TRUE;
        }
    }

    /**
     * loads the template which loads the header, the footer
     * and the main content
     * 
     * @param mixed $mainContent
     */
    public function loadMainContent($mainContent)
    {
        $this->load->view('includes/template', $this->_prepareContent($mainContent));
    }

    /**
     * loads the admin template which loads the admin header
     * admin footer and the admin view
     * 
     * @param type $adminContent
     */
    public function loadAdminContent($adminContent)
    {

        $this->load->view('admin_includes/template', $this->_prepareContent($adminContent));
    }

    /**
     * prepare view data
     * 
     * @param string $content
     * @return array
     */
    protected function _prepareContent($content)
    {
        //if string just load the view
        if (is_string($content)) {
            $data['main_content'] = $content;
        }
        //if array load the view and pass 
        //the rest of the data in the $data var
        elseif (is_array($content)) {
            $data['main_content'] = $content[0];
            $data['data'] = $content[1];
        }
        return $data;
    }

}