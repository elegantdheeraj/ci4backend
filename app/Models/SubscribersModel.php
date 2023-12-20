<?php
namespace App\Models;
use CodeIgniter\Model;
class SubscribersModel extends Model {
    protected $table = 'subscribers';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;
    protected $allowedFields  = [
        'subscriber_email',
        'subscriber_mobile',
        'status',
        'created_at',
        'updated_at'
    ];

    public function getTotalSubscribers()
    {
        $queryResult = $this->db->table($this->table)->selectCount('id')->get()->getResult();
        if(isset($queryResult[0])) {
            return $queryResult[0]->id;
        } else {
            return 0;
        }
    }

}