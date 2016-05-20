@extends('layouts.app')
@section('title', 'Search Results')

@section('content')

	<div class="row">

		@foreach($properties as $property)
					
		
		<div class="small-12 medium-6 large-4 column">
			<div class="callout">
			<p>Pegasi B</p>
			<p><img src="./Foundation _ Welcome_files/400x370&amp;text=Pegasi B" alt="image of a planet called Pegasi B"></p>
			<p class="lead">Copernican Revolution caused an uproar</p>
			<p class="subheader">Find Earth-like planets life outside the Solar System</p>
			</div>
		</div>
		@endforeach


	</div>


@stop

@section('scripts')
	@include('partials.amenitiesFilter')
@stop

