<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticketing extends Model
{

    public const GENERAL=1;
    public const VIP=2;
    public const GROUP=3;
    protected $fillable = [
        "event_id",
        'category_id',
        'relatable_id',
        'relatable_type'
    ];

    public function relatable()
    {
        return $this->morphTo();
    }
}
