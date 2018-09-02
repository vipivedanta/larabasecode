<form method="post" action="{{ url('invite-user') }}">
@csrf
<div class="input-group">
	  <input type="hidden" name="uuid" value="{{ $project_uuid }}" />	
	  <input type="text" class="form-control" name="email">
  		<span class="input-group-btn">
		    <button type="submit" class="btn btn-primary" type="button">Invite User!</button>
  		</span> 
 <p class="text text-danger">{{ $errors->first('email') }}</p>
</div>
</form>