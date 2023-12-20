<?php
namespace App\Models;
use CodeIgniter\Model;
class OtpRequestsModel extends Model {
    protected $table = 'otp_requests';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;
    protected $allowedFields  = [
        'mobile',
        'otp',
        'count',
        'ip',
        'created_at',
        'updated_at'
    ];

    public function getTotalFaq()
    {
        $queryResult = $this->db->table($this->table)->selectCount('id')->get()->getResult();
        if(isset($queryResult[0])) {
            return $queryResult[0]->id;
        } else {
            return 0;
        }
    }

}