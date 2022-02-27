<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Clients::class);
    }//end fun
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function append_models()
    {
        return $this->hasMany(TicketRevModel::class,'ticket_id')
            ->where('status', 'append');
    }//end fun
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function in_models()
    {
        return $this->hasMany(TicketRevModel::class,'ticket_id')
            ->where('status', 'in');
    }//end fun
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function models()
    {
        return $this->hasMany(TicketRevModel::class,'ticket_id');
    }//end fun

}//end class
