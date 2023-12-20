<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $key = env('TOKEN_SECRET');
        $header = $request->getServer('HTTP_AUTHORIZATION');
        if(!$header) return response()
                            ->setJSON(['msg' => 'Token Required'])
                            ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        $token = explode(' ', $header)[1];
        try {
            JWT::decode($token, new Key($key, 'HS256'));
        } catch (\Throwable $th) {
            return response()
                            ->setJSON(['msg' => 'Invalid Token'])
                            ->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        
    }
}