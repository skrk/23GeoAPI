<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    // Relation With Country
    public function country(){
        return $this->belongsTo(Country::class, 'country_code');
    }
}
