<?php

namespace App\Http\Controllers\API\Ticketing;

use App\DTO\CreateEventDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tickiting\CreateEventRequest;
use App\Http\Services\Facades\TicketFacade;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function all_events(){
        return TicketFacade::all_events();
    }
    public function createEvent(CreateEventRequest $request){
        return TicketFacade::create(CreateEventDto::create($request));

    }

}
