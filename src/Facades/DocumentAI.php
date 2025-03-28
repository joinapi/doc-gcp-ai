<?php

namespace Joinapi\DocumentAI\Facades;

use Illuminate\Support\Facades\Facade;

class DocumentAI extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'documentai';
    }

}