<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ZipFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'zip';
    }
}
