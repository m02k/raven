<?php
use App\app\Schema;

class m00000000000001_create_users_table extends Schema
{

    public function up()
    {
        /*This is table name*/
        $this->tableName = "users";
        /*Add Columns name and props*/
        $this->columns = [
            'id' => 'BIGINT(20) AUTO_INCREMENT PRIMARY KEY',
            'firstname' => 'VARCHAR(255) NOT NULL',
            'lastname' => 'VARCHAR(255) NOT NULL',
            'status' => 'TINYINT(1) NOT NULL',
            'email' => 'VARCHAR(255) NOT NULL UNIQUE',
            'password' => 'VARCHAR(255) NOT NULL',
            'remember_token' => 'VARCHAR(255) NOT NULL',
            'created_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
            'updated_at' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
        ];



        $this->create();

    }

    public function down()
    {
        $this->dropIfExists();
    }
    

}