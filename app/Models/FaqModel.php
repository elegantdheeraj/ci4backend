<?php
namespace App\Models;
use CodeIgniter\Model;
class FaqModel extends Model {
    protected $table = 'faq';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;
    protected $allowedFields  = [
        'question',
        'answer',
        'status',
        'created_at',
        'deleted_at'
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