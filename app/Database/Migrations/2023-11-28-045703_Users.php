<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => '45',
                'null' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '45',
                'null' => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '45',
                'null' => true,
            ],
            'phone' => [
                'type'           => 'VARCHAR',
                'constraint' => '10',
                'null' => true,
            ],
            'dob' => [
                'type'    => 'DATETIME',
                'null' => true
            ],
            'salt' => [
                'type'           => 'VARCHAR',
                'constraint' => '150'
            ],
            'password' => [
                'type'           => 'VARCHAR',
                'constraint' => '150'
            ],
            'role' => [
                'type'       => 'VARCHAR',
                'constraint' => '45'
            ],
            'status' => [
                'type'       => 'TINYINT',
                'default'    => null,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
                'null' => true
            ],
            'deleted_at' => [
                'type'    => 'TIMESTAMP',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
