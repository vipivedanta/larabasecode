@extends('layouts.project')
@section('innerContent')
<h2>{{ ucfirst( $project->name ) }}</h2>
@include('projects.single_project_menu')
@endsection