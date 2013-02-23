<?php

class Migration_Create_unique_key extends CI_Migration {

    public function up()
    {

        $sql = "ALTER TABLE users
                ADD UNIQUE `unique`(username, email)";
        $this->db->query($sql);
    }

    public function down()
    {
        $sql = "ALTER TABLE users
                DROP INDEX `unique`";
        $this->db->query($sql);
    }

}

