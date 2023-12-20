<?php
namespace App\Models;
use CodeIgniter\Model;
class Master extends Model {
    public static function getStates()
    {
        $instance = new self();
        return $instance->db->table('states')->get()->getResult(); 
    }
    public static function getDistricts($state_code)
    {
        $instance = new self();
        return $instance->db->table('districts')->where('state_code', $state_code)->get()->getResult(); 
    }
}