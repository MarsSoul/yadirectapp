<?php

namespace App\Controllers;

use App\Core\View;

class BaseController
{
    protected $imOK;

    public function __construct()
    {
        $this->imOK = "BaseController OK";
    }

    protected function renderView($viewName, $data = [])
    {
        $view = new View($data);
        echo $view->render($viewName);
    }
}
