<?php

namespace App\Controllers;

use App\Interfaces\Controllers\Error404ControllerInterface;
use App\Core\View;

class Error404Controller extends BaseController implements Error404ControllerInterface
{
    public function index($message)
    {
        $data = ['message' => $message,];
        $view = new View($data);
        echo $view->render('page404');
    }

}