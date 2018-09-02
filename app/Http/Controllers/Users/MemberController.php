<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use App\Models\Projects\Project;
use App\Http\Requests\Users\InviteMemberRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewInvitationMail;
use App\User;
use Hash;
use App\Models\Projects\Member;
use Session;

class MemberController extends Controller
{	

	public function __construct(){
		$this->middleware('auth');
	}
    
    public function show( Request $request, $project = false ){

    	try{

    		$project = Project::where('uuid', $project)->first();
    		if( $project == null )
    			throw new Exception("Invalid request", 1);

    		$members = $project->members;
    		$title = 'Members -'.$project->name;
    		$project_uuid = $project->uuid;

    		return view('users.all_members')
    				->with(compact('members','title','project_uuid'));    			

    	}catch( \Exception $e ){
    		return abort(404, $e->getMessage());
    	}
    }

    public function invite( InviteMemberRequest $request ){

    	try{

    		$project = Project::where('uuid',$request->uuid)->first();
    		if($project == null) throw new Exception("Invalid request", 1);
    		

    		Mail::to( $request->email )->send( new NewInvitationMail($request->email) );

    		$user = new User();
    		$user->name = explode('@',$request->email)[0];
    		$user->email = $request->email;
    		$user->password = Hash::make(str_random(6));
    		$user->avatar = '';
    		$user->avatar_original = '';
    		$user->user_base = 0;
    		$user->google_id = '';
    		$user->save();

    		$member = new Member();
    		$member->user_id = $user->id;
    		$project->members()->save($member);

    		Session::flash('success','Your invitation has been sent to '.$user->email);
    		return redirect('team/'.$project->uuid);

    	}catch(\Exception $e){
    		dd($e);
    		return abort(404, $e->getMessage());
    	}
    }
}
