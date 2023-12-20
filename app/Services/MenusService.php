<?php
// App/Services/S3Service.php

namespace App\Services;

use App\Models\Admin\BackendMenusModel;
use App\Models\MenusModel;

class MenusService
{
    public function getBackendMenus() {
        $backendMenusModel  = new BackendMenusModel();
        return $backendMenusModel->getMenus();
    }
    public function getMenus() {
        $backendMenusModel  = new MenusModel();
        return $backendMenusModel->getMenus();
    }
}