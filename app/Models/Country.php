<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $primaryKey = 'country_code';
    protected $keyType = 'string';
    public $incrementing = false;

    // Relation With City
    public function city(){
        return $this->hasMany(City::class, 'country_code');
    }
}
