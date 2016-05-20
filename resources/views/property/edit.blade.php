@extends('layouts.app')


@section('title', 'Edit Property')
@section('styles')
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">
@endsection
@section('content')
@include('partials.dashboard_bar')
@include('partials.errors')
<div class="container new-listing boxes rounded" style="margin-bottom: 30px;">
	<form action="{{ route('postEditProperty', ['id' => $property->id]) }}" method="post">
	<div style="margin-left:10px;" >
		<h2 class="grey-text form-title">Edit Property</h2>
		<button type="submit" class="button">
		  <i class="fi-clipboard-pencil"></i> Save Changes
		</button>
		<a href="{{ (Auth::user()->checkIsAdmin() ? route('brokerdashboard') : route('dashboard')) }}" class="alert button">Cancel</a>
	</div>
		@include('partials.property_form')
</div>
@stop

@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
@endsection