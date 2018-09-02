<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class AppModel extends Model
{
    protected static function boot(){
    	parent :: boot();
    	static::creating(function($query){
    		$query->created_by = Auth::id();
    		$query->updated_by = Auth::id();
    	});

        static::updating(function($query){
            $query->updated_by = Auth::id();
        });
    }

}
