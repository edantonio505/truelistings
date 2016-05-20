@extends('layouts.app')


@section('title', 'New Property')
@section('styles')
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">
@endsection
@section('content')
@include('partials.dashboard_bar')
@include('partials.errors')
<div class="container new-listing boxes rounded" style="margin-bottom: 30px;">
	<form action="/new_property" method="post">
	<div style="margin-left:10px;" >
		<h2 class="grey-text form-title">New Property</h2>
		<input type="submit" class="button" value="Create" />
	</div>
		@include('partials.property_form')
</div>
@stop

@section('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
@endsection