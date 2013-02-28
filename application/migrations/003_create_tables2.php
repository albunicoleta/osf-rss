<?php

class Migration_Create_tables2 extends CI_Migration {

    public function up()
    {
        /* create tables only IF NOT EXISTS */

        $sql = "
        CREATE TABLE IF NOT EXISTS users_rss(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        user_id INT NOT NULL,
        rss_id INT NOT NULL
        )";
        $this->db->query($sql);
    }

    public function down()
    {
        $this->dbforge->drop_table('users_rss');
    }

}

