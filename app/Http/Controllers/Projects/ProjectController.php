<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\Projects\CreateProjectRequest;
use Exception;
use App\Models\Projects\Project;
use Session;
use Activity;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    
    public function __construct(){
    	
        $this->middleware('auth');
    }

    public function index(){

    }

    public function create(){

    	$projects = Auth::user()->projects()->latest()->paginate(4);
    	return view('projects.create_project')->with(compact('projects'));
    }

    public function store( CreateProjectRequest $request ){

    	try{

    		$project = new Project();
    		$project->name = $request->name;
    		$project->slug = str_slug($request->name,'-');
    		$project->uuid = (string) Str::uuid(2,'-');
    		$project->description = ( empty($request->description) ) ? 'No description given' : $request->description;
    		$project = Auth::user()->projects()->save( $project );

    		activity()->performedOn($project)
    				->causedBy( Auth::user() )
    				->withProperties(['name' => $request->name])
    				->log('Project Created');

    		Session::flash('success','Your new project has been saved successfully!');
    		return redirect('new-project');

    	}catch(\Exception $e){
    		return abort(404,$e->getMessage());
    	}
    }

    public function show( Request $request , $uuid = false ){
        try{

            $project = Project::where('uuid',$uuid)->first();
            if( $project == null )
                throw new Exception("Invalid access", 1);
            
            $request->session()->push('cp',$project->id); 
            $projects = Auth::user()->projects()->latest()->paginate(4);

            $members = $project->members;
            
            return view('projects.single_project')->with(compact('project','projects'));   

        }catch( \Exception $e ){
            dd($e);
            return abort(404,$e->getMessage() );
        }
    }

    public function delete(){

    }
}
