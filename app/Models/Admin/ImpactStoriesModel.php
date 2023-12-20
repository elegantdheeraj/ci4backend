<?php
namespace App\Models\Admin;
use CodeIgniter\Model;

class ImpactStoriesModel extends Model {
    protected $table = 'impact_stories';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $allowedFields = ['title', 'impact_story', 'publish_status', 'created_at'];
}