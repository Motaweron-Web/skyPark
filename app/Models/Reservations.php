<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;

class Reservations extends Model
{

    protected $guarded=[];

    public function event()
    {
        return $this->belongsTo(Event::class,'event_id');
    }//end fun

    public function shift()
    {
        return $this->belongsTo(Shifts::class,'shift_id');
    }//end fun

}//end class
