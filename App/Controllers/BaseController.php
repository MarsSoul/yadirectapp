<?php

namespace App\Controllers;

class BaseController
{
    protected $imOK;

    public function __construct()
    {
        $this->imOK = "BaseController OK";
    }
}
