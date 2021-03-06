<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorTypes extends Model
{

    protected $guarded = [];
    public function shifts(){
        return $this->belongsToMany(Shifts::class,'shifts','visitor_type_id','shift_id');
    }
}
