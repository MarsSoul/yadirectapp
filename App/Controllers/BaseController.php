<?php

namespace App\Controllers;

use App\Core\View;

class BaseController
{
    protected function renderView($viewName, $data = [])
    {
        $view = new View($data);
        echo $view->render($viewName);
    }
}
