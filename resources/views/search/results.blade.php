@extends('layouts.app')
@section('title', 'Search Results')

@section('content')

<div class="pageLoader">
	<img src="images/loading.gif" alt="">
</div>
<div class="container-results top-space">
	
	<h4 class="grey-text header">Search Results</h4>
	@include('partials.searchFormResults')
	<div class="row">
		<div class="small-2 medium-2 large-2 columns">
			@include('partials.filterButton')
		</div>
		
		<div class="small-10 medium-10 large-10 columns">
			<div id="container" class="row small-up-1 medium-up-2 large-up-3 grid">
				@foreach($properties as $property)
					@include('partials.resultbox')
				@endforeach
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
	@include('partials.amenitiesFilter')
	@include('partials.neighborhood_autocomplete')
@stop
