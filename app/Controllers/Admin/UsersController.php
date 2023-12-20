<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;
use CodeIgniter\I18n\Time;
use App\Models\Admin\UsersModel;
use App\Models\Admin\RolesModel;
use App\Models\Admin\BackendMenusModel;

class UsersController extends BaseController {
    public function index() {
        $data['title'] = "Users";
        $usersModel = new UsersModel();
        $rolesModel = new RolesModel();
        $data['users'] = $usersModel
            ->select($usersModel->table.".*, ".$rolesModel->table.".name as role_name")
            ->join($rolesModel->table, $rolesModel->table.'.code = '.$usersModel->table.'.role', 'left')
            ->paginate(10);
        $data['pager'] = $usersModel->pager;
        return view('admin/user/index', $data);
    }
    public function add() {
        $data['title'] = "New User Form";
        if($this->request->is('post')) {
            $this->save();
        }
        $rolesModel = new RolesModel();
        $data['roles'] = $rolesModel->get()->getResult();
        return view('admin/user/form', $data);
    }
    public function edit($id) {
        $data['title'] = "Edit User Form";
        if($this->request->is('post')) {
            $this->save($id);
        }
        $userDetails = new UsersModel();
        $data['userDetails'] = $userDetails->find($id);
        $rolesModel = new RolesModel();
        $data['roles'] = $rolesModel->get()->getResult();
        return view('admin/user/form', $data);
    }
    protected function save($id = null) {
        try {

            $rules = [
                "code" => [
                    "label" => "Code",
                    "rules" => "required|alpha_numeric|min_length[4]|max_length[15]"
                ],
                "name" => [
                    "label" => "Name",
                    "rules" => "required|alpha_space|min_length[4]|max_length[45]"
                ],
                "email" => [
                    "label" => "Email", 
                    "rules" => "required|min_length[3]|max_length[35]|valid_email"
                ],
                "phone" => [
                    "label" => "Mobile", 
                    "rules" => "required|exact_length[10]"
                ] 
            ];
            if($this->request->getPost('password')) {
                $rules["password"] = [
                    'label' => 'Password',
                    "rules" => "required|alpha_numeric|min_length[8]|max_length[35]"
                ];
            }
            $db = \Config\Database::connect();
            if (!$this->validate($rules)) {
                throw new \Exception(implode(", ", $this->validator->getErrors()));
            }
            $record['code'] = strtoupper((string)$this->request->getPost('code'));
            $record['name'] = ucwords((string)$this->request->getPost('name'));
            $record['email'] = $this->request->getPost('email');
            $record['phone'] = $this->request->getPost('phone');
            $record['dob'] =  $this->request->getPost('dob');
            $record['role'] = $this->request->getPost('role');
            $record['status'] = $this->request->getPost('status') == "active" ? 1 : 0;
            if(!$id) {
                $record = array_merge($record, $this->parsePassword($this->request->getPost('password')));
                $record['created_at'] = Time::now();
            } else {
                if($this->request->getPost('reset_password')) {
                    $record = array_merge($record, $this->parsePassword($this->request->getPost('password')));
                }
            }
            $this->checkForMobileAndEmail($id);
            // Start the transaction
            $db->transBegin();
            $usersModel = new UsersModel();
            if($id) {
                $usersModel->update($id, $record);
                $message = "User Details updated successfully.";
            } else {
                $usersModel->save($record);
                $message = "New User Details saved successfully.";
            }
            $db->transCommit();      
            session()->setFlashdata('success', $message);
            return response()->redirect(base_url('backend/users'));
        } catch(\Exception $e) {
            $db->transRollback();
            session()->setFlashdata('error', $e->getMessage());
        }  
    }
    public function checkForMobileAndEmail($id = null) {
        $usersModel = new UsersModel();
        if($id) {
            $emailExistingCheck = $usersModel->where('email',$this->request->getPost('emial'))->where('id !=',$id)->first();
            $phoneExistingCheck = $usersModel->where('phone',$this->request->getPost('phone'))->where('id !=',$id)->first();
        } else {
            $emailExistingCheck = $usersModel->where('email',$this->request->getPost('emial'))->first();
            $phoneExistingCheck = $usersModel->where('phone',$this->request->getPost('phone'))->first();
        }
        if(!empty($emailExistingCheck) && !empty($phoneExistingCheck)) {
            throw new \Exception("We found this is Email id already  to someone");
        } else if(!empty($emailExistingCheck)) {
            throw new \Exception("Email already assigned to someone");
        } else if(!empty($phoneExistingCheck)) {
            throw new \Exception("Phone number already assigned to someone");
        } else if($this->request->getPost('reset_password') && $this->request->getPost('password') && $this->request->getPost('c_password')) {
            if($this->request->getPost('password') !== $this->request->getPost('c_password')) {
                throw new \Exception("Password should be matched");
            } 
        }
    }
    protected function parsePassword($password) {
        $salt = bin2hex(random_bytes(12));
        $updateData['salt'] = $salt;
        $password = $salt.$password;
        $updateData['password'] = password_hash($password,PASSWORD_DEFAULT);
        return $updateData;
    }
    public function delete($id) {
        try {
            $usersModel = new UsersModel();
            $result = $usersModel->delete($id);
            if($result) {
                session()->setFlashdata('success', "User deleted successfully");
            }
        } catch(\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }
        return redirect()->back();
    }
    public function roles() {
        $data['title'] = "Roles";
        $rolesModel = new RolesModel();
        $data['roles'] = $rolesModel->paginate(10);
        $data['pager'] = $rolesModel->pager;
        return view('admin/user/roles', $data);
    }
    public function roleAdd() {
        $data['title'] = "New Role Form";
        if($this->request->is('post')) {
            $this->roleSave();
        }
        $backendMenusModel = new BackendMenusModel();
        $data['menus'] = $backendMenusModel->getMenusHtml();
        return view('admin/user/role_form', $data);
    }
    public function roleEdit($id) {
        $data['title'] = "Edit Role Form";
        if($this->request->is('post')) {
            $this->roleSave($id);
        }
        $rolesModel = new RolesModel();
        $data['roleDetails'] = $rolesModel->find($id);
        $backendMenusModel = new BackendMenusModel();
        $data['menus'] = $backendMenusModel->getMenusHtml();
        return view('admin/user/role_form', $data);
    }
    public function roleSave($id = null) {
        try {
            $rules = [
                "code" => [
                    "label" => "Code",
                    "rules" => "required|alpha_numeric|min_length[3]|max_length[15]"
                ],
                "name" => [
                    "label" => "Name",
                    "rules" => "required|alpha_space|min_length[4]|max_length[45]"
                ],
                "status" => [
                    "label" => "Email", 
                    "rules" => "required"
                ]
            ];
            $db = \Config\Database::connect();
            if (!$this->validate($rules)) {
                throw new \Exception(implode(", ", $this->validator->getErrors()));
            }
            $record['code'] = strtoupper((string)$this->request->getPost('code'));
            $record['name'] = ucwords((string)$this->request->getPost('name'));
            $record['status'] = $this->request->getPost('status') == "active" ? 1 : 0;
            $record['access'] = json_encode(array_map(function($a) { return $a = true;}, array_flip($this->request->getPost('access'))));
            // Start the transaction
            $db->transBegin();
            $roleModel = new RolesModel();
            if($id) {
                $roleModel->update($id, $record);
                $message = "Role Details updated successfully.";
            } else {
                $record['created_at'] = Time::now();
                $roleModel->save($record);
                $message = "New Role saved successfully.";
            }
            $db->transCommit();      
            session()->setFlashdata('success', $message);
            return response()->redirect(base_url('backend/roles'));
        } catch(\Exception $e) {
            $db->transRollback();
            session()->setFlashdata('error', $e->getMessage());
        } 
    }
    public function roleDelete($id) {
        try {
            $rolesModel = new RolesModel();
            $result = $rolesModel->delete($id);
            if($result) {
                session()->setFlashdata('success', "User deleted successfully");
            }
        } catch(\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }
        return redirect()->back();
    }
}