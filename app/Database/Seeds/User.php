<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $data = [
            'name' => 'Dheeraj	Kumar',
            'email'    => 'dheeraj.prajapati@unnatiagri.com',
            'phone'    => '9838122252',
            'salt'    => '9dc2a33d857b798a12f1e301',
            'password'    => '$2y$10$ZGYizCHzw5DJa6/7M4J/uu1pO8M/48CN9eK5ARRptIGH8iIRG0IVy', // 12345678
            'role'    => 101,
            'status'    => 1,
            'created_at'    => '2023-04-06 04:26:23',
            'updated_at'    => '2023-04-06 04:26:23',
        ];
        // Using Query Builder
        $this->db->table('users')->insert($data);
    }
}
