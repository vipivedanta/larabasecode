@extends('emails.wrapper.wrapper')
@section('content')
<h2>Hi {{ $email }},</h2>
<p>You are requested to join basecode.io!</p>
<p>Click <a href="{{ url('login/google') }}">here</a> to join now!!</p>
@endsection