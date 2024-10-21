<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticketing extends Model
{
    protected $fillable = [
        "event_id",
        'category_id'
    ];
}
