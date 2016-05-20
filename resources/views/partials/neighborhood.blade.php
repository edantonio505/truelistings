<option value="">Choose a neighborhood</option>
@foreach($neighborhoods as $neighborhood)
	<option value="{{ $neighborhood->name }}"
		@if((isset($property) && $neighborhood->name === $property->neighborhood) ||
		(old('neighborhood') === $neighborhood->name))
			selected="selected"
		@endif
	>{{ $neighborhood->name }}</option>
@endforeach
