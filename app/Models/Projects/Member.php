<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;
use App\Models\AppModel;

class Member extends AppModel
{
    
    public function project(){
    	return $this->belongsTo('App\Models\Projects\Project','project_id');
    }

    public function user(){
    	return $this->belongsTo('App\User','user_id');
    }
}
