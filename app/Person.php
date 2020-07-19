<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Household;
use App\Leader;
use App\Ethnicity;

class Person extends Model
{
    protected $guarded = [];

    public function household(){
        return $this->belongsTo(Household::class);
    }

    public function leader(){
        return $this->belongsTo(Leader::class);
    }

    public function ethnicity(){
        return $this->belongsTo(Ethnicity::class);
    }
}
