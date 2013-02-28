<?php

class Migration_Create_unique_key1 extends CI_Migration {

    public function up()
    {

        $sql = "ALTER TABLE rss
                ADD UNIQUE (link)";
        $this->db->query($sql);
    }

    public function down()
    {
        $sql = "ALTER TABLE users
                DROP INDEX `link`";
        $this->db->query($sql);
    }

}

