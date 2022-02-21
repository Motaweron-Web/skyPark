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
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shift()
    {
        return $this->belongsTo(Shifts::class,'shift_id');
    }//end fun
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function models()
    {
        return $this->hasMany(TicketRevModel::class,'rev_id');
    }//end fun
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function append_models()
    {
        return $this->hasMany(TicketRevModel::class,'rev_id')
            ->where('status', 'append');
    }//end fun

}//end class
