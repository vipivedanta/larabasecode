@if(Session::has('cp'))
	
	@php $project = \App\Models\Projects\Project::find(Session::get('cp'))->first(); @endphp
	@if( $project != null )
		<a href="{{ url('modules/'.$project->uuid) }}" class="btn btn-primary">Modules</a>
		<a href="{{ url('tasks/'.$project->uuid) }}" class="btn btn-primary">Tasks</a>
		<a href="{{ url('bugs/'.$project->uuid) }}" class="btn btn-primary">Bugs</a>
		<a href="{{ url('team/'.$project->uuid) }}" class="btn btn-primary">Team</a>
		<a href="{{ url('overview/'.$project->uuid) }}" class="btn btn-primary">Overview</a>
	@endif
@endif