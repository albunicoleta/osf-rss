<?php

class Migration_Create_unique_key extends CI_Migration {

    public function up()
    {

        $sql = "ALTER TABLE rss
                ADD UNIQUE (link)";
        $this->db->query($sql);
    }

    public function down()
    {
        $this->dbforge->drop_table('rss');
    }

}

