<?php

class Migration_Create_administrators_table extends CI_Migration {

    public function up()
    {
        /* create tables only IF NOT EXISTS */

        $fields = array(
            'id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT',
            'username VARCHAR(30) NOT NULL',
            'password VARCHAR(50) NOT NULL',
        );
        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('administrators');
    }

    public function down()
    {
        $this->dbforge->drop_table('administrators');
    }

}

