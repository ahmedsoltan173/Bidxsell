<?php

namespace App\Http\Services\Services;

use App\DTO\CreateEventDto;
use App\DTO\StoreTicketDto;
use App\Http\Services\Interfaces\TicketInterface;
use App\Models\Categories\GeneralAdmission;
use App\Models\Categories\GroupBooking;
use App\Models\Categories\VipAdmission;
use App\Models\Event;
use App\Models\Ticketing;
use App\Trait\ResponseFormater;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Ticket;
use Symfony\Component\HttpFoundation\Response;

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

    public function storeTicket(StoreTicketDto $storeTicketDto){
        try{
            DB::beginTransaction();
            $addmission=null;
            $type=null;
            if((int)$storeTicketDto->category == Ticketing::GENERAL){
                $addmission=GeneralAdmission::create([
                    "customer_name"=>$storeTicketDto->customer_name,
                    'customer_email'=>$storeTicketDto->customer_email,
                    'no_of_tickets'=>$storeTicketDto->no_of_tickets,
                    'seat_preference'=>$storeTicketDto->seat_preference
                ]);
                $type=GeneralAdmission::class;
            }elseif((int)$storeTicketDto->category == Ticketing::VIP){
                $addmission=VipAdmission::create([
                    "customer_name"=>$storeTicketDto->customer_name,
                    'customer_email'=>$storeTicketDto->customer_email,
                    'no_of_tickets'=>$storeTicketDto->no_of_tickets,
                    'backstage_access'=>$storeTicketDto->backstage_access,
                    'complimentary_drinks'=>$storeTicketDto->complimentary_drinks
                ]);
                $type=VipAdmission::class;
            }elseif((int)$storeTicketDto->category == Ticketing::GROUP){
                $addmission=GroupBooking::create([
                    "group_name"=>$storeTicketDto->group_name,
                    'number_of_tickets'=>$storeTicketDto->number_of_tickets,
                    'special_requests'=>$storeTicketDto->special_requests
                ]);
                $type=GroupBooking::class;
            }
            $ticket=Ticketing::create([
                "event_id"=>$storeTicketDto->event_id,
                'relatable_id'=>$addmission->id,
                'relatable_type'=>$type
            ]);

        DB::commit();
        return $this->success("data",$ticket->with('relatable')->get(),"success");

    }catch(Exception $ex){
        DB::rollBack();
        return $this->error("ERROR",Response::HTTP_UNPROCESSABLE_ENTITY,$ex);

    }

    }

    public function showEvent($id){
        $event=Event::with('tickets')->find($id);
        return $this->success("data",$event,"success");
    }
}

