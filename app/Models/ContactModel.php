<?php
namespace App\Models;
use CodeIgniter\Model;
class ContactModel extends Model {
    protected $table = 'contact_us';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;
    protected $allowedFields  = [
        'f_name',
        'l_name',
        'email',
        'mobile',
        'address',
        'con_message',
        'status',
        'created_at',
        'updated_at'
    ];

    public function getTotalMessage()
    {
        $queryResult = $this->db->table($this->table)->selectCount('id')->get()->getResult();
        if(isset($queryResult[0])) {
            return $queryResult[0]->id;
        } else {
            return 0;
        }
    }

}