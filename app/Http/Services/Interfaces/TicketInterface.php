<?php

namespace App\Http\Services\Interfaces;

use App\DTO\CreateEventDto;
use App\DTO\StoreTicketDto;
use App\Models\Event;

interface TicketInterface
{

    public function all_events();
    public function showEvent($id);
    public function create(CreateEventDto $createEventDto);
    public function storeTicket(StoreTicketDto $storeTicketDto);
}
