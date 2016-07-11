<?php

namespace App;

use Micro\Micro;

class Application extends Micro
{
    public function getAppDir()
    {
        return __DIR__;
    }
}