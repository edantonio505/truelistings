@extends('layouts.app')


@section('content')
	
	@foreach($properties as $property)
		{{ $property->address }} - {{ $property->neighborhood }} - ${{ $property->price }} - beds: {{ $property->beds }}<br />
	@endforeach
@stop