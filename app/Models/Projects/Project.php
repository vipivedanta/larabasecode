<?php

namespace App\Models\Projects;

use Illuminate\Database\Eloquent\Model;
use App\Models\AppModel;

class Project extends AppModel
{
    
	public function members(){
		return $this->hasMany('App\Models\Projects\Member','project_id','id');
	}
}
