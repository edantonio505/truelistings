@extends('layouts.app')

@section('title', 'Broker Dashboard')


@section('content')
@include('partials.dashboard_bar')
@include('partials.flash')
<div class="row broker-dashboard-content">
	<div class="small-12 medium-10 large-10 columns">
		<p><div class="littleredsquare"></div> Listings that have less than 3 selling Points are shown in red.</p>
		<table>
	        <thead>
	          <tr>
	            <th width="225">Address</th>
	            <th width="225">Neighborhood</th>
	            <th width="225">Price</th>
	            <th width="225">Bedrooms</th>
	            <th width="">Edit</th>
	            <th width="">Delete</th>
	          </tr>
	        </thead>
	        <tbody>
	        @foreach($properties as $property)
	          <tr 
	          class="selectableRow {{ $property->checkIfHasSellingPoints() }}" 
	          data-id="{{ $property->id }}">
	            <td>{{ $property->address }}</td>
	            <td>{{ $property->neighborhood }}</td>
	            <td>${{ $property->price }}</td>
	            <td>{{ $property->beds }}</td>
	            <td><a href="{{ route('editProperty', ['id' => $property->id]) }}" class="button"><i class="fi-pencil">
	            <td><button property-id="{{ $property->id }}" token="<?php echo csrf_token(); ?>" class="deleteProperty alert button"><i class="fi-x"></i></button></td>
	          </tr>
	        @endforeach
	        </tbody>
	    </table>
	</div>
	<div class="small-12 medium-2 large-2 columns">
	@include('partials.sellingPointsOptions')
	</div>
</div>
@stop