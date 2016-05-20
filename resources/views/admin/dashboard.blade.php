@extends('layouts.app')

@section('title', 'Admin Dashboard')


@section('content')
	<div class="container">
		<h4 class="grey-text header">Welcome {{ ucfirst(Auth::user()->name) }}</h4>
		<h5 class="grey-text">This is the Admin Dasboard</h5>
	</div>
@stop