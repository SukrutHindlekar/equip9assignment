<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Core\MyController;

class JWTFilter extends MyController implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        $userId = $this->verify($request);

        if ($userId == -1) {
            header('content-type:application/json');
            echo json_encode($this->failure(302));
            die();
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}