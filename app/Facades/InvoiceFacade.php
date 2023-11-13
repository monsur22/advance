<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class InvoiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Invoice'; // This should match the name you bound in the service container
    }
}
