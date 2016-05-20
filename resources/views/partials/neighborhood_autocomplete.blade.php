<script>
  $(function() {
    var availableTags = [
      @foreach($neighborhoods as $neighborhood)
    		"{{ $neighborhood }}",
    	@endforeach
    ];
    $( "#location" ).autocomplete({
      source: availableTags
    });
  });
</script>