<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bracelets extends Model
{
<<<<<<< HEAD
    public function scopeBraceletFree($query)
    {
        return $query->where([
            ['status', true],
        ]);
    }//end fun

    public static function checkIsFree($title){
        $find = Bracelets::BraceletFree()->where('title',$title)->count();
        if ($find){
            return true;
        }else{
            return  Bracelets::BraceletFree()->where('title','LIKE','%'.$title.'%')->count();
        }
        return false;
    }

    public static function checkIfCharIsFree($title){
       return Bracelets::BraceletFree()->where('title','LIKE','%'.$title.'%')->count();
    }

}//end class
=======
    protected $guarded = [];
}
>>>>>>> 9148ece94347e32e953310fa77edb9dedea0a753
