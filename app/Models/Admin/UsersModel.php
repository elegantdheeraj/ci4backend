<?php
namespace App\Models\Admin;
use CodeIgniter\Model;
class UsersModel extends Model {
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'object';
    protected $useSoftDeletes = true;
    protected $placeholders = [
        'any'      => '.*',
        'segment'  => '[^/]+',
        'alphanum' => '[a-zA-Z0-9]+',
        'num'      => '[0-9]+',
        'alpha'    => '[a-zA-Z]+',
        'hash'     => '[^/]+',
    ];
    protected $allowedFields  = [
        'code',
        'name',
        'email',
        'phone',
        'dob',
        'salt',
        'password',
        'role',
        'status',
        'created_at'
    ];
    public static function loggedInUser() {
        $user_details = '';
        if(!session()->has('LOGGEDIN_USER')) {
            return false;
        } 
        return session()->get('LOGGEDIN_USER');
    }
    public static function getUserAccess($user_id, $raw = false) {
        $instance = new self();
        $user = $instance->find($user_id);
        $rolesModel = new RolesModel();
        $role_data = $rolesModel->where('code', $user->role)->where('status', 1)->first();
        if(!$role_data) {
            throw new \Exception('Not found access details for this user');
        }
        $user_access = array();
        $temp_access = json_decode($role_data->access, true);
        if(!empty($temp_access)) {
            if($raw) {
                foreach($temp_access as $access => $status) { 
                    $user_access[] = $access;
                }
            } else {
                foreach($temp_access as $access => $status) {
                    foreach($instance->placeholders as $key => $placeholder) {
                        $access = str_ireplace(':'.$key, $placeholder, $access);
                    }  
                    $user_access[] = $access;
                }
            }
        }
        
        return $user_access;
    }
    public function hasAccess($url) {
        $user_details = '';
        if(!session()->has('LOGGEDIN_USER')) {
            return false;
        } 
        $user_details = session()->get('LOGGEDIN_USER');
        $user_access = self::getUserAccess($user_details->id);
        if(!empty($user_access)) {
            foreach($user_access as $access) {
                $access = str_replace("/", "\/", $access);
                $access = "/".$access."$/";
                if(preg_match($access, $url)) {
                    return true;
                }
            }
        }
        
        return false;
    }
}