<?php
namespace App\Models;

use CodeIgniter\Model;

class MenusModel extends Model {
    protected $table = 'menus';
    protected $primaryKey = 'id';
    protected $useSoftDeletes = true;
    protected $useTimestamps = false;
    protected $returnType = 'object';
    protected $allowedFields = ['name', 'url', 'parent', 'is_visible', 'status', 'sequence'];
    public function getMenus($menu = [], $parent_id = 0) {
        $menus = $this->where('status', 1)->where('is_visible', 1)->where('parent', $parent_id)->orderBy('sequence', 'ASC')->findAll();
        if(!empty($menus)) {
            foreach($menus as $menu_item) {
                $menu[$menu_item->id] = [
                    'id' => $menu_item->id,
                    'name' => $menu_item->name,
                    'url' => $menu_item->url,
                    'child' => $this->getMenus([], $menu_item->id)
                ];
            }
        }  else {
            return [];
        }
        return $menu;
    }
}
