<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class GroupBooking extends Model
{
    protected $fillable = ["group_name", 'number_of_tickets', 'special_requests'];
}
