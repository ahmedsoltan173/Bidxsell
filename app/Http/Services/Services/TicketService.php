<?php

namespace App\Http\Services\Services;

use App\DTO\CreateEventDto;
use App\Http\Services\Interfaces\TicketInterface;
use App\Models\Event;
use App\Trait\ResponseFormater;
use Carbon\Carbon;

class TicketService implements TicketInterface
{
    use ResponseFormater;
    public function all_events(){
        return Event::all();
    }
    public function create(CreateEventDto $createEventDto){
        $event=Event::create([
            "event_name"=>$createEventDto->event_name,
            'event_date_time'=>Carbon::parse($createEventDto->event_date_time)->format('Y-m-d H:i:s'),
            'ticket_price'=>$createEventDto->ticket_price,
            'venue'=>$createEventDto->venue
        ]);
        return $this->success("data",$event,"success");
    }
}

