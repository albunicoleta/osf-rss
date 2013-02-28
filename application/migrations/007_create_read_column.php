<?php

class Migration_Create_read_column extends CI_Migration {

    public function up()
    {

        $sql = "ALTER TABLE rss ADD is_read TINYINT(2);";

        $this->db->query($sql);
    }

    public function down()
    {
        $sql = "ALTER TABLE rss DROP COLUMN is_read;";

        $this->db->query($sql);
    }

}

