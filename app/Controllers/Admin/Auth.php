<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;
use Exception;
use App\Models\Admin\UsersModel;
use App\Models\Admin\BackendMenusModel;

class Auth extends BaseController {
    public function login() {
        if(session()->get('LOGGEDIN_USER')) {
            $this->response->redirect(base_url('backend'));
        }
        if($this->request->is('post')) {
            $postData = $this->request->getPost();
            $login_type_mobile =  is_numeric($postData['username']) ? true : false;
            $error = [];
            if($login_type_mobile) {
                $rules['username'] = array(
                    "label" => "Mobile", 
                    "rules" => "required|min_length[10]|max_length[10]"
                );
            } else {
                $rules['username'] = array(
                    "label" => "Email", 
                    "rules" => "required|min_length[3]|max_length[35]|valid_email"
                );
            }
            $rules['password'] = array(
                "label" => "Password", 
                "rules" => "required|min_length[8]|max_length[20]"
            );
            try {
                if (!$this->validate($rules, $error)) {
                    $res['warning'] = implode(", ", $this->validator->getErrors());
                } else {
                    $users = new UsersModel();
                    $username = $postData['username'];
                    $password = $postData['password'];
                    $user_details = array();
                    if($login_type_mobile) {
                        $user_details = $users->where('phone',trim($username))->first();
                    } else {
                        $user_details = $users->where('email',trim($username))->first();
                    }
                    if(!empty($user_details)) {
                        $password = $user_details->salt.$password;
                        $result = password_verify($password,$user_details->password);
                        if($result) {
                            session()->set('LOGGEDIN_USER', $user_details);
                            session()->set('USER_MENUS_ACCESS', UsersModel::getUserAccess($user_details->id, true));
                            session()->setFlashdata('success', "Hi ".$user_details->name."!, We ready to serve you");
                            return redirect()->to('backend');
                        } else {
                            session()->setFlashdata('warning', "Please!, Try with right password.");
                        }
                    } else {
                        session()->setFlashdata('warning', "please!, Try with right username");
                    }
                }
            } catch (Exception $e) {
                session()->setFlashdata('error', "Sorry!, failed to serve your request. Please try again");
            }
        }
        return view('admin/login');
    }
    public function logout() {
        session()->remove('LOGGEDIN_USER');
        session()->remove('USER_ACCESS');
        session()->remove('MENUS');
        session()->setFlashdata('success', "You are logout successfully");
        $this->response->redirect(base_url('user/login'));
        
    }
    
}