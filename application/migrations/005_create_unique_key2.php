<?php

class Migration_Create_unique_key2 extends CI_Migration {

    public function up()
    {

        $sql = "ALTER TABLE users
                ADD UNIQUE `unique_username` (username)";
        
        $this->db->query($sql);
        $sql = "ALTER TABLE users
                ADD UNIQUE `unique_email` (email)";
        $this->db->query($sql);
    }

    public function down()
    {
        $sql = "ALTER TABLE users
                DROP INDEX `unique_username`";
        $this->db->query($sql);
        
        $sql = "ALTER TABLE users
                DROP INDEX `unique_email`";
        $this->db->query($sql);
    }

}

