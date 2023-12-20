<?php

namespace App\Controllers\Admin;

use App\Controllers\Admin\BaseController;
use CodeIgniter\I18n\Time;
use App\Models\Admin\ImagesModel;
use App\Services\S3Service;

class Images extends BaseController {
    protected $s3Service;
    public function __construct()
    {
        $this->s3Service = new S3Service();
    }
    public function index() {
        $data['title'] = "S3 Images";
        $impactStory = new ImagesModel();
        $data['images'] = $impactStory->paginate(10);
        $data['pager'] = $impactStory->pager;
        return view('admin/image/index', $data);
    }
    public function add() {
        $data['title'] = "New Image Form";
        if($this->request->is('post')) {
            $this->save();
        }
        return view('admin/image/form', $data);
    }
    public function edit($id) {
        $data['title'] = "Edit image Form";
        if($this->request->is('post')) {
            $this->save($id);
        }
        $impactStory = new ImagesModel();
        $data['image'] = $impactStory->find($id);
        return view('admin/image/form', $data);
    }
    protected function save($id = null) {
        $db = \Config\Database::connect();
        try {
            $name = $this->request->getPost('i_name');
            $file = $this->request->getFile('image_upload');
            $record = [];
            $rules['i_name'] = [
                'label' => 'Customer Image',
                'rules' => 'required|alpha_numeric'
            ];
            if (!$this->validate($rules)) {
                throw new \Exception(implode(", ", $this->validator->getErrors()));
            }
            if ($file->isValid() && !$file->hasMoved()) {
                $rules['image_upload'] = [
                    'label' => 'Customer Image',
                    'rules' => 'uploaded[image_upload]|mime_in[image_upload,image/jpg,image/jpeg,image/png]|max_size[image_upload,100000]',
                ];
                if (!$this->validate($rules)) {
                    throw new \Exception(implode(", ", $this->validator->getErrors()));
                }
                $key = 'images/to/' .Time::now().$file->getName();
                $file_url = $this->s3Service->uploadFile($key, $file);
                $record['url'] = $file_url;
                if (!$file_url) {
                    throw new \Exception('Failed to upload file to S3 Bucket.');
                }
            }
            // Check the resultfile_url
            $imagesModel = new ImagesModel();
            // Start the transaction
            $db->transBegin();
            $record['name'] = $name;
            if(!$id) {    
                $record['created_at'] = Time::now();
                if(!$record['url']) {
                    throw new \Exception('Image required, Please pick the image to upload');
                }
                $imagesModel->save($record);
                $message = "Image data updated successfully.";
            } else {
                $imagesModel->update($id, $record);
                $message = "Image data saved successfully.";
            } 
            $db->transCommit();      
            session()->setFlashdata('success', $message);
            return response()->redirect(base_url('backend/images'));
        } catch(\Exception $e) {
            $db->transRollback();
            session()->setFlashdata('error', str_replace("`", "", $e->getMessage()));
        }  
    }
    public function delete($id) {
        try {
            $impactStory = new ImagesModel();
            $result = $impactStory->delete($id);
            if($result) {
                session()->setFlashdata('success', "Image deleted successfully");
            }
        } catch(\Exception $e) {
            session()->setFlashdata('error', $e->getMessage());
        }
        return redirect()->back();
    }
}