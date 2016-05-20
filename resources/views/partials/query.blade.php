<p>You are looking for a 
@if($query->input('beds') == 0)
	studio apartment
@else
	property with {{ $query->input('beds') }} 
	bedroom<?php if($query->input('beds') > 1) { echo 's'; } ?>
@endif
	in {{ $query->input('location') }}
	between ${{ $query->input('min') }} and ${{ $query->input('max') }} that
		@include('partials.gq1')
		@include('partials.gq2')
	and @include('partials.gq3')
	</p>