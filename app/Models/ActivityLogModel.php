<?php
namespace App\Models;
use CodeIgniter\Model;
use Exception;
class ActivityLogModel extends Model {
    protected $table = 'activity_log';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;
    protected $allowedFields  = [
        'task',
        'record', // json
        'status', // ['Done', 'Failed', 'Initiated'],
        'created_at',
        'updated_at'
    ];
    const ACTIVITY_LOG_TASK = [
        'run_sms_cron' // use to reset the sms daily send limit
    ];
    protected $beforeInsert = ['check_task'];
    public function check_task(array $data)
    {
        if(!in_array($data['data']['task'], self::ACTIVITY_LOG_TASK)) {
            throw new Exception('Your passed activity log not found in ACTIVITY_LOG_TASK, you should first mention in ACTIVITY_LOG_TASK const in App\Models\ActivityLogModel');
        }
        if(isset($data['data']['record'])) {
            $record = $data['data']['record'];
            if(is_array($record) || is_object($data['data']['record'])) {
                $data['data']['record'] = json_encode($data['data']['record']); 
            } 
        }
        return $data;
    }
}