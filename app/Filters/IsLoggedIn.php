<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Admin\UsersModel;

class IsLoggedIn implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if(!session()->get('LOGGEDIN_USER')) {
            return Response()->redirect(base_url('user/login'));
        }
        $usersModel = new UsersModel();
        $url = $request->getUri()->getPath();
        if(!$usersModel->hasAccess($url) && UsersModel::loggedInUser()->role != 101) {
            return Response()->setStatusCode(403)->setBody(view('errors/html/error_403'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}