<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketRevModel extends Model
{

    public function reservation()
    {
        return $this->belongsTo(Reservations::class,'rev_id');
    }

}//end class
