<?php

class Migration_Create_favorite_column extends CI_Migration {

    public function up()
    {

        $sql = "ALTER TABLE rss ADD favorite TINYINT(2);";

        $this->db->query($sql);
    }

    public function down()
    {
        $sql = "ALTER TABLE rss DROP COLUMN favorite;";

        $this->db->query($sql);
    }

}

