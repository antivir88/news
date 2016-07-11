<?php

namespace App\Components;

use Micro\Mvc\Controllers\ViewController;

class Controller extends ViewController
{
    public function __construct($modules = '')
    {
        parent::__construct($modules);

        $this->layout = 'maket';
    }
}
