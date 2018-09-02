@if( $projects->isNotEmpty() )
	<ul class="list-group">
	<li class="active list-group-item">Your projects <a href="{{ url('new-project') }}" class="btn btn-sm btn-danger text-right" title="New Project"><i class="fa fa-plus"></i></a></li>
	@foreach($projects as $project)
	<li class="list-group-item"><a href="{{ url('project/'.$project->uuid ) }}">{{ ucfirst($project->name) }}</a></li>
	@endforeach
	<li class="list-group-item"><a href="{{ url('my-projects') }}">See All of them</a></li>
	</ul>
@else
	<h3>Projects</h3>
	<a href="{{ url('new-project') }}" class="btn btn-sm btn-success">Start a new Project!</a>
@endif