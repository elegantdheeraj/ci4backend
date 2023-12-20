<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Role extends Seeder
{
    public function run()
    {
        $data = [
            'code' => '101',
            'name'    => 'Super Admin',
            'status'    => 1,
            'access'    => '',
            'created_at'    => '2023-04-06 04:26:23',
            'updated_at'    => '2023-04-06 04:26:23',
        ];
        // Using Query Builder
        $this->db->table('roles')->insert($data);
    }
}
