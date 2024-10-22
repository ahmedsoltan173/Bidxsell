<?php

namespace App\Http\Services\Facades;


use Illuminate\Support\Facades\Facade;

class TicketFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "TicketService";
    }

}
