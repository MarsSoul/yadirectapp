<?php

namespace App\Controllers;

use App\Core\View;

class HomeController extends BaseController
{
    public function index()
    {

        $data = [
            'homecont' => 'im homecontroller<br><br>',
            'basecont' => $this->imOK . '<br><br>',
        ];

        $view = new View($data);
        echo $view->render('home');
    }

}