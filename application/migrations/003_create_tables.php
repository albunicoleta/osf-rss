<?php

class Migration_Create_tables extends CI_Migration {

    public function up()
    {
        /* create tables only IF NOT EXISTS */

        $sql = "
        CREATE TABLE IF NOT EXISTS users_rss(
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        user_id INT NOT NULL,
        rss_id INT NOT NULL,
        FOREIGN KEY (user_id) REFERENCES users (id),
        FOREIGN KEY (rss_id) REFERENCES rss (id)
        )";
        $this->db->query($sql);
    }

    public function down()
    {
        $this->dbforge->drop_table('users_rss');
    }

}

