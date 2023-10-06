<?php

namespace App\Controllers;

use App\Core\View;

class Error404Controller extends BaseController
{
    public function index($message)
    {
        $data = ['message' => $message,];
        $view = new View($data);
        echo $view->render('page404');
    }

}