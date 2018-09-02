@extends('layouts.project')

@section('innerContent')

<h3>Create a New Project</h3>

<form method="post" action="{{ route('projects.store') }}" >
@csrf

<div class="form-group">
<label class="control-label">Project Name</label>
<div class="">
	<input type="text" name="name" class="form-control" />
	<span class="text text-danger">{{ $errors->first('name') }}</span>
</div>
</div>

<div class="form-group">
<label class="control-label">Description (Optional)</label>
<div class="">
	<textarea class="form-control" name="description"></textarea>
</div>
</div>

<div class="form-group">
<input type="submit" value="Create!" class="btn btn-success pull-right" />
</div>

</form>

@endsection