<?php
namespace App\DTO;

use App\Http\Requests\Screen\ScreenRequest;
use App\Http\Requests\Screen\size\SizeRequest;
use Illuminate\Http\Request;

class CreateEventDto{
public function __construct(
    public readonly string $event_name,
    public readonly string $event_date_time,
    public readonly string $ticket_price,
    public readonly string $venue
   )
{
}

public static function create(Request $request):CreateEventDto{
    return new self(
        event_name: $request->event_name,
        event_date_time: $request->event_date_time,
        ticket_price: $request->ticket_price,
        venue: $request->venue,
    );

}

}
