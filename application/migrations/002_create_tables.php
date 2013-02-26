<?php

class Migration_Create_tables extends CI_Migration {

    public function up()
    {
        /* create tables only IF NOT EXISTS */

        $fields = array(
            'id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT',
            'link VARCHAR(250) NOT NULL',
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('rss');
    }

    public function down()
    {
        $this->dbforge->drop_table('rss');
    }

}

