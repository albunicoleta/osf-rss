<?php

class Migration_Create_innodb_tables extends CI_Migration {

    public function up()
    {

        $sql = array("ALTER TABLE users ENGINE = innodb;",
            "ALTER TABLE rss ENGINE = innodb;",
            "ALTER TABLE users_rss ENGINE = innodb;");
        foreach ($sql as $line) {
            $this->db->query($line);
        }
    }

    public function down()
    {
        $sql = array("ALTER TABLE users ENGINE = myisam;",
            "ALTER TABLE rss ENGINE = myisam;",
            "ALTER TABLE users_rss ENGINE = myisam;");

        foreach ($sql as $line) {
            $this->db->query($line);
        }
    }

}

