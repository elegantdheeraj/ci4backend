<?php
namespace App\Models\Admin;
use CodeIgniter\Model;

class BackendMenusModel extends Model {
    protected $table = 'backend_menus';
    protected $primaryKey = 'id';
    protected $useTimestamps = false;
    protected $returnType = 'object';
    protected $allowedFields = ['name', 'url', 'parent', 'f_icon', 'is_visible', 'status', 'sequence'];
    public function getMenus($menu = [], $parent_id = 0) {
        $menus = $this->where('status', 1)->where('is_visible', 1)->where('parent', $parent_id)->orderBy('sequence', 'ASC')->findAll();
        if(!empty($menus)) {
            foreach($menus as $menu_item) {
                $menu[$menu_item->id] = [
                    'id' => $menu_item->id,
                    'name' => $menu_item->name,
                    'f_icon' => $menu_item->f_icon,
                    'url' => $menu_item->url,
                    'child' => $this->getMenus([], $menu_item->id)
                ];
            }
        }  else {
            return [];
        }
        return $menu;
    }
    public function getMenusHtml($menu = '', $parent_id = 0) {
        $menus = $this->where('status', 1)->where('parent', $parent_id)->orderBy('sequence', 'ASC')->findAll();
        if(!empty($menus)) {
            if($parent_id == 0) {
                $menu .= '<ul class="tree">'; 
            } else {
                $menu .= '<ul>'; 
            }
            foreach($menus as $menu_item) {
                $menu .= '<li>
                    <input name="access[]" class="input-role" type="checkbox" id="check_'.$menu_item->id.'" value="'.$menu_item->url.'">
                    <label>'.$menu_item->name.' <small>('.$menu_item->url.')</small> </label>
                    '.$this->getMenusHtml('', $menu_item->id).
                '</li>';
            }
            $menu .= '</ul>';
        }  else {
            return '';
        }
        return $menu; 
    }
}