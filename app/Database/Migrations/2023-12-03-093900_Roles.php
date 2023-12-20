<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Roles extends Migration
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
                'null' => false,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '45',
                'null' => false,
            ],
            'status' => [
                'type'       => 'TINYINT',
                'default'    => 1,
            ],
            'access' => [
                'type'       => 'TEXT'
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
                'null' => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('code', false, true);
        $this->forge->createTable('roles');
    }

    public function down()
    {
        $this->forge->dropTable('roles');
    }
}
