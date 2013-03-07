<?php

class Migration_Create_unique_key_administrators extends CI_Migration {

    public function up()
    {

        $sql = "ALTER TABLE administrators
                ADD UNIQUE (username)";
        $this->db->query($sql);
    }

    public function down()
    {
        $sql = "ALTER TABLE administrators
                DROP INDEX `username`";
        $this->db->query($sql);
    }

}

