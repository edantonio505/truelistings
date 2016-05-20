

@if(session()->has('flash_message'))
	<div class="success callout alerts top-space" style="color:#6B6B6B;"data-closable>
	  {{ session('flash_message') }}
	  	<button class="close-button" aria-label="Dismiss alert" type="button" data-close>
          <span aria-hidden="true">&times;</span>
        </button>
	</div>
@endif