<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class VipAdmission extends Model
{
    protected $fillable = ["customer_name", 'customer_email', 'no_of_tickets', 'backstage_access','complimentary_drinks'];
}
