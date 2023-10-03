<?php

namespace App\Core;

class View 
{
    protected $data = [];

    public function __construct($data = []) 
    {
        $this->data = $data;
    }

    public function render($viewName) 
    {
        $viewPath = __DIR__ . '/../views/' . $viewName . '.php';
        $templatePath = __DIR__ . '/../views/template.php';

        if (file_exists($viewPath) && file_exists($templatePath)) {
            extract($this->data);
            ob_start();
            require $viewPath;
            $content = ob_get_clean();

            ob_start();
            require $templatePath;
            $output = ob_get_clean();

            return $output;
        } else {
            throw new \Exception("обработка отсутствия шаблона");
        }
    }
}

