<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BackendMenus extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '45',
                'null' => false,
            ],
            'url' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
                'null' => false,
            ],
            'f_icon' => [
                'type'       => 'VARCHAR',
                'constraint' => '45'
            ],
            'parent' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'null' => false,
            ],
            'is_visible' => [
                'type'       => 'TINYINT',
                'default'    => null,
            ],
            'status' => [
                'type'       => 'TINYINT',
                'default'    => null,
            ],
            'sequence' => [
                'type'       => 'TINYINT',
                'default'    => 0,
            ],
            'deleted_at' => [
                'type'    => 'TIMESTAMP',
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('backend_menus');
    }

    public function down()
    {
        $this->forge->dropTable('backend_menus');
    }
}
