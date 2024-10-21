<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        "event_name",
        'event_date_time',
        'ticket_price',
        'venue'

    ];
}
