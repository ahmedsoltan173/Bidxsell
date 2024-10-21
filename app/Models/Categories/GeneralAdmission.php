<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class GeneralAdmission extends Model
{
    protected $fillable = ["customer_name", 'customer_email', 'no_of_tickets', 'seat_preference'];
}
