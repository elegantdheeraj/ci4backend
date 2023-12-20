<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;
use CodeIgniter\I18n\Time;
use App\Models\Admin\BackendMenusModel;
use App\Models\MenusModel;

class MenusController extends BaseController
{
    /**
     * function to render backend menus
     */
    public function index()
    {
        $data['title'] = "Backend Menus";
        $backendMenusModel = new BackendMenusModel();
        $data['backendMenus'] = $backendMenusModel
        ->select($backendMenusModel->table.".*, parent.name as parent_name")
        ->join($backendMenusModel->table.' parent' , 'parent.id = '.$backendMenusModel->table.'.parent', 'left')
        ->paginate(10);
        $data['pager'] = $backendMenusModel->pager;
        return view('admin/backend_menu/index', $data);
    }
    /**
     * function to render backend menus
     */
    public function add()
    {
        $data['title'] = "Add B-Menu Form";
        if ($this->request->is('post')) {
            $this->save();
        }
        $backendMenusModel = new BackendMenusModel();
        $data['backendMenus'] = $backendMenusModel->get()->getResult();
        return view('admin/backend_menu/form', $data);
    }
    public function edit($id)
    {
        $data['title'] = "Edit B-Menu Form";
        if ($this->request->is('post')) {
            $this->save($id);
        }
        $backendMenusModel = new BackendMenusModel();
        $data['backendMenu'] = $backendMenusModel->find($id);
        $data['backendMenus'] = $backendMenusModel->get()->getResult();
        return view('admin/backend_menu/form', $data);
    }
    protected function save($id = null)
    {
        try {
            $rules = [
                "name" => [
                    "label" => "Name",
                    "rules" => "required|alpha_space|min_length[4]|max_length[45]"
                ],
                "url" => [
                    "label" => "url",
                    "rules" => "required|string|max_length[45]"
                ],
                // "fi_name" => [
                //     "label" => "Feather Icon Name",
                //     "rules" => "required|alpha_space|min_length[3]|max_length[35]"
                // ],
                "sequence" => [
                    "label" => "Sequence",
                    "rules" => "required|max_length[3]"
                ],
                "is_visible" => [
                    "label" => "Is Visible",
                    "rules" => "required"
                ],
                "status" => [
                    "label" => "status",
                    "rules" => "required"
                ]
            ];
            $db = \Config\Database::connect();
            if (!$this->validate($rules)) {
                throw new \Exception(implode(", ", $this->validator->getErrors()));
            }
            $record['url'] = $this->request->getPost('url');
            $record['name'] = ucwords($this->request->getPost('name'));
            $record['parent'] = $this->request->getPost('parent') ? $this->request->getPost('parent') : 0;
            $record['f_icon'] = $this->request->getPost('fi_name');
            $record['sequence'] = $this->request->getPost('sequence');
            $record['is_visible'] = $this->request->getPost('is_visible') == "yes" ? 1 : 0;
            $record['status'] = $this->request->getPost('status') == "active" ? 1 : 0;
            // Start the transaction
            $db->transBegin();
            $backendMenusModel = new BackendMenusModel();
            if ($id) {
                $backendMenusModel->update($id, $record);
                $message = "Manu Details updated successfully.";
            } else {
                $backendMenusModel->save($record);
                $message = "New Manu Details saved successfully.";
            }
            $db->transCommit();
            session()->setFlashdata('success', $message);
            return response()->redirect(base_url('backend/admin_menus'));
        } catch (\Exception $e) {
            $db->transRollback();
            session()->setFlashdata('error', $e->getMessage());
        }
    }
    public function delete($id)
    {
        try {
            $backendMenusModel = new BackendMenusModel();
            $result = $backendMenusModel->delete($id);
            if ($result) {
                session()->setFlashdata('success', "Manu deleted successfully");
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }
        return redirect()->back();
    }
    /**
     * function to render menus
     */
    public function menus()
    {
        $data['title'] = "Menus";
        $menuModel = new MenusModel();
        $data['menus'] = $menuModel
        ->select($menuModel->table.".*, parent.name as parent_name")
        ->join($menuModel->table.' parent' , 'parent.id = '.$menuModel->table.'.parent', 'left')
        ->paginate(10);
        $data['pager'] = $menuModel->pager;
        return view('admin/menu/index', $data);
    }
    /**
     * function to render backend menus
     */
    public function menuAdd()
    {
        $data['title'] = "Add Menu Form";
        if ($this->request->is('post')) {
            $this->menuSave();
        }
        $menuModel = new MenusModel();
        $data['menus'] = $menuModel->get()->getResult();
        return view('admin/menu/form', $data);
    }
    public function menuEdit($id)
    {
        $data['title'] = "Edit Menu Form";
        if ($this->request->is('post')) {
            $this->menuSave($id);
        }
        $menuModel = new MenusModel();
        $data['menu'] = $menuModel->find($id);
        $data['menus'] = $menuModel->get()->getResult();
        return view('admin/menu/form', $data);
    }
    protected function menuSave($id = null)
    {
        try {
            $rules = [
                "name" => [
                    "label" => "Name",
                    "rules" => "required|alpha_space|min_length[4]|max_length[45]"
                ],
                "url" => [
                    "label" => "url",
                    "rules" => "required|string|max_length[45]"
                ],
                "sequence" => [
                    "label" => "Sequence",
                    "rules" => "required|max_length[3]"
                ],
                "is_visible" => [
                    "label" => "Is Visible",
                    "rules" => "required"
                ],
                "status" => [
                    "label" => "status",
                    "rules" => "required"
                ]
            ];
            $db = \Config\Database::connect();
            if (!$this->validate($rules)) {
                throw new \Exception(implode(", ", $this->validator->getErrors()));
            }
            $record['url'] = $this->request->getPost('url');
            $record['name'] = ucwords($this->request->getPost('name'));
            $record['parent'] = $this->request->getPost('parent') ? $this->request->getPost('parent') : 0;
            $record['sequence'] = $this->request->getPost('sequence');
            $record['is_visible'] = $this->request->getPost('is_visible') == "yes" ? 1 : 0;
            $record['status'] = $this->request->getPost('status') == "active" ? 1 : 0;
            // Start the transaction
            $db->transBegin();
            $menuModel = new MenusModel();
            if ($id) {
                $menuModel->update($id, $record);
                $message = "Manu Details updated successfully.";
            } else {
                $menuModel->save($record);
                $message = "New Manu Details saved successfully.";
            }
            $db->transCommit();
            session()->setFlashdata('success', $message);
            return response()->redirect(base_url('backend/menus'));
        } catch (\Exception $e) {
            $db->transRollback();
            session()->setFlashdata('error', $e->getMessage());
        }
    }
    public function menuDelete($id)
    {
        try {
            $menuModel = new MenusModel();
            $result = $menuModel->delete($id);
            if ($result) {
                session()->setFlashdata('success', "Manu deleted successfully");
            }
        } catch (\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }
        return redirect()->back();
    }
}