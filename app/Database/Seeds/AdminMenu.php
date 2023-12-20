<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminMenu extends Seeder
{
    public function run()
    {
        $data = [
            'id' => 1,
            'name' => 'Dashboard',
            'url'    => 'backend',
            'f_icon'    => 'home',
            'parent'    => 0,
            'is_visible' => 1,
            'status'    => 1,
            'sequence'  => 1,
        ];
        // Using Query Builder
        $this->db->table('backend_menus')->insert($data);
        $data = [
            'id' => 2,
            'name' => 'Users',
            'url'    => 'Users',
            'f_icon'    => 'user',
            'parent'    => 0,
            'is_visible' => 1,
            'status'    => 1,
            'sequence'  => 2,
        ];
        // Using Query Builder
        $this->db->table('backend_menus')->insert($data);
        $data = [
            'id' => 3,
            'name' => 'Setting',
            'url'    => 'Setting',
            'f_icon'    => 'settings',
            'parent'    => 0,
            'is_visible' => 1,
            'status'    => 1,
            'sequence'  => 3,
        ];
        // Using Query Builder
        $this->db->table('backend_menus')->insert($data);
        $data = [
            'id' => 4,
            'name' => 'User List',
            'url'    => 'backend/users',
            'parent'    => 2,
            'is_visible' => 1,
            'status'    => 1,
            'sequence'  => 1,
        ];
        // Using Query Builder
        $this->db->table('backend_menus')->insert($data);
        $data = [
            'id' => 5,
            'name' => 'User Role',
            'url'    => 'backend/roles',
            'parent'    => 2,
            'is_visible' => 1,
            'status'    => 1,
            'sequence'  => 2,
        ];
        // Using Query Builder
        $this->db->table('backend_menus')->insert($data);

        $data = [
            'id' => 6,
            'name' => 'User Add',
            'url'    => 'backend/user/add',
            'parent'    => 4,
            'is_visible' => 0,
            'status'    => 1,
            'sequence'  => 1,
        ];
        // Using Query Builder
        $this->db->table('backend_menus')->insert($data);
        $data = [
            'id' => 7,
            'name' => 'User Edit',
            'url'    => 'backend/user/edit/(:any)',
            'parent'    => 4,
            'is_visible' => 0,
            'status'    => 1,
            'sequence'  => 2,
        ];
        // Using Query Builder
        $this->db->table('backend_menus')->insert($data);
        $data = [
            'id' => 8,
            'name' => 'User Delete',
            'url'    => 'backend/user/delete/(:any)',
            'parent'    => 4,
            'is_visible' => 0,
            'status'    => 1,
            'sequence'  => 3,
        ];
        // Using Query Builder
        $this->db->table('backend_menus')->insert($data);

        $data = [
            'id' => 9,
            'name' => 'Role Add',
            'url'    => 'backend/role/add',
            'parent'    => 5,
            'is_visible' => 0,
            'status'    => 1,
            'sequence'  => 1,
        ];
        // Using Query Builder
        $this->db->table('backend_menus')->insert($data);

        $data = [
            'id' => 10,
            'name' => 'Role Edit',
            'url'    => 'backend/role/edit/(:any)',
            'parent'    => 5,
            'is_visible' => 0,
            'status'    => 1,
            'sequence'  => 2,
        ];
        // Using Query Builder
        $this->db->table('backend_menus')->insert($data);
        $data = [
            'id' => 11,
            'name' => 'Role Delete',
            'url'    => 'backend/role/delete/(:any)',
            'parent'    => 5,
            'is_visible' => 0,
            'status'    => 1,
            'sequence'  => 3,
        ];
        // Using Query Builder
        $this->db->table('backend_menus')->insert($data);
        $data = [
            'id' => 12,
            'name' => 'Admin Menus',
            'url'    => 'backend/admin_menus',
            'parent'    => 3,
            'is_visible' => 1,
            'status'    => 1,
            'sequence'  => 1,
        ];
        // Using Query Builder
        $this->db->table('backend_menus')->insert($data);
        $data = [
            'id' => 13,
            'name' => 'Menus',
            'url'    => 'backend/menus',
            'parent'    => 3,
            'is_visible' => 1,
            'status'    => 1,
            'sequence'  => 2,
        ];
        // Using Query Builder
        $this->db->table('backend_menus')->insert($data);
        $data = [
            'id' => 14,
            'name' => 'Admin Menu Add',
            'url'    => 'backend/admin_menu/add',
            'parent'    => 12,
            'is_visible' => 0,
            'status'    => 1,
            'sequence'  => 1,
        ];
        // Using Query Builder
        $this->db->table('backend_menus')->insert($data);
        $data = [
            'id' => 15,
            'name' => 'Admin Menu Edit',
            'url'    => 'backend/admin_menu/edit/(:any)',
            'parent'    => 12,
            'is_visible' => 1,
            'status'    => 1,
            'sequence'  => 2,
        ];
        // Using Query Builder
        $this->db->table('backend_menus')->insert($data);
        $data = [
            'id' => 16,
            'name' => 'Admin Menu Delete',
            'url'    => 'backend/admin_menu/delete/(:any)',
            'parent'    => 12,
            'is_visible' => 0,
            'status'    => 1,
            'sequence'  => 3,
        ];
        // Using Query Builder
        $this->db->table('backend_menus')->insert($data);
        $data = [
            'id' => 17,
            'name' => 'Menu Add',
            'url'    => 'backend/menu/add',
            'parent'    => 13,
            'is_visible' => 0,
            'status'    => 1,
            'sequence'  => 1,
        ];
        // Using Query Builder
        $this->db->table('backend_menus')->insert($data);
        $data = [
            'id' => 18,
            'name' => 'Menu Edit',
            'url'    => 'backend/menu/edit/(:any)',
            'parent'    => 13,
            'is_visible' => 0,
            'status'    => 1,
            'sequence'  => 2,
        ];
        // Using Query Builder
        $this->db->table('backend_menus')->insert($data);
        $data = [
            'id' => 19,
            'name' => 'Menu Delete',
            'url'    => 'backend/menu/delete/(:any)',
            'parent'    => 13,
            'is_visible' => 0,
            'status'    => 1,
            'sequence'  => 3,
        ];
        // Using Query Builder
        $this->db->table('backend_menus')->insert($data);
    }
}
