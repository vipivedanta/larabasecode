<?php

use Illuminate\Database\Seeder;

class UserProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(\App\User::get() as $user){

        	$count = rand(5,10);
        	auth()->login($user,true);

        	for($i=1;$i<= $count;$i++){
	        	$project = new \App\Models\Projects\Project();
    	    	$project->name = 'project '.rand(5,20);
	        	$project->description = str_random(100);
    	    	$user->projects()->save($project);        	
    	    }
        }
    }
}
