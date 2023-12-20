<?php
namespace App\Models\Admin;
use CodeIgniter\Model;

class ImagesModel extends Model {
    protected $table = 's3images';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['name', 'url', 'created_at'];
}