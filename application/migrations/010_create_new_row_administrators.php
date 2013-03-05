<?php

class Migration_Create_new_row_administrators extends CI_Migration {

    public function up()
    {

        $sql = "INSERT INTO administrators VALUES (NULL, 'admin', 123456);";

        $this->db->query($sql);
    }

    public function down()
    {
        $sql = "DELETE FROM administrators WHERE administrator='admin' AND password=123456 ;";

        $this->db->query($sql);
    }

}

