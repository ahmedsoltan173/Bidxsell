<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ["relatable_type", 'relatable_id'];




    public function category(){
        return $this->morh();
    }
}
