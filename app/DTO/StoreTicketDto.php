<?php
namespace App\DTO;

use App\Http\Requests\Screen\ScreenRequest;
use App\Http\Requests\Screen\size\SizeRequest;
use Illuminate\Http\Request;


class StoreTicketDto
{
    public function __construct(
        public readonly int $event_id,
        public readonly ?string $customer_name,
        public readonly ?string $customer_email,
        public readonly ?int $no_of_tickets,
        public readonly ?string $seat_preference,
        public readonly ?bool $backstage_access,
        public readonly ?bool $complimentary_drinks,
        public readonly ?string $group_name,
        public readonly ?string $special_requests,
        public readonly ?int $number_of_tickets,
        public readonly string $category
    ) {}

    public static function create(Request $request): StoreTicketDto
    {
        return new self(
            event_id: $request->event_id,
            customer_name: $request->customer_name,
            customer_email: $request->customer_email,
            no_of_tickets: $request->no_of_tickets,
            seat_preference: $request->seat_preference,
            backstage_access: $request->backstage_access,
            complimentary_drinks: $request->complimentary_drinks,
            group_name: $request->group_name,
            special_requests: $request->special_requests,
            number_of_tickets: $request->number_of_tickets,
            category: $request->category
        );
    }



}
