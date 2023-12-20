<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class RolesModel extends Model
{
    protected $table            = 'roles';
    protected $primaryKey       = 'id';
    protected $returnType = 'object';
    protected $allowedFields    = [
        'code',
        'name',
        'status',
        'access',
        'created_at'
    ];
}
