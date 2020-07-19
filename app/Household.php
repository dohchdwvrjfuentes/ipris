<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Person;

class Household extends Model
{
    protected $guarded = [];

    public function people(){
        return $this->hasMany(Person::class);
    }
}
