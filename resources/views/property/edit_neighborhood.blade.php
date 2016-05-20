@extends('layouts.app')

@section('content')
	<div class="row container">
		<div class="small-12 medium-10 medium centered large-10 large-centered columns boxes"
		style="background-color: white;">
			<h4>{{ $neighborhood->name }}</h4>
			<form action="{{ route('postNeighborhood') }}" method="post">
			{{ csrf_field() }}
			  <div class="row">
			    <div class="medium-6 columns">
			      <label>Latitud
			        <input type="text" name="lat" placeholder="">
			      </label>
			    </div>
			    <div class="medium-6 columns">
			      <label>Longitud
			        <input type="text" name="lng" placeholder="">
			      </label>
			    </div>
			    <input type="hidden" name="id" value="{{ $neighborhood->id }}" />
			    <div class="medium-6 medium-centered columns">
			        <input type="submit" class="expanded button" value="submit value" />
			    </div>
			  </div>
			</form>
		</div>
	</div>
@endsection